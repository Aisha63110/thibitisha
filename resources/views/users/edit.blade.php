@extends('layouts.admin')

@section('title','Edit User')

{{-- Breadcrumb --}}
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
  <li class="breadcrumb-item active" aria-current="page">Edit User</li>
@endsection

{{-- Main Content --}}
@section('content')
<div class="row">
   <div class="col-md-12">
      {{-- Show error messages --}}
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif

      <div class="card card-primary card-outline mb-4">
          <div class="card-header">
              <div class="card-title">Edit User</div>
          </div>

          {{-- IMPORTANT: Pass $user->id and use PUT --}}
          <form action="{{ route('users.update', $user->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="card-body">
                  <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input required value="{{ old('name', $user->name) }}" 
                             type="text" name="name" class="form-control">
                  </div>

                  <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input required type="email" 
                             value="{{ old('email', $user->email) }}" 
                             name="email" class="form-control">
                  </div>

                  <div class="mb-3">
                      <label for="role" class="form-label">Role</label>
                      <select name="role" class="form-control">
                          <option value="">-- Please Select Role --</option>
                          @foreach($roles as $role)
                              <option value="{{ $role->id }}" 
                                  {{ old('role', $user->role_id) == $role->id ? 'selected' : '' }}>
                                  {{ $role->name }}
                              </option>
                          @endforeach
                      </select>
                  </div>
              </div>

              <div class="card-footer">
                  <button type="submit" class="btn btn-primary">
                      <i class="bi bi-save"></i> Update User
                  </button>
              </div>
          </form>
      </div>
   </div>
</div>
@endsection

