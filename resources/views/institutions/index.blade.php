@extends('layouts.admin')

@section('title', 'Institutions Management')
@section('page-title', 'Institutions')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item active">Institutions</li>
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">All Institutions</h3>
    <div class="card-tools">
      <a href="{{ route('institutions.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Add New Institution
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
        @foreach($institutions as $institution)
        <tr>
          <td>{{ $institution->id }}</td>
          <td>{{ $institution->name }}</td>
          <td>{{ $institution->abbrev }}</td>
          <td>{{ $institution->description }}</td>
          <td>{{ $institution->created_at->format('F j, Y') }}</td>
          <td>
            <a href="{{ route('institutions.edit', $institution->id) }}" class="btn btn-warning btn-sm">
              <i class="bi bi-pencil"></i>
            </a>
            <form action="{{ route('institutions.destroy', $institution->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this institution?')">
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
