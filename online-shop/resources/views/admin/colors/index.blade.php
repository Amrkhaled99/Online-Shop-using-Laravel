@extends('layouts.admin')
@section('content')
{{-- @if(Session::has('message'))
    <div class="alert alert-className">
        {{session('message')}}
    </div>
@endif --}}


@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif
    <!-- Table -->

    <div class="container">
        <td>
            <a class="btn btn-success" href="{{ url('admin/colors/create') }}"> Add </a>
        </td>

        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center text-white btn-dark">
                            <th>Id</th>
                            <th>Name</th>
                      

                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $color)
                            <tr class="text-center justify-content-center center">
                                <td  class="text-center text-white btn-dark">{{ $color['id'] }}</td>
                                <td>{{ $color['name'] }}</td>
                         
                             
                                <td>
                                    <a class="btn btn-primary" href="{{ url('admin/colors/' . $color['id'])."/edit" }}">
                                        Edit
                                      
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ url('admin/colors/' . $color['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Are you sure?')"
                                            class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center">
        {!! $colors->links() !!}
    </div>
    @endsection
