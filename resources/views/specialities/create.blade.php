@extends('layouts.admin')

@section('title','Add Speciality')

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
              <div class = "card-title">Add Speciality </div>
            </div>
            <form action = "{{ route('specialities.store')}}" method="POST">
                @csrf
                <div class = "card-body">---
                </div>
                   <label for= "name" class="form-label">Name</label>
                   <input required type = "text" name="name" value="{{ old('name') }}" class="form-control">
                </div>
                <div class = "card-footer">
                    <button type="submit" class = "btn btn-primary">
                        <i class= "bi-icons bi-save"></i> submit
                    </button>
                </div>


   </div>
</div>   

@endsection