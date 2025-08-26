<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Http\Util;
use Carbon\Carbon;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Mail\BookMail;

class PageController extends Controller{

    public function view_booking_page(){

        return view('view_booking_page');

    }

    public function send_contact_mail(Request $request){

        $cus_name    = $request->input('cus_name');
        $email   = $request->input('email');
        $mobi_num  = $request->input('mobi_num');
        $message = $request->input('message');

        DB::table('tbl_contact_det')
                    ->insert([
                        'cus_name' => $cus_name,
                        'email' => $email,
                        'mobi_num' => $mobi_num,
                        'message' => $message,
                        'cre_datetime' => NOW()
                    ]);

        $data=[
            $name    = $request->input('cus_name'),
            $email   = $request->input('email'),
            $number  = $request->input('mobi_num'),
            $message = $request->input('message')
        ];

        Mail::to('info@mirissabaybluewhalesnorkelingtour.com')->send(new ContactMail($data));

        echo 'success';

    }

    public function send_booking_mail(Request $request){

        $name    = $request->input('name');
        $email   = $request->input('email');
        $datetime  = $request->input('datetime');
        $selectServices = $request->input('selectServices');
        $SelectPerson = $request->input('SelectPerson');
        $SelectKids = $request->input('SelectKids');
        $message = $request->input('message');
        $contact_no = $request->input('contact_no');

        DB::table('tbl_booking_det')
                    ->insert([
                        'cus_name' => $name,
                        'email' => $email,
                        'contact_no' => $contact_no,
                        'datetime' => $datetime,
                        'service_name' => $selectServices,
                        'persons' => $SelectPerson,
                        'kids' => $SelectKids,
                        'message' => $message,
                        'cre_datetime' => NOW()
                    ]);

        $data=[
            $name    = $request->input('name'),
            $email   = $request->input('email'),
            $contact_no   = $request->input('contact_no'),
            $datetime  = $request->input('datetime'),
            $selectServices = $request->input('selectServices'),
            $SelectPerson = $request->input('SelectPerson'),
            $SelectKids = $request->input('SelectKids'),
            $message = $request->input('message')
        ];

        Mail::to('info@mirissabaybluewhalesnorkelingtour.com')->send(new BookMail($data));

        echo 'success';

    }

    public function logWhatsappClick(Request $request){

        DB::table('whatsapp_click_logs')->insert([
            'phone' => $request->phone,
            'action' => $request->action,
            'ip' => $request->ip(),
            'created_at' => now(),
        ]);

        return response()->json(['status' => 'success']);

    }

}