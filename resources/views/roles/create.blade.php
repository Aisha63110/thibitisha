@extends('layouts.admin')

@section('title','Add Role')

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
              <div class = "card-title">Add Role </div>
            </div>
            <form action = "{{ route('roles.store')}}" method="POST">
                @csrf
                <div class = "card-body">---
                </div>
                   <label for= "name" class="form-label">Name</label>
                   <input required type = "name" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class = "card-footer">
                    <button type="submit" class = "btn btn-primary">
                        <i class= "bi-icons bi-save"></i> submit
                    </button>
                </div>


   </div>
</div>   

@endsection