@extends('errors.layout')

@section('title', '403 Forbidden')
@section('code', '403')
@section('icon', 'bi-shield-exclamation')
@section('heading', 'Access Denied')
@section('description', 'You don\'t have permission to access this page. If you believe this is an error, please contact
support for assistance.')

@section('actions')
<a href="javascript:history.back()" class="error-btn-primary">
    <i class="bi bi-arrow-left"></i> Go Back
</a>
<a href="/" class="error-btn-secondary">
    <i class="bi bi-house"></i> Home
</a>
@endsection