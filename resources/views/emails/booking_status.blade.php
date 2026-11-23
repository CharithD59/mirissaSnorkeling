@extends('emails.layout')

@section('content')
    <p>Dear {{ $booking->cus_name }},</p>

    @if($booking->status === 'confirmed')
        <p>Great news! Your booking has been <strong style="color:#06A3DA;">confirmed</strong>. We look forward to seeing you.</p>
    @elseif($booking->status === 'cancelled')
        <p>Your booking has been <strong style="color:#dc3545;">cancelled</strong>. If you think this is a mistake, please contact us.</p>
    @elseif($booking->status === 'completed')
        <p>Thank you for joining us! We hope you had an unforgettable experience. We would love a review on Google.</p>
    @else
        <p>Your booking status is now <strong>{{ $booking->status_label }}</strong>.</p>
    @endif

    @if($note)
        <p>{!! nl2br(e($note)) !!}</p>
    @endif

    <table cellpadding="6" cellspacing="0" style="width:100%;border-collapse:collapse;font-size:14px;margin:16px 0;">
        <tr><td style="color:#6b7a90;width:40%;">Reference</td><td><strong>{{ $booking->reference }}</strong></td></tr>
        <tr><td style="color:#6b7a90;">Tour</td><td>{{ $booking->service_name }}</td></tr>
        <tr><td style="color:#6b7a90;">Date</td><td>{{ $booking->tour_date ? $booking->tour_date->format('l, d F Y') : $booking->datetime }}</td></tr>
        <tr><td style="color:#6b7a90;">Guests</td><td>{{ $booking->adult_count }} adult(s), {{ $booking->kid_count }} kid(s)</td></tr>
        @if($booking->total_amount)
            <tr><td style="color:#6b7a90;">Amount</td><td>${{ number_format($booking->total_amount, 2) }}</td></tr>
        @endif
    </table>

    <p>Questions? Call or WhatsApp us on {{ setting('contact.phone') }}.</p>
    <p>Kind regards,<br>{{ setting('site.name') }}</p>
@endsection
