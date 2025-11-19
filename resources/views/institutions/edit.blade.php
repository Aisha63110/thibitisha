@extends('layouts.admin')

@section('title', 'Edit Institution')
@section('page-title', 'Edit Institution')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('institutions.index') }}">Institutions</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('institutions.update', $institution->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="name" class="form-label">Institution Name</label>
        <input type="text" name="name" class="form-control" value="{{ $institution->name }}" required>
      </div>
      <div class="mb-3">
        <label for="abbrev" class="form-label">Abbreviation</label>
        <input type="text" name="abbrev" class="form-control" value="{{ $institution->abbrev }}">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $institution->description }}</textarea>
      </div>
      <button type="submit" class="btn btn-thibitisha">
        <i class="bi bi-save"></i> Update Institution
      </button>
    </form>
  </div>
</div>
@endsection
