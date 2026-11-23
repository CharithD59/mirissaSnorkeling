@extends('admin.layouts.app')

@section('title', 'Team')
@section('subtitle', 'People who can sign in to this admin panel.')
@section('actions')
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="bi bi-person-plus"></i> Add team member</a>
@endsection

@section('content')
<div class="panel reveal reveal-1">
    <div class="table-wrap">
        <table class="data-table stack">
            <thead><tr><th>Member</th><th>Username</th><th>Role</th><th>Last sign-in</th><th>Status</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @foreach($users as $u)
                <tr>
                    <td class="cell-main">
                        <div class="cell-user">
                            <span class="avatar round {{ avatar_class($u->username) }}">{{ $u->initials }}</span>
                            <div class="who"><div class="n">{{ $u->name }} @if($u->id === auth()->id())<span class="badge-status badge-primary ms-1" style="height:20px">You</span>@endif</div><div class="e">{{ $u->email }}</div></div>
                        </div>
                    </td>
                    <td data-label="Username"><span class="ref">{{ '@' . $u->username }}</span></td>
                    <td data-label="Role"><span class="pill"><i class="bi bi-shield-check"></i>{{ ucfirst($u->role ?: 'admin') }}</span></td>
                    <td data-label="Last sign-in" class="text-nowrap">{{ $u->last_login_at ? $u->last_login_at->diffForHumans() : 'Never' }}</td>
                    <td data-label="Status">{!! $u->is_active ? '<span class="badge-status badge-success">Active</span>' : '<span class="badge-status badge-secondary">Disabled</span>' !!}</td>
                    <td class="text-end cell-actions text-nowrap">
                        <a href="{{ route('admin.users.edit', $u) }}" class="icon-btn sm plain" aria-label="Edit" data-bs-toggle="tooltip" title="Edit"><i class="bi bi-pencil-square"></i></a>
                        @if($u->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="d-inline" data-confirm="{{ $u->name }} will no longer be able to sign in." data-confirm-title="Remove {{ '@' . $u->username }}?" data-confirm-button="Remove">
                                @csrf @method('DELETE')
                                <button class="icon-btn sm plain text-danger" type="submit" data-no-loading aria-label="Delete"><i class="bi bi-trash3"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
