@extends('errors.layout')

@section('title', '419 Session Expired')
@section('code', '419')
@section('icon', 'bi-clock-history')
@section('heading', 'Session Expired')
@section('description', 'Your session has expired due to inactivity. Please refresh the page or log in again to continue
where you left off.')

@section('actions')
<a href="javascript:location.reload()" class="error-btn-primary">
    <i class="bi bi-arrow-clockwise"></i> Refresh Page
</a>
<a href="{{ route('login.page') }}" class="error-btn-secondary">
    <i class="bi bi-box-arrow-in-right"></i> Log In
</a>
@endsection