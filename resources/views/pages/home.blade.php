@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container text-center py-5">
    <img src="{{ asset('images/logo.png') }}" alt="Thibitisha Logo" class="img-fluid mb-4" style="max-height: 200px;">
    
    <h1 class="mt-4">Welcome to Thibitisha</h1>
    <p class="lead text-muted">Your trusted medical verification platform.</p>

    <a href="/verify" class="btn btn-secondary mt-4">Start Verification</a>
</div>
@endsection


