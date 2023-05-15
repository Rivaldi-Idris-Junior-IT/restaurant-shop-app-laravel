@extends('layouts.app', ['title' => 'Edit Product'])

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Product</h1>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('product.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name Product</label>
            <input type="text" class="form-control" value="{{ $product->title }}" name="title" id="title" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Name Product</label>
            <select name="category_id" class="form-control">
                <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                @foreach ($categories as $category )
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Description</label>
            <textarea name="content" class="form-control" value="{{ $product->content }}" id="content" cols="30" rows="5"></textarea>
        </div>
        <input type="hidden" value="0" name="weight">
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" name="price" value="{{ $product->price }}" id="price" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection
