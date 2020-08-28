@extends('backend.index')
@section('content')

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
        </div>

        @if(Session::has('sukses'))
            <div class="flash-sukses" data-flashdata="{{ Session('sukses') }}"></div>
        @endif

        <div class="section-body">

            <a href="{{ route('user.create') }}" class="btn btn-info btn-sm mb-3">Tambah User</a>
            <table class="table table-borderes table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>  
                </thead>
                <tbody>
                    @foreach ($user as $result => $hasil) 
                        <tr>
                            <td>{{ $result + $user->firstitem() }}</td>
                            <td>{{ $hasil->name }}</td>
                            <td>{{ $hasil->email }}</td>
                            <td>
                                @if($hasil->role)
                                    <span class="badge badge-info">Administrator</span>
                                    @else
                                    <span class="badge badge-warning">Author</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('user.destroy', $hasil->id) }}" method="POST" id="form-hapus">
                                    @csrf
                                    @method('delete')
                                    <a href="{{ route('user.edit', $hasil->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm">delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $user->links() }}
        </div>
    </section>
</div>

@endsection