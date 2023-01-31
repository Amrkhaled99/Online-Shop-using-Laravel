@extends('layouts.admin')
@section('content')
    <h2>Add Admin</h2>
    <form method="POST" action="{{ url('admin/users') }}" enctype="multipart/form-data">
        @csrf
        <label>Name</label>
        <input class="form-control" name="name" value="{{ old('name') }}" />
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        <label>Email</label>
        <input class="form-control" name="email" type="email" value="{{ old('email') }}" />
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
     

        <label>Password</label>
        <input class="form-control" name="password"  type="password" value="{{ old('password') }}" />
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br>



        <button class="btn btn-primary">Add</button>
        <a class="btn btn-secondary" href="{{ url('admin/users') }}">Cancel</a>
    </form>
@endsection
