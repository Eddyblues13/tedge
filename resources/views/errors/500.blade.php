@extends('errors.layout')

@section('title', '500 Server Error')
@section('code', '500')
@section('icon', 'bi-exclamation-octagon')
@section('heading', 'Something Went Wrong')
@section('description', 'We\'re experiencing an internal server error. Our team has been notified and is working on it.
Please try again shortly.')

@section('actions')
<a href="javascript:location.reload()" class="error-btn-primary">
    <i class="bi bi-arrow-clockwise"></i> Try Again
</a>
<a href="/" class="error-btn-secondary">
    <i class="bi bi-house"></i> Home
</a>
@endsection