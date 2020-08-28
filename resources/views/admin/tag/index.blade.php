@extends('backend.index')
@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tag</h1>
        </div>

        @if(Session::has('sukses'))
            <div class="flash-sukses" data-flashdata="{{ Session('sukses') }}"></div>
        @endif

        <div class="section-body">

            <a href="{{ route('tag.create') }}" class="btn btn-info btn-sm mb-3">Tambah Tag</a>
            <table class="table table-borderes table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Tag</th>
                        <th>Nama Slug</th>
                        <th>Action</th>
                    </tr>  
                </thead>
                <tbody>
                    @foreach ($tag as $result => $hasil) 
                        <tr>
                            <td>{{ $result + $tag->firstitem() }}</td>
                            <td>{{ $hasil->name }}</td>
                            <td>{{ $hasil->slug }}</td>
                            <td>
                                <form action="{{ route('tag.destroy', $hasil->id) }}" method="POST" id="form-hapus">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('tag.edit', $hasil->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm">delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $tag->links() }}
        </div>
    </section>
</div>

@endsection