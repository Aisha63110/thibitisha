@extends('layouts.admin')

@section('title','Add user')

{{-- define breadcrumb & anyother --}}

@section('content')

<div class= "row">
   <div class = "col-md-12">
   {{-- show error messages --}}
   @if ($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif
      <div class = "card card-primary card-outline mb-4">
          <div class = "card-header">
              <div class = "card-title">Add user </div>
            </div>
            <form action = "{{ route('users.store')}}" method="POST">
                @csrf
                <div class = "card-body">---
                </div>
                   <label for= "name" class="form-label">Name</label>
                   <input required type = "name" name="name" class="form-control">
                </div>

                </div>
                   <label for= "email" class="form-label">Email</label>
                   <input required type = "email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>

                    <select name= "role" class="form-control">
                        <option value="">--please Select Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>{{ $role->description }}</option>
                        @endforeach

                    </select>   
                </div>
                <div class = "card-footer">
                    <button type="submit" class = "btn btn-primary">
                        <i class= "bi-icons bi-save"></i> submit
                    </button>
                </div>


   </div>
</div>   

@endsection