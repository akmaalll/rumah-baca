@extends('layouts.app', ['title' => $menu])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('library/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $menu }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Modules</a></div>
                    <div class="breadcrumb-item">{{ $menu }}</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data {{ $menu }}</h4>
                                <div class="ml-auto">
                                    <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Data</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Gambar</th>
                                                <th>Judul Buku</th>
                                                <th>Penulis</th>
                                                <th>Penerbit</th>
                                                <th>Tahun Terbit</th>
                                                <th>ISBN</th>
                                                <th>Kategori</th>
                                                <th>Sub Kategori</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($buku as $v)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($v->gambar) && file_exists(public_path('images/buku/' . $v->gambar)))
                                                            <img src="{{ asset('images/buku/' . $v->gambar) }}"
                                                                alt="Gambar Buku" width="50">
                                                        @else
                                                            <img src="{{ asset('images/buku/no-image.png') }}"
                                                                alt="" width="50">
                                                        @endif
                                                    </td>
                                                    <td>{{ $v->judul }}</td>
                                                    <td>{{ $v->penulis }}</td>
                                                    <td>{{ $v->penerbit }}</td>
                                                    <td>{{ $v->tahun_terbit }}</td>
                                                    <td>{{ $v->isbn }}</td>
                                                    <td>{{ $v->kategori->nama_kategori }}</td>
                                                    <td>{{ $v->kategori->sub_kategori }}</td>
                                                    <td>{!! $v->deskripsi !!}</td>

                                                    <td>
                                                        <a href="{{ route('buku.edit', $v->id) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <form action="{{ route('buku.delete', $v->id) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger">
                                                                delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('library/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
    @endpush
@endsection
