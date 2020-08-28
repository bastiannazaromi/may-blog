@extends('backend.index')
@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Post Trash</h1>
        </div>

        @if(Session::has('sukses'))
            <div class="flash-sukses" data-flashdata="{{ Session('sukses') }}"></div>
        @endif

        <div class="section-body">

            <table class="table table-borderes table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Post</th>
                        <th>Nama Kategori</th>
                        <th>Daftar Tags</th>
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
                                        <li>{{ $tag->name}}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td><img src="{{ asset( $hasil->gambar ) }}" class="img-fluid" style="width: 100px;"></td>
                            <td>
                                <form action="{{ route('post.kill', $hasil->id ) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('post.restore', $hasil->id ) }}" class="btn btn-info btn-sm">Restore</a>
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