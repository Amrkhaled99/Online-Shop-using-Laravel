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
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Color</th>

                <th>Size</th>
                <th>Rate</th>

                <th colspan="3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="text-center justify-content-center center">
                    <td  class="text-center text-white btn-dark">{{ $product['id'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['category']['name'] }}</td>
                    <td>{{ $product['price']}} EGP</td>

                    <td>{{$product->color->name}}</td>
                    <td>{{$product->size->name}}</td>
                    {{-- <td>{{$productsize->size_id}}</td> --}}

                    <td>{{$product->rating}}</td>

                    

                    <td><a class="btn btn-secondary"  href="{{ url('admin/products/' . $product['id']) }}">Show</a></td>
                    <td><a  class="btn btn-primary" href="{{ url('admin/products/' . $product['id'] . '/edit') }}">Edit</a></td>

         


                    <td>
                        <form action="{{ url('admin/products/' . $product['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure you want to delete this product?')"  class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-between">
     
        <div class="align-items-center">
            {!! $products->links() !!}

        </div>

        <div class="justify-content-end">
            <a class="btn btn-primary" href="{{ url('admin/products/create') }}">Add</a>

        </div>

    </div>    

@endsection
