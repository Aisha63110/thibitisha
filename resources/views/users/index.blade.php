@extends('layouts.admin')
 
{{-- Page Title in Browser Tab --}}
@section('title', 'Users')
 
{{-- Page Heading --}}
@section('page-title', 'Users')
 
{{-- Breadcrumb --}}
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection
 
{{-- Main Content --}}
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">All Users</h3>
        <div class="card-tools">
          <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New User
          </a>
        </div>
      </div>
     
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Created At</th>
              <th style="width: 200px">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->name }}</td>
              <td>
                {{ $user->email }}
                @if(!is_null($user->email_verified_at))
                  <span class="badge bg-danger">
                      <i class="bi bi-x-circle" title="Email not verified"></i>
                  </span>
                @else
                  <span class="badge bg-success">
                      <i class="bi bi-check-circle" title="Email verified"></i>
                  </span>
                @endif
              </td>
              
              <td>{{ $user->role ? $user->role->name : '—' }}</td>
              <td>{{ $user->created_at->format('M d, Y') }}</td>
              <td>
                <div class="btn-group" role="group">
                  {{-- Edit --}}
                  <a href="{{ route('users.edit', $user->id) }}" 
                     class="btn btn-warning btn-sm"
                     title="Edit">
                    <i class="bi bi-pencil"></i>
                  </a>

                  {{-- Reset Password --}}
                  <form action="{{ route('users.reset_password', $user->id) }}" 
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Are you sure you want to reset this password?');">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-secondary btn-sm" title="Reset Password">
                      <i class="bi bi-key"></i>
                    </button>
                  </form>

                  {{-- Delete User --}}
                  <form action="{{ route('users.destroy', $user->id) }}" 
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="card-footer clearfix">
        {{ $users->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>
@endsection
 
{{-- Page-specific Scripts --}}
@push('scripts')
<script>
  console.log('Users index page loaded');
  setTimeout(function() {
    document.querySelectorAll('.alert').forEach(function(alert) {
      let bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    });
  }, 5000);
</script>
@endpush
