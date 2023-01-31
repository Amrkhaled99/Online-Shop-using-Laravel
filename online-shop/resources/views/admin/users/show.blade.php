@extends('layouts.admin')
@section('content')
    <h2>Show User</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr  class="text-center text-white btn-dark">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th>Created</th>
                <th>Updated</th>

            </tr>
        </thead>
        <tbody>
         
                <tr class="text-center justify-content-center center">

                    <td  class="text-center text-white btn-dark">{{ $user['id'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['is_admin'] ? "Admin" :"User"}}</td>
                    <td>{{ $user['created_at'] }}</td>
                    <td>{{ $user['updated_at'] }}</td>


                  

                </tr>

        </tbody>
    </table>

        <a class="btn btn-secondary" href="{{ url('admin/users') }}">Cancel</a>
    </form>
@endsection
