@extends('layouts.app', ['title' => 'Add Category'])

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add Category</h1>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name Category</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
@endsection
