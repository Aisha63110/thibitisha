
@extends('layouts.admin')
 
{{-- Page Title in Browser Tab --}}
@section('title', 'Practitioners Management')
 
{{-- Page Heading --}}
@section('page-title', 'Practitioners')
 
{{-- Breadcrumb --}}
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Practitioners</li>
@endsection
 
{{-- Main Content --}}
@section('content')
<div class="row">
     <livewire:practitioners />
</div>
@endsection
 
{{-- Page-specific Scripts --}}
@push('scripts')
@livewireScripts()
<script>
  console.log('Statuses index page loaded');

  // Auto-hide alerts after 5 seconds
  setTimeout(function() {
    document.querySelectorAll('.alert').forEach(function(alert) {
      let bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    });
  }, 5000);
</script>
@endpush

{{-- page specific styles --}}
@push('styles')
    @livewireStyles()
@endpush


