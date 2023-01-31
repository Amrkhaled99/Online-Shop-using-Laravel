@extends('layouts.admin')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr  class="text-center text-white btn-dark">
            
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address1</th>
                <th>Address2</th>
                <th>country</th>
                <th>city</th>
                <th>state</th>
                <th>zip</th>

                <th colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="text-center justify-content-center center">
                    
                
        

                    <td  class="text-center text-white btn-dark">{{ $order['id'] }}</td>
                    <td>{{ $order['fname'] }}</td>

                    <td>{{ $order['lname'] }}</td>
                    <td>{{ $order['email'] }}</td>
                    <td>{{ $order['mobile'] }}</td>
                    <td>{{ $order['address1'] }}</td>
                    <td>{{ $order['address2'] }}</td>

                    <td>{{ $order['country'] }}</td>
                    <td>{{ $order['city'] }}</td>
                    <td>{{ $order['state'] }}</td>
                    <td>{{ $order['zip'] }}</td>

          
                
                    <td><a class="btn btn-secondary"  href="{{ url('admin/orders/' . $order['id'])."/show" }}">Details</a></td>

         


                    <td>
                        <form action="{{ url('admin/orders/' . $order['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure you want to delete this order?')"  class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-between">
     
        <div class="align-items-center">
            {!! $orders->links() !!}

        </div>

        <div class="justify-content-end">
            <a class="btn btn-primary" href="{{ url('admin/orders/create') }}">Add</a>

        </div>

    </div>    

@endsection
