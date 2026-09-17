@extends('errors.layout')

@section('title', '401 Unauthorized')
@section('code', '401')
@section('icon', 'bi-person-lock')
@section('heading', 'Unauthorized Access')
@section('description', 'You need to be authenticated to access this resource. Please log in with valid credentials and
try again.')

@section('actions')
<a href="{{ route('login.page') }}" class="error-btn-primary">
    <i class="bi bi-box-arrow-in-right"></i> Log In
</a>
<a href="/" class="error-btn-secondary">
    <i class="bi bi-house"></i> Home
</a>
@endsection