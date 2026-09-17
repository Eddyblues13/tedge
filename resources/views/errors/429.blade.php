@extends('errors.layout')

@section('title', '429 Too Many Requests')
@section('code', '429')
@section('icon', 'bi-speedometer2')
@section('heading', 'Too Many Requests')
@section('description', 'You\'ve made too many requests in a short period. Please slow down and try again in a few
moments.')

@section('actions')
<a href="javascript:setTimeout(() => location.reload(), 2000)" class="error-btn-primary">
    <i class="bi bi-arrow-clockwise"></i> Try Again
</a>
<a href="/" class="error-btn-secondary">
    <i class="bi bi-house"></i> Home
</a>
@endsection