@extends('layouts.app', ['title' => 'Products'])

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Products</h1>

    <div class="buttonAdd mb-3 ml-auto">
        <a href="{{ route('product.create') }}" class="btn btn-primary">Add</a>
    </div>

    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>Data hase been success added</p>
    </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name </th>
                <th scope="col">Kategori</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $products as $product )
            <tr>
                <th scope="row">1</th>
                <td>{{ $product->title }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->content }}</td>
                <td>{{ $product->price }}</td>
                <td class="text-center">
                        <form action="{{ route('product.destroy', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-pencil-alt"></i>
                            </a>
                            <button type="submit" onclick="return confirm('anda yakin ?')"
                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
            </tr>
        </tbody>
        @empty
        <div class="alert alert-danger">
            Data Belum Tersedia!
        </div>
        @endforelse
    </table>

</div>
@endsection
