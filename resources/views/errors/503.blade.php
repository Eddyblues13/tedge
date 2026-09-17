@extends('errors.layout')

@section('title', '503 Service Unavailable')
@section('code', '503')
@section('icon', 'bi-wrench-adjustable')
@section('heading', 'Under Maintenance')
@section('description', 'We\'re currently performing scheduled maintenance to improve your experience. We\'ll be back
online shortly — thanks for your patience!')

@section('actions')
<a href="javascript:location.reload()" class="error-btn-primary">
    <i class="bi bi-arrow-clockwise"></i> Check Again
</a>
@endsection