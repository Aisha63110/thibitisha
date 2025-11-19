@extends('layouts.admin')

@section('title', 'Degrees Management')
@section('page-title', 'Degrees')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item active">Degrees</li>
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">All Degrees</h3>
    <div class="card-tools">
      <a href="{{ route('degrees.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Add New Degree
      </a>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Abbreviation</th>
          <th>Description</th>
          <th>Created At</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($degrees as $degree)
        <tr>
          <td>{{ $degree->id }}</td>
          <td>{{ $degree->name }}</td>
          <td>{{ $degree->abbrev }}</td>
          <td>{{ $degree->description }}</td>
          <td>{{ $degree->created_at->format('F j, Y') }}</td>
          <td>
            <a href="{{ route('degrees.edit', $degree->id) }}" class="btn btn-warning btn-sm">
              <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('degrees.destroy', $degree->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this degree?')">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
