<?php

namespace App\Http\Controllers\Admin;

use App\Mail\BookingStatusMail;
use App\Models\Booking;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class BookingController extends AdminController
{
    public function index(Request $request)
    {
        $query = $this->filteredQuery($request);

        $sort = $request->input('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('cre_datetime');
                break;
            case 'tour_asc':
                $query->orderByRaw('DATE(`datetime`) asc');
                break;
            case 'tour_desc':
                $query->orderByRaw('DATE(`datetime`) desc');
                break;
            default:
                $query->orderByDesc('cre_datetime');
        }

        $bookings = $query->paginate((int) $request->input('per_page', 15))->withQueryString();

        $counts = ['all' => Booking::count()];
        foreach (array_keys(Booking::STATUSES) as $status) {
            $counts[$status] = $status === 'pending'
                ? Booking::where(function ($q) {
                    $q->where('status', 'pending')->orWhereNull('status');
                })->count()
                : Booking::where('status', $status)->count();
        }

        $services = Booking::query()->whereNotNull('service_name')->distinct()->orderBy('service_name')->pluck('service_name');

        return view('admin.bookings.index', compact('bookings', 'counts', 'services', 'sort'));
    }

    public function export(Request $request)
    {
        $bookings = $this->filteredQuery($request)->orderByDesc('cre_datetime')->get();
        $filename = 'bookings-' . date('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($bookings) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Reference', 'Booked On', 'Customer', 'Email', 'Contact No', 'Tour Date', 'Service', 'Adults', 'Kids', 'Amount', 'Status', 'Special Request', 'Admin Notes']);
            foreach ($bookings as $b) {
                fputcsv($out, [
                    $b->reference, (string) $b->cre_datetime, $b->cus_name, $b->email, $b->contact_no, $b->datetime,
                    $b->service_name, $b->adult_count, $b->kid_count, $b->total_amount, $b->status_label, $b->message, $b->admin_notes,
                ]);
            }
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv']);
    }

    public function create(Request $request)
    {
        // Optional pre-fill, e.g. when creating a booking from a customer inquiry.
        $booking = new Booking([
            'status'     => 'confirmed',
            'persons'    => 'Persons 1',
            'kids'       => '0',
            'cus_name'   => $request->input('name'),
            'email'      => $request->input('email'),
            'contact_no' => $request->input('phone'),
        ]);
        return view('admin.bookings.form', [
            'booking'  => $booking,
            'packages' => Package::ordered()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $error = $this->availabilityError($request, $data, null);
        if ($error) {
            return back()->withInput()->withErrors(['datetime' => $error]);
        }

        $booking = Booking::create(array_merge($data, ['source' => 'admin']));
        $mailError = $this->maybeNotify($request, $booking);
        $message = 'Booking ' . $booking->reference . ' created.';

        return redirect()->route('admin.bookings.show', $booking->getKey())
            ->with($mailError ? 'warning' : 'success', $mailError ? $message . ' ' . $mailError : $message);
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        $otherBookings = Booking::query()
            ->where('email', $booking->email)
            ->where($booking->getKeyName(), '!=', $booking->getKey())
            ->orderByDesc('cre_datetime')->limit(5)->get();

        return view('admin.bookings.show', compact('booking', 'otherBookings'));
    }

    public function edit($id)
    {
        return view('admin.bookings.form', [
            'booking'  => Booking::findOrFail($id),
            'packages' => Package::ordered()->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $data = $this->validated($request);
        $error = $this->availabilityError($request, $data, $booking->getKey());
        if ($error) {
            return back()->withInput()->withErrors(['datetime' => $error]);
        }

        $booking->update($data);
        $mailError = $this->maybeNotify($request, $booking);

        return redirect()->route('admin.bookings.show', $booking->getKey())
            ->with($mailError ? 'warning' : 'success', $mailError ? 'Booking updated. ' . $mailError : 'Booking updated.');
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $rules = [
            'status' => ['required', Rule::in(array_keys(Booking::STATUSES))],
        ];
        $data = $request->validate($rules);
        $data = array_merge(array_fill_keys(array_keys($rules), null), $data);

        $booking->update(['status' => $data['status']]);
        $message = 'Booking ' . $booking->reference . ' marked as ' . $booking->status_label . '.';
        $mailError = $this->maybeNotify($request, $booking);

        return back()->with($mailError ? 'warning' : 'success', $mailError ? $message . ' ' . $mailError : $message);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $reference = $booking->reference;
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('success', 'Booking ' . $reference . ' deleted.');
    }

    protected function filteredQuery(Request $request)
    {
        $query = Booking::query();

        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $like = '%' . $search . '%';
                $q->where('cus_name', 'like', $like)
                    ->orWhere('email', 'like', $like)
                    ->orWhere('contact_no', 'like', $like)
                    ->orWhere('service_name', 'like', $like)
                    ->orWhere('message', 'like', $like);
                if (preg_match('/^(bk-?)?0*(\d+)$/i', $search, $m)) {
                    $q->orWhere((new Booking)->getKeyName(), (int) $m[2]);
                }
            });
        }

        $status = $request->input('status');
        if ($status === 'pending') {
            $query->where(function ($q) {
                $q->where('status', 'pending')->orWhereNull('status');
            });
        } elseif ($status && isset(Booking::STATUSES[$status])) {
            $query->where('status', $status);
        }

        if ($service = $request->input('service')) {
            $query->where('service_name', $service);
        }
        if ($from = $request->input('from')) {
            $query->whereRaw('DATE(`datetime`) >= ?', [$from]);
        }
        if ($to = $request->input('to')) {
            $query->whereRaw('DATE(`datetime`) <= ?', [$to]);
        }

        return $query;
    }

    protected function validated(Request $request)
    {
        $rules = [
            'cus_name'     => 'required|string|max:191',
            'email'        => 'required|email|max:191',
            'contact_no'   => 'required|string|max:50',
            'datetime'     => 'required|date',
            'service_name' => 'required|string|max:191',
            'adults'       => 'required|integer|min:1|max:100',
            'kids'         => 'required|integer|min:0|max:100',
            'total_amount' => 'nullable|numeric|min:0|max:99999999',
            'status'       => ['required', Rule::in(array_keys(Booking::STATUSES))],
            'message'      => 'nullable|string|max:5000',
            'admin_notes'  => 'nullable|string|max:5000',
        ];
        $data = $request->validate($rules);
        $data = array_merge(array_fill_keys(array_keys($rules), null), $data);

        $package = Package::where('name', $data['service_name'])->first();

        return [
            'cus_name'     => $data['cus_name'],
            'email'        => $data['email'],
            'contact_no'   => $data['contact_no'],
            'datetime'     => Carbon::parse($data['datetime'])->toDateString(),
            'service_name' => $data['service_name'],
            'package_id'   => $package ? $package->id : null,
            'persons'      => Booking::formatPersons($data['adults']),
            'kids'         => (string) $data['kids'],
            'total_amount' => $data['total_amount'],
            'status'       => $data['status'],
            'message'      => $data['message'],
            'admin_notes'  => $data['admin_notes'],
        ];
    }

    protected function availabilityError(Request $request, array $data, $ignoreId)
    {
        if ($request->boolean('override_availability') || $data['status'] === 'cancelled') {
            return null;
        }
        $package = $data['package_id'] ? Package::find($data['package_id']) : null;
        if (!$package) {
            return null;
        }
        $guests = Booking::parseCount($data['persons']) + (int) $data['kids'];
        $error = $package->availabilityError($data['datetime'], $guests, $ignoreId);

        return $error ? $error . ' Tick "Ignore availability limits" to save anyway.' : null;
    }

    /** Emails the customer when requested. Returns an error message or null. */
    protected function maybeNotify(Request $request, Booking $booking)
    {
        if (!$request->boolean('notify_customer') || empty($booking->email)) {
            return null;
        }
        try {
            Mail::to($booking->email)->send(new BookingStatusMail($booking, $request->input('notify_message')));
            return null;
        } catch (\Throwable $e) {
            report($e);
            return 'The status email could not be sent (' . \Illuminate\Support\Str::limit($e->getMessage(), 120) . ').';
        }
    }
}
