@extends('layouts.admin')
@section('content')
    <h2>Add Admin</h2>
    <form method="POST" action="{{ url('admin/sizes') }}" enctype="multipart/form-data">
        @csrf
        <label>Name</label>
        <input class="form-control" name="name" value="{{ old('name') }}" />
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror



        <button class="btn btn-primary">Add</button>
        <a class="btn btn-secondary" href="{{ url('admin/sizes') }}">Cancel</a>
    </form>
@endsection
