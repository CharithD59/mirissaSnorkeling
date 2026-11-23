@extends('emails.layout')

@section('content')
    <p>Dear {{ $inquiry->cus_name }},</p>
    <div>{!! nl2br(e($reply->body)) !!}</div>
    <p style="margin-top:24px;">Kind regards,<br>{{ setting('site.name') }}</p>

    <hr style="border:none;border-top:1px solid #e3eef6;margin:24px 0;">
    <p style="font-size:13px;color:#6b7a90;margin:0 0 6px;">Your original message ({{ optional($inquiry->cre_datetime ? \Carbon\Carbon::parse($inquiry->cre_datetime) : null)->format('d M Y, H:i') }}):</p>
    <blockquote style="margin:0;padding:10px 14px;background:#f5f9fc;border-left:3px solid #06A3DA;font-size:13px;color:#4a5a70;">
        {!! nl2br(e($inquiry->message)) !!}
    </blockquote>
@endsection
