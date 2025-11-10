@extends('layouts.admin')

@section('title','Edit Speciality')

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
              <div class = "card-title"> Edit Speciality </div>
            </div>
            <form action = "{{ route('specialities.update', $speciality->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class = "card-body">---
                </div>
                   <label for= "name" class="form-label">Name</label>
                   <input required type = "text" name="name" value="{{ old('name',$speciality->name) }}" class="form-control">
                </div>
                <div class = "card-footer">
                    <button type="submit" class = "btn btn-primary">
                        <i class= "bi-icons bi-save"></i> submit
                    </button>
                </div>


   </div>
</div>   

@endsection