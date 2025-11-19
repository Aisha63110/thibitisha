@extends('layouts.admin')

@section('title', 'Edit Degree')
@section('page-title', 'Edit Degree')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('degrees.index') }}">Degrees</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('degrees.update', $degree->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="name" class="form-label">Degree Name</label>
        <input type="text" name="name" class="form-control" value="{{ $degree->name }}" required>
      </div>
      <div class="mb-3">
        <label for="abbrev" class="form-label">Abbreviation</label>
        <input type="text" name="abbrev" class="form-control" value="{{ $degree->abbrev }}">
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $degree->description }}</textarea>
      </div>
      <button type="submit" class="btn btn-thibitisha">
        <i class="bi bi-save"></i> Update Degree
      </button>
    </form>
  </div>
</div>
@endsection
