@extends('layouts.admin')
@section('content')
    <h2>Show product</h2>
    <h2 class="d-flex justify-content-center">{{$products->name}}</h2>
        {{-- <label>Name</label> --}}
        
        {{-- <img src="{{asset('storage/'.$productss->image)}}" /> --}}

        
        <table class="table table-bordered">
            <thead>
                <tr  class="text-center text-white btn-dark">
                    <th>Id</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Color</th>
    
                    <th>Size</th>
                    <th>Rate</th>
                    <th>Featured</th>
                    <th>Recent</th>

    
                </tr>
            </thead>
            <tbody>
             
                    <tr class="text-center justify-content-center center">
                        <td  class="text-center text-white btn-dark">{{ $products['id'] }}</td>
                        <td>
                            <img style="width: 150px; length:150px" src="{{asset('storage/'.$products->image)}}" />
                        </td>
                        <td>{{ $products['category']['name'] }}</td>
                        <td>{{ $products['price']}} EGP</td>
                        <td>{{$products->color->name}}</td>
                        <td>{{$products->size->name}}</td>                      
                        <td>{{$products->rating}}</td>
                        <td>{{$products->is_featured ? "True" :"False"}}</td>
                        <td>{{$products->is_recent ? "True" :"False"}}</td>

                      

                    </tr>
    
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
        <a class="btn btn-dark" href="{{ url('admin/products') }}">Cancel</a>
    </div>
    </form>
@endsection
