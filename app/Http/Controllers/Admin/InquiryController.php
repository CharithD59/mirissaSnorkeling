<?php

namespace App\Http\Controllers\Admin;

use App\Mail\InquiryReplyMail;
use App\Models\ContactInquiry;
use App\Models\ContactReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InquiryController extends AdminController
{
    public function index(Request $request)
    {
        $query = ContactInquiry::query()->withCount('replies');

        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $like = '%' . $search . '%';
                $q->where('cus_name', 'like', $like)
                    ->orWhere('email', 'like', $like)
                    ->orWhere('mobi_num', 'like', $like)
                    ->orWhere('message', 'like', $like);
            });
        }

        $status = $request->input('status');
        if ($status === 'pending') {
            $query->where(function ($q) {
                $q->where('status', 'pending')->orWhereNull('status');
            });
        } elseif ($status && isset(ContactInquiry::STATUSES[$status])) {
            $query->where('status', $status);
        }

        if ($from = $request->input('from')) {
            $query->whereDate('cre_datetime', '>=', $from);
        }
        if ($to = $request->input('to')) {
            $query->whereDate('cre_datetime', '<=', $to);
        }

        $query->orderBy('cre_datetime', $request->input('sort') === 'oldest' ? 'asc' : 'desc');

        $inquiries = $query->paginate(15)->withQueryString();

        $counts = ['all' => ContactInquiry::count()];
        foreach (array_keys(ContactInquiry::STATUSES) as $key) {
            $counts[$key] = $key === 'pending'
                ? ContactInquiry::where(function ($q) {
                    $q->where('status', 'pending')->orWhereNull('status');
                })->count()
                : ContactInquiry::where('status', $key)->count();
        }

        return view('admin.inquiries.index', compact('inquiries', 'counts'));
    }

    public function show($id)
    {
        $inquiry = ContactInquiry::with('replies.user')->findOrFail($id);
        if (!$inquiry->is_read) {
            $inquiry->forceFill(['is_read' => true])->save();
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function reply(Request $request, $id)
    {
        $inquiry = ContactInquiry::findOrFail($id);

        $data = $request->validate([
            'subject' => 'required|string|max:191',
            'body'    => 'required|string|min:5|max:10000',
            'close_after' => 'nullable|boolean',
        ]);

        $reply = new ContactReply([
            'contact_id' => $inquiry->getKey(),
            'user_id'    => Auth::id(),
            'subject'    => $data['subject'],
            'body'       => $data['body'],
        ]);

        try {
            Mail::to($inquiry->email, $inquiry->cus_name)->send(new InquiryReplyMail($inquiry, $reply));
            $reply->email_sent = true;
        } catch (\Throwable $e) {
            report($e);
            $reply->email_sent = false;
            $reply->email_error = Str::limit($e->getMessage(), 480);
        }
        $reply->save();

        if ($reply->email_sent) {
            $inquiry->update([
                'status'     => $request->boolean('close_after') ? 'closed' : 'replied',
                'replied_at' => now(),
            ]);
            return back()->with('success', 'Reply sent to ' . $inquiry->email . '.');
        }

        return back()->withInput()->with('error', 'The reply was saved but the email could not be sent: ' . $reply->email_error);
    }

    public function updateStatus(Request $request, $id)
    {
        $inquiry = ContactInquiry::findOrFail($id);
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(ContactInquiry::STATUSES))],
        ]);
        $inquiry->update(['status' => $data['status']]);

        return back()->with('success', 'Inquiry marked as ' . $inquiry->status_label . '.');
    }

    public function destroy($id)
    {
        $inquiry = ContactInquiry::findOrFail($id);
        ContactReply::where('contact_id', $inquiry->getKey())->delete();
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry deleted.');
    }
}
