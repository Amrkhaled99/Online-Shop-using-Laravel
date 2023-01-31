@extends('layouts.admin')
@section('content')
    <h2 class="text-center">Edit Product</h2>
    <form method="POST" action="{{ url('admin/products') }}" enctype="multipart/form-data">
        @csrf
        <label>Name</label>
        <input class="form-control" name="name" value="{{ old('name', $products->name) }}" />
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label>Description</label>
        <textarea class="form-control" name="description">{{ old('description', $products->description) }}</textarea>

        <label>Price</label>
        <input class="form-control" name="price" type="number" value="{{ old('price', $products->price) }}" />
        <label>Discount</label>
        <input class="form-control" name="discount" type="number" value="{{ old('discout', $products->discount) }}" step="0.01" />


        <label>Rating</label>
        <input class="form-control" name="rating" type="number" value="{{ old('rating', $products->rating) }}" />

        <label>Rating Count</label>
        <input class="form-control" name="rating_count" type="number" value="{{ old('rating_count', $products->rating_count) }}" />

        <label>Is Recent <input name="is_recent" type="checkbox" {{ old('is_recent', $products->is_recent)  ? 'checked' : '' }} /></label>
        <br />
        <label>Is Featured <input name="is_featured" type="checkbox" {{ old('is_featured', $products->is_featured) ? 'checked' : '' }} /></label>
        <br />
        <label>Image</label>
        <input  name="image" type="file" value="{{ old('image', $products->image)  }}" />
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <br><br>
        <label>Category</label>
        <select class="form-control" name="category_id">
            <option>Select Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $products->category_id) == $category['id'] ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach
        </select>

        <label>Color</label>
        <select class="form-control" name="color_id">
            <option>Select Color</option>
            @foreach ($colors as $color)
                <option value="{{ $color->id }}" {{ old('color_id', $products->color_id)  == $color['id'] ? 'selected' : '' }}>{{ $color->name }}
                </option>
            @endforeach
        </select>

        <label>Size</label>
        <select class="form-control" name="size_id">
            <option>Select Size</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}" {{ old('size_id', $products->size_id)  == $size['id'] ? 'selected' : '' }}>{{ $size->name }}
                </option>
            @endforeach
        </select>

        <button class="btn btn-primary">Add</button>
        <a class="btn btn-secondary" href="{{ url('admin/products') }}">Cancel</a>
    </form>
@endsection
