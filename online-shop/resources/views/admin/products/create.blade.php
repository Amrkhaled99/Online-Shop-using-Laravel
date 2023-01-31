@extends('layouts.admin')
@section('content')
    <h2 class="text-center">Add Product</h2>
    <form method="POST" action="{{ url('admin/products') }}" enctype="multipart/form-data">
        @csrf
        <label>Name</label>
        <input class="form-control" name="name" value="{{ old('name') }}" />
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label>Description</label>
        <textarea class="form-control" name="description">{{ old('description') }}</textarea>

        <label>Price</label>
        <input class="form-control" name="price" type="number" value="{{ old('price') }}" />
        <label>Discount</label>
        <input class="form-control" name="discount" type="number" value="{{ old('discout') }}" step="0.01" />


        <label>Rating</label>
        <input class="form-control" name="rating" type="number" value="{{ old('rating') }}" />

        <label>Rating Count</label>
        <input class="form-control" name="rating_count" type="number" value="{{ old('rating_count') }}" />

        <label>Is Recent <input name="is_recent" type="checkbox" {{ old('is_recent') ? 'checked' : '' }} /></label>
        <br />
        <label>Is Featured <input name="is_featured" type="checkbox" {{ old('is_featured') ? 'checked' : '' }} /></label>
        <br />
        <label>Image</label>
        <input  name="image" type="file" value="{{ old('image') }}" />
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br><br>
        <label>Category</label>
        <select class="form-control" name="category_id">
            <option>Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach
        </select>

        <label>Color</label>
        <select class="form-control" name="color_id">
            <option>Select Color</option>
            @foreach ($colors as $color)
                <option value="{{ $color->id }}" {{ old('color_id') == $color['id'] ? 'selected' : '' }}>{{ $color->name }}
                </option>
            @endforeach
        </select>

        <label>Size</label>
        <select class="form-control" name="size_id">
            <option>Select Size</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}" {{ old('size_id') == $size['id'] ? 'selected' : '' }}>{{ $size->name }}
                </option>
            @endforeach
        </select>

                    <!-- Button trigger modal -->
                    <br>

       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Size   </button>
       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Color   </button>

       <br>
       <br>

        <button class="btn btn-primary">Add</button>

  
        <a class="btn btn-secondary" href="{{ url('admin/products') }}">Cancel</a>
    </form>



  <!-- Size Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Size</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form method="POST" action="{{ url('admin/products') }}" enctype="multipart/form-data">
                @csrf
            @foreach ($sizes as $size)
            <select class="form-control" name="size_{{$size->id}}">
                <option>Select Size</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}" {{ old('size_id') == $size['id'] ? 'selected' : '' }}>{{ $size->name }}
                    </option>
                @endforeach
            </select>
            <br>
            @endforeach
            </form>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endsection
