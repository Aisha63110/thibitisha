@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="text-center">
    <img src="{{ asset('images/logo.png') }}" alt="Thibitisha Logo" style="height: 100px;">
    <h1 class="mt-4">Welcome to Thibitisha</h1>
    <p class="lead">Your trusted medical verification platform.</p>
</div>
@endsection

