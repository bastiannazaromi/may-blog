@extends('backend.index')
@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">

        @if(Session::has('sukses'))
            <div class="flash-sukses" data-flashdata="{{ Session('sukses') }}"></div>
        @endif

        <div class="section-header">
            <h1>Edit Post</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('post.update', $post->id) }}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" class="form-control" name="judul" autocomplete="off" value="{{ $post->judul }}">
                                    @error('judul')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Tags</label>
                                    <select class="form-control select2" multiple="" name="tags[]">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                @foreach($post->tags as $value)
                                                    @if($tag->id == $value->id)
                                                        selected
                                                    @endif 
                                                @endforeach
                                            >{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="kategori">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($category as $result)
                                        <option value="{{ $result->id }}"
                                            @if($post->category_id == $result->id)
                                                selected
                                            @endif
                                            >{{ $result->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>content</label>
                                    <textarea class="form-control" name="content">{{ $post->content }}</textarea>
                                    @error('content')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Thumbnail</label>
                                    <input type="file" class="form-control" name="gambar">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection