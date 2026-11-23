@extends('admin.layouts.app')

@section('title', 'Inquiry from ' . $inquiry->cus_name)
@section('crumbs')
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <a href="{{ route('admin.inquiries.index') }}">Inquiries</a>
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <span class="current">{{ $inquiry->cus_name }}</span>
@endsection

@section('page_head')
<div class="page-head reveal">
    <div class="d-flex align-items-center gap-3 min-w-0">
        <a href="{{ route('admin.inquiries.index') }}" class="icon-btn" aria-label="Back to inquiries"><i class="bi bi-arrow-left"></i></a>
        <div class="min-w-0">
            <div class="d-flex align-items-center gap-2 flex-wrap"><h1 class="mb-0">{{ $inquiry->cus_name }}</h1>{!! status_badge($inquiry->status) !!}</div>
            <p>Received {{ $inquiry->cre_datetime ? $inquiry->cre_datetime->format('d M Y, H:i') . ' · ' . $inquiry->cre_datetime->diffForHumans() : '' }}</p>
        </div>
    </div>
    <div class="page-actions">
        @foreach(\App\Models\ContactInquiry::STATUSES as $key => $label)
            @if($key !== ($inquiry->status ?: 'pending'))
                <form method="POST" action="{{ route('admin.inquiries.status', $inquiry->getKey()) }}">
                    @csrf @method('PATCH')
                    <input type="hidden" name="status" value="{{ $key }}">
                    <button class="btn btn-secondary" type="submit"><i class="bi {{ ['pending' => 'bi-hourglass', 'replied' => 'bi-reply-all', 'closed' => 'bi-archive'][$key] }}"></i> Mark {{ strtolower($label) }}</button>
                </form>
            @endif
        @endforeach
        <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry->getKey()) }}" data-confirm="This inquiry and its reply history will be deleted." data-confirm-title="Delete this inquiry?">
            @csrf @method('DELETE')
            <button class="btn btn-danger-soft btn-icon" type="submit" aria-label="Delete" data-bs-toggle="tooltip" title="Delete"><i class="bi bi-trash3"></i></button>
        </form>
    </div>
</div>
@endsection

@section('content')
@php $phone = wa_number($inquiry->mobi_num); @endphp
<div class="row g-3 g-xl-4">
    <div class="col-lg-8">
        <div class="panel mb-4 reveal reveal-1">
            <div class="panel-head">
                <h3 class="panel-title"><span class="ic"><i class="bi bi-chat-square-text"></i></span>Conversation</h3>
                <span class="pill"><i class="bi bi-chat-dots"></i>{{ $inquiry->replies->count() + 1 }} message{{ $inquiry->replies->count() ? 's' : '' }}</span>
            </div>
            <div class="panel-body">
                <div class="thread">
                    <div class="msg">
                        <span class="avatar sm round {{ avatar_class($inquiry->email) }}">{{ initials($inquiry->cus_name) }}</span>
                        <div class="bubble">
                            <div class="meta"><strong>{{ $inquiry->cus_name }}</strong><span>{{ $inquiry->cre_datetime ? $inquiry->cre_datetime->format('d M Y, H:i') : '' }}</span></div>
                            <div class="body">{{ $inquiry->message }}</div>
                        </div>
                    </div>
                    @foreach($inquiry->replies as $reply)
                        @php $author = $reply->user ? ($reply->user->name ?: $reply->user->username) : 'Admin'; @endphp
                        <div class="msg me">
                            <span class="avatar sm round {{ avatar_class($reply->user ? $reply->user->username : 'admin') }}">{{ initials($author) }}</span>
                            <div class="bubble">
                                <div class="meta"><strong>{{ $author }} <span class="fw-normal text-muted">· {{ $reply->subject }}</span></strong><span>{{ $reply->created_at->format('d M Y, H:i') }}</span></div>
                                <div class="body">{{ $reply->body }}</div>
                                @if(!$reply->email_sent)
                                    <div class="xsmall text-danger mt-2"><i class="bi bi-exclamation-triangle"></i> Email not delivered: {{ $reply->email_error }}</div>
                                @else
                                    <div class="xsmall text-muted mt-2"><i class="bi bi-check2-all text-success"></i> Delivered by email</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="panel reveal reveal-2" id="reply">
            <div class="panel-head">
                <div>
                    <h3 class="panel-title"><span class="ic"><i class="bi bi-send"></i></span>Reply by email</h3>
                    <p class="panel-sub">To {{ $inquiry->cus_name }} &lt;{{ $inquiry->email }}&gt;</p>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.inquiries.reply', $inquiry->getKey()) }}" class="panel-body" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject', 'Re: Your inquiry – ' . setting('site.name')) }}" required maxlength="191">
                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-2">
                    <label class="form-label d-flex justify-content-between" for="body"><span>Message</span><span class="xsmall text-faint" id="bodyCount">0 characters</span></label>
                    <textarea name="body" id="body" rows="7" class="form-control @error('body') is-invalid @enderror" required placeholder="Write your reply…">{{ old('body') }}</textarea>
                    @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="xsmall text-muted align-self-center me-1">Quick insert:</span>
                    <button type="button" class="btn btn-secondary btn-sm" data-snippet="Thank you for contacting {{ setting('site.name') }}! ">Thank you</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-snippet="You can book online at {{ url('view_booking_page') }} or message us on WhatsApp at {{ setting('contact.phone') }}. ">Booking link</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-snippet="Pickup is from your hotel in Mirissa at 6:00 AM. ">Pickup info</button>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 pt-3 border-top">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="close_after" value="1" id="close_after">
                        <label class="form-check-label small" for="close_after">Mark as closed after sending</label>
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="bi bi-send"></i> Send reply</button>
                </div>
                <p class="xsmall text-faint mb-0 mt-3"><i class="bi bi-info-circle"></i> “Dear {{ $inquiry->cus_name }},” and their original message are added to the email automatically.</p>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel reveal reveal-2" style="position: sticky; top: calc(var(--topbar-h) + 1rem);">
            <div class="panel-body">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="avatar lg round {{ avatar_class($inquiry->email) }}">{{ initials($inquiry->cus_name) }}</span>
                    <div class="min-w-0"><div class="fw-700 text-truncate" style="font-size:1.05rem">{{ $inquiry->cus_name }}</div><div class="small text-muted">Website visitor</div></div>
                </div>
                <div class="info-list mb-3">
                    <div class="r"><i class="bi bi-envelope"></i><div class="min-w-0"><div class="k">Email</div><div class="v"><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></div></div></div>
                    <div class="r"><i class="bi bi-telephone"></i><div class="min-w-0"><div class="k">Phone</div><div class="v">{{ $inquiry->mobi_num ?: '—' }}</div></div></div>
                    <div class="r"><i class="bi bi-clock-history"></i><div class="min-w-0"><div class="k">Last replied</div><div class="v">{{ $inquiry->replied_at ? $inquiry->replied_at->format('d M Y, H:i') : 'Not yet' }}</div></div></div>
                </div>
                <div class="d-grid gap-2">
                    @if($phone)<a class="btn btn-whatsapp" target="_blank" rel="noopener" href="https://wa.me/{{ $phone }}"><i class="bi bi-whatsapp"></i> WhatsApp</a>@endif
                    <a class="btn btn-secondary" href="{{ route('admin.bookings.create', ['name' => $inquiry->cus_name, 'email' => $inquiry->email, 'phone' => $inquiry->mobi_num]) }}"><i class="bi bi-calendar-plus"></i> Create booking</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var body = document.getElementById('body'), count = document.getElementById('bodyCount');
    function update() { count.textContent = body.value.length + ' characters'; }
    body.addEventListener('input', update); update();
    document.querySelectorAll('[data-snippet]').forEach(function (b) {
        b.addEventListener('click', function () {
            var s = b.dataset.snippet, start = body.selectionStart || body.value.length;
            body.value = body.value.slice(0, start) + s + body.value.slice(body.selectionEnd || start);
            body.focus(); body.selectionStart = body.selectionEnd = start + s.length; update();
        });
    });
})();
</script>
@endpush
