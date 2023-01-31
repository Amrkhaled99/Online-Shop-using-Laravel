@extends('layouts.admin')
@section('content')
    <h2>Edit Category</h2>
    <form method="POST"  action="{{ url('admin/users/'.$user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Name</label>
        <input class="form-control" name="name" value="{{old('name', $user->name)}}" />

        
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        <label>Email</label>
        <input class="form-control" name="email" value="{{old('email', $user->email)}}" />
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        <label>Current Password</label>
        <input class="form-control" name="cpassword"  type="password" value="{{ old('cpassword') }}" />
        @error('cpassword')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        <label>New Password</label>
        <input class="form-control" name="npassword"  type="password" value="{{ old('npassword') }}" />
        @error('npassword')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>


      
        <button class="btn btn-primary">Edit</button>
        <a class="btn btn-secondary" href="{{ url('admin/users') }}">Cancel</a>
    </form>
@endsection
