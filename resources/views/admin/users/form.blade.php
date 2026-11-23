@extends('admin.layouts.app')

@php $editing = $user->exists; @endphp
@section('title', $editing ? 'Edit team member' : 'Add team member')
@section('subtitle', $editing ? 'Update details or reset the password for @' . $user->username . '.' : 'Give someone access to the admin panel.')
@section('crumbs')
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <a href="{{ route('admin.users.index') }}">Team</a>
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <span class="current">{{ $editing ? $user->username : 'New' }}</span>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <form method="POST" action="{{ $editing ? route('admin.users.update', $user) : route('admin.users.store') }}" class="panel reveal reveal-1" novalidate>
            @csrf
            @if($editing) @method('PUT') @endif
            <div class="panel-body">
                <div class="form-section">
                    <div class="form-section-head"><span class="ic"><i class="bi bi-person-badge"></i></span><div><h3>Profile</h3><p>Name, username and email address</p></div></div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="name">Full name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="username">Username</label>
                            <div class="with-icon"><i class="bi bi-at"></i><input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" required></div>
                            @error('username')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="email">Email</label>
                            <div class="with-icon"><i class="bi bi-envelope"></i><input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required></div>
                            @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <div class="form-section-head"><span class="ic"><i class="bi bi-key"></i></span><div><h3>{{ $editing ? 'Reset password' : 'Password' }}</h3><p>{{ $editing ? 'Leave empty to keep the current password' : 'At least 3 characters' }}</p></div></div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="password">{{ $editing ? 'New password' : 'Password' }}</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="password_confirmation">Confirm password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <div class="toggle-row">
                        <div><div class="t">Account active</div><div class="d">{{ $editing && $user->id === auth()->id() ? 'You cannot disable your own account' : 'Disabled members cannot sign in' }}</div></div>
                        <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" name="is_active" value="1" @if(old('is_active', $user->is_active)) checked @endif @if($editing && $user->id === auth()->id()) disabled checked @endif aria-label="Account active"></div>
                    </div>
                </div>
            </div>
            <div class="sticky-bar">
                <a href="{{ route('admin.users.index') }}" class="btn btn-ghost">Cancel</a>
                <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i> {{ $editing ? 'Save changes' : 'Add member' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
