@extends('layouts.admin')
@section('content')
    <h2>Show Order Details</h2>
    <h2 class="d-flex justify-content-center">{{$order->fname." ".$order->lname}}</h2>


        
            
        <table class="table table-borderDetailsed">
            <thead>
                <tr  class="text-center text-white btn-dark">
                    <th>Id</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>product ID </th>
                    <th>order ID</th>
            
    
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $details_Order)

                    <tr class="text-center justify-content-center center">
                        <td  class="text-center text-white btn-dark">{{ $details_Order['id'] }}</td>
                        <td>{{ $details_Order['quantity'] }}</td>
                        <td>{{ $details_Order['price']}} EGP</td>
                        <td>{{$details_Order['product_id']}}</td>
                        <td>{{$details_Order['order_id']}}</td>                      
                       

                    </tr>
                    @endforeach

            </tbody>
        </table>

        <div class="d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ url('admin/orders') }}">Cancel</a>
    </div>
    </form>
@endsection
