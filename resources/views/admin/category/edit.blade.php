@extends('backend.index')
@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">

        @if(Session::has('sukses'))
            <div class="flash-sukses" data-flashdata="{{ Session('sukses') }}"></div>
        @endif

        <div class="section-header">
            <h1>Edit Category</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('category.update', $category->id) }}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $category->name }}">
                                    @if(count($errors) > 0)
                                        @foreach ($errors->all() as $error)
                                            <small class="text-danger">
                                                {{ $error }}
                                            </small>
                                        @endforeach
                                    @endif
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