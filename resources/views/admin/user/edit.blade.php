@extends('backend.index')
@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Edit User</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.update', $user->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label>Nama User</label>
                                    <input type="text" class="form-control" name="name" autocomplete="off" value="{{ $user->name }}">
                                    @error('name')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" readonly value="{{ $user->email }}">
                                    @error('email')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Role User</label>
                                    <select class="form-control" name="role">
                                        <option value="" holder>-- Pilih Role User --</option>
                                        <option value="1" @if($user->role == 1)
                                                    selected
                                                @endif
                                        >Administator</option>
                                        <option value="0" @if($user->role == 0)
                                                    selected
                                                @endif
                                        >Author</option>
                                    </select>
                                    @error('role')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control">
                                    @error('password')
                                        <small class="text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
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