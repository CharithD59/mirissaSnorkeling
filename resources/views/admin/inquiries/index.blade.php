@extends('admin.layouts.app')

@section('title', 'Inquiries')
@section('subtitle', 'Messages sent through the Contact Us form.')

@section('content')
@php
    $currentStatus = request('status');
    $unread = $inquiries->getCollection()->where('is_read', false)->count();
@endphp

<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3 reveal reveal-1">
    <div class="segmented" role="tablist" aria-label="Status">
        <a href="{{ route('admin.inquiries.index', request()->except(['status', 'page'])) }}" class="{{ !$currentStatus ? 'active' : '' }}"><i class="bi bi-inbox"></i> All <span class="count">{{ $counts['all'] }}</span></a>
        @foreach(\App\Models\ContactInquiry::STATUSES as $key => $label)
            <a href="{{ route('admin.inquiries.index', array_merge(request()->except('page'), ['status' => $key])) }}" class="{{ $currentStatus === $key ? 'active' : '' }}">{{ $label }} <span class="count">{{ $counts[$key] }}</span></a>
        @endforeach
    </div>
    @if($unread)<span class="pill"><span class="new-dot"></span>{{ $unread }} unread on this page</span>@endif
</div>

<div class="panel reveal reveal-2">
    <form class="toolbar" method="GET" action="{{ route('admin.inquiries.index') }}">
        @if($currentStatus)<input type="hidden" name="status" value="{{ $currentStatus }}">@endif
        <div class="with-icon grow">
            <i class="bi bi-search"></i>
            <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search name, email, phone or message">
        </div>
        <div class="input-group" style="width:auto"><span class="input-group-text">From</span><input type="date" name="from" value="{{ request('from') }}" class="form-control" aria-label="Received from" style="max-width:160px"></div>
        <div class="input-group" style="width:auto"><span class="input-group-text">To</span><input type="date" name="to" value="{{ request('to') }}" class="form-control" aria-label="Received to" style="max-width:160px"></div>
        <select name="sort" class="form-select" style="width:auto" data-autosubmit aria-label="Sort">
            <option value="newest">Newest first</option>
            <option value="oldest" @if(request('sort') === 'oldest') selected @endif>Oldest first</option>
        </select>
        <button class="btn btn-primary" type="submit"><i class="bi bi-funnel"></i> Filter</button>
        @if(request()->hasAny(['q', 'from', 'to']))
            <a href="{{ route('admin.inquiries.index', $currentStatus ? ['status' => $currentStatus] : []) }}" class="btn btn-ghost">Clear</a>
        @endif
    </form>

    <div class="table-wrap">
        <table class="data-table stack">
            <thead>
            <tr><th>From</th><th>Message</th><th>Received</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            @forelse($inquiries as $inquiry)
                <tr data-href="{{ route('admin.inquiries.show', $inquiry->getKey()) }}" class="{{ $inquiry->is_read ? '' : 'unread' }}">
                    <td class="cell-main" style="min-width: 230px">
                        <div class="cell-user">
                            <span class="avatar round {{ avatar_class($inquiry->email) }}">{{ initials($inquiry->cus_name) }}</span>
                            <div class="who">
                                <div class="n strong">{{ $inquiry->cus_name }} @if(!$inquiry->is_read)<span class="new-dot ms-1" title="Unread"></span>@endif</div>
                                <div class="e">{{ $inquiry->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td data-label="Message" style="max-width: 440px">
                        <div class="text-2 text-truncate" style="max-width: 420px">{{ $inquiry->message }}</div>
                        @if($inquiry->replies_count)
                            <div class="xsmall text-muted mt-1"><i class="bi bi-reply-all"></i> {{ $inquiry->replies_count }} repl{{ $inquiry->replies_count === 1 ? 'y' : 'ies' }} sent</div>
                        @endif
                    </td>
                    <td data-label="Received" class="text-nowrap">
                        <div class="strong tabular">{{ $inquiry->cre_datetime ? $inquiry->cre_datetime->format('d M Y') : '—' }}</div>
                        <div class="xsmall text-muted">{{ $inquiry->cre_datetime ? $inquiry->cre_datetime->diffForHumans() : '' }}</div>
                    </td>
                    <td data-label="Status">{!! status_badge($inquiry->status) !!}</td>
                    <td class="text-end cell-actions text-nowrap">
                        <a href="{{ route('admin.inquiries.show', $inquiry->getKey()) }}#reply" class="btn btn-soft btn-sm d-none d-md-inline-flex"><i class="bi bi-reply"></i> Reply</a>
                        <div class="dropdown d-inline-block">
                            <button class="icon-btn sm plain" data-bs-toggle="dropdown" aria-label="More actions"><i class="bi bi-three-dots"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.inquiries.show', $inquiry->getKey()) }}#reply"><i class="bi bi-reply"></i>Reply</a></li>
                                <li class="dropdown-header">Mark as</li>
                                @foreach(\App\Models\ContactInquiry::STATUSES as $key => $label)
                                    @if($key !== ($inquiry->status ?: 'pending'))
                                        <li>
                                            <form method="POST" action="{{ route('admin.inquiries.status', $inquiry->getKey()) }}">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="{{ $key }}">
                                                <button class="dropdown-item" type="submit" data-no-loading><i class="bi {{ ['pending' => 'bi-hourglass', 'replied' => 'bi-reply-all', 'closed' => 'bi-archive'][$key] }}"></i>{{ $label }}</button>
                                            </form>
                                        </li>
                                    @endif
                                @endforeach
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry->getKey()) }}" data-confirm="The message from {{ $inquiry->cus_name }} and its reply history will be deleted." data-confirm-title="Delete this inquiry?">
                                        @csrf @method('DELETE')
                                        <button class="dropdown-item danger" type="submit" data-no-loading><i class="bi bi-trash3"></i>Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5"><div class="empty"><div class="art"><i class="bi bi-inbox"></i></div><h4>No inquiries here</h4><p>When customers use the contact form, their messages land in this inbox.</p></div></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @include('admin.partials.pagination', ['items' => $inquiries, 'noun' => 'inquiries'])
</div>
@endsection
