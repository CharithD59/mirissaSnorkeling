<?php

namespace App\Http\Controllers;

use App\Mail\BookMail;
use App\Mail\ContactMail;
use App\Models\Booking;
use App\Models\ContactInquiry;
use App\Models\GalleryImage;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function home()
    {
        return view('home', [
            'packages'     => $this->safe(function () {
                return Package::query()->where('show_on_home', true)->ordered()->get();
            }),
            'homeGallery'  => $this->safe(function () {
                return GalleryImage::active()->where('show_on_home', true)->ordered()->limit(6)->get();
            }),
        ]);
    }

    public function view_booking_page()
    {
        return view('view_booking_page', [
            'packages' => $this->safe(function () {
                return Package::active()->ordered()->get();
            }),
        ]);
    }

    public function send_contact_mail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cus_name' => 'required|string|max:191',
            'email'    => 'required|email|max:191',
            'mobi_num' => 'required|string|max:50',
            'message'  => 'required|string|max:5000',
        ]);
        if ($validator->fails()) {
            return response($validator->errors()->first(), 422);
        }

        $inquiry = ContactInquiry::create([
            'cus_name' => $request->input('cus_name'),
            'email'    => $request->input('email'),
            'mobi_num' => $request->input('mobi_num'),
            'message'  => $request->input('message'),
            'status'   => 'pending',
        ]);

        $data = [
            $inquiry->cus_name,
            $inquiry->email,
            $inquiry->mobi_num,
            $inquiry->message,
        ];

        try {
            Mail::to(setting('contact.notify_email', 'info@mirissabaybluewhalesnorkelingtour.com'))->send(new ContactMail($data));
        } catch (\Throwable $e) {
            // The inquiry is saved and visible in the admin panel even if the notification email fails.
            report($e);
        }

        echo 'success';
    }

    public function send_booking_mail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'           => 'required|string|max:191',
            'email'          => 'required|email|max:191',
            'contact_no'     => 'required|string|max:50',
            'datetime'       => 'required|date|after_or_equal:today',
            'selectServices' => 'required|string|max:191',
            'SelectPerson'   => 'required|string|max:50',
            'SelectKids'     => 'nullable|string|max:20',
            'message'        => 'nullable|string|max:5000',
        ], [
            'datetime.after_or_equal' => 'Please choose a tour date from today onwards.',
        ]);
        if ($validator->fails()) {
            return response($validator->errors()->first(), 422);
        }

        $service = $request->input('selectServices');
        $persons = $request->input('SelectPerson');
        $kids = (string) $request->input('SelectKids', '0');
        $date = Carbon::parse($request->input('datetime'))->toDateString();

        $package = $this->safe(function () use ($service) {
            return Package::where('name', $service)->first();
        }, null);

        if ($package) {
            $guests = Booking::parseCount($persons) + Booking::parseCount($kids);
            if ($error = $package->availabilityError($date, $guests)) {
                return response($error, 422);
            }
        }

        $booking = Booking::create([
            'cus_name'     => $request->input('name'),
            'email'        => $request->input('email'),
            'contact_no'   => $request->input('contact_no'),
            'datetime'     => $date,
            'service_name' => $service,
            'package_id'   => $package ? $package->id : null,
            'persons'      => $persons,
            'kids'         => $kids,
            'message'      => $request->input('message'),
            'status'       => 'pending',
            'source'       => 'website',
        ]);

        $data = [
            $booking->cus_name,
            $booking->email,
            $booking->contact_no,
            $booking->datetime,
            $booking->service_name,
            $booking->persons,
            $booking->kids,
            $booking->message,
        ];

        try {
            Mail::to(setting('contact.notify_email', 'info@mirissabaybluewhalesnorkelingtour.com'))->send(new BookMail($data));
        } catch (\Throwable $e) {
            // The booking is saved and visible in the admin panel even if the notification email fails.
            report($e);
        }

        echo 'success';
    }

    public function logWhatsappClick(Request $request)
    {
        DB::table('whatsapp_click_logs')->insert([
            'phone' => $request->phone,
            'action' => $request->action,
            'ip' => $request->ip(),
            'created_at' => now(),
        ]);

        return response()->json(['status' => 'success']);
    }

    public function view_gallery_section()
    {
        return view('view_gallery_section', [
            'images' => $this->safe(function () {
                return GalleryImage::active()->where('show_in_gallery', true)->ordered()->get();
            }),
        ]);
    }

    public function view_blue_whale_snorkeling()
    {
        return view('view_blue_whale_snorkeling');
    }

    /**
     * Runs a database read and falls back to an empty collection (or $default) when the
     * admin tables have not been migrated yet, so the public site never breaks.
     */
    protected function safe(callable $callback, $default = 'collection')
    {
        try {
            return $callback();
        } catch (\Throwable $e) {
            report($e);
            return $default === 'collection' ? collect() : $default;
        }
    }
}
