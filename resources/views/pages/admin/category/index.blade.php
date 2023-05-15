@extends('layouts.app', ['title' => 'Cateogries'])

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Category</h1>

    <div class="buttonAdd mb-3 ml-auto">
        <a href="{{ route('category.create') }}" class="btn btn-primary">Add</a>
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
                <th scope="col">Name Category</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ( $categories as $category )
            <tr>
                <th scope="row">1</th>
                <td>{{ $category->name }}</td>
                <td class="text-center">
                        <form action="{{ route('category.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary">
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
