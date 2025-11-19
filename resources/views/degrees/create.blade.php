@extends('layouts.admin')

@section('title', 'Add Degree')
@section('page-title', 'Add New Degree')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('degrees.index') }}">Degrees</a></li>
  <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('degrees.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Degree Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="abbrev" class="form-label">Abbreviation</label>
        <input type="text" name="abbrev" class="form-control">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-thibitisha">
        <i class="bi bi-check-circle"></i> Save Degree
      </button>
    </form>
  </div>
</div>
@endsection
