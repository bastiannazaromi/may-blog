@extends('backend.index')
@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Post</h1>
        </div>

        @if(Session::has('sukses'))
            <div class="flash-sukses" data-flashdata="{{ Session('sukses') }}"></div>
        @endif

        <div class="section-body">

            <a href="{{ route('post.create') }}" class="btn btn-info btn-sm mb-3">Tambah Post</a>
            <table class="table table-borderes table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Post</th>
                        <th>Nama Kategori</th>
                        <th>Daftar Tags</th>
                        <th>Creator</th>
                        <th>Thumbnail</th>
                        <th>Action</th>
                    </tr>  
                </thead>
                <tbody>
                    @foreach ($post as $result => $hasil) 
                        <tr>
                            <td>{{ $result + $post->firstitem() }}</td>
                            <td>{{ $hasil->judul }}</td>
                            <td>{{ $hasil->category->name }}</td>
                            <td>
                                @foreach ($hasil->tags as $tag)
                                    <ul>
                                        <h6><span class="badge badge-info">{{ $tag->name}}</span></h6>
                                    </ul>
                                @endforeach
                            </td>
                            <td>{{ $hasil->users->name }}</td>
                            <td><img src="{{ asset( $hasil->gambar ) }}" class="img-fluid" style="width: 100px;"></td>
                            <td>
                                <form action="{{ route('post.destroy', $hasil->id) }}" method="POST" id="form-hapus">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('post.edit', $hasil->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm">delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $post->links() }}
        </div>
    </section>
</div>

@endsection