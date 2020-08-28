@extends('backend.index')
@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>
        </div>

        @if(Session::has('sukses'))
            <div class="flash-sukses" data-flashdata="{{ Session('sukses') }}"></div>
        @endif

        <div class="section-body">

            <a href="{{ route('category.create') }}" class="btn btn-info btn-sm mb-3">Tambah Category</a>
            <table class="table table-borderes table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Categori</th>
                        <th>Nama Slug</th>
                        <th>Action</th>
                    </tr>  
                </thead>
                <tbody>
                    @foreach ($category as $result => $hasil) 
                        <tr>
                            <td>{{ $result + $category->firstitem() }}</td>
                            <td>{{ $hasil->name }}</td>
                            <td>{{ $hasil->slug }}</td>
                            <td>
                                <form action="{{ route('category.destroy', $hasil->id) }}" method="POST" id="form-hapus">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('category.edit', $hasil->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm">delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $category->links() }}
        </div>
    </section>
</div>

@endsection