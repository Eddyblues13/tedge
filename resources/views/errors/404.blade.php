@extends('errors.layout')

@section('title', '404 Not Found')
@section('code', '404')
@section('icon', 'bi-compass')
@section('heading', 'Page Not Found')
@section('description', 'The page you\'re looking for doesn\'t exist or has been moved. Double-check the URL or navigate
back to familiar territory.')

@section('actions')
<a href="/" class="error-btn-primary">
    <i class="bi bi-house"></i> Back to Home
</a>
<a href="javascript:history.back()" class="error-btn-secondary">
    <i class="bi bi-arrow-left"></i> Go Back
</a>
@endsection