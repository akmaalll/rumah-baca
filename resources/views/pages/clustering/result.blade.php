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
                                <h4>Hasil Clustering</h4>
                            </div>

                            <div class="card-body">

                                <div class="container mt-5">

                                    @foreach ($groupedData as $label_klaster => $buku)
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h3> {{ $label_klaster }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">

                                                    <table class="table table-bordered" id="table-1">
                                                        <thead>
                                                            <tr>
                                                                <th>Judul</th>
                                                                <th>Penulis</th>
                                                                <th>Penerbit</th>
                                                                <th>Tahun Terbit</th>
                                                                <th>Kategori</th>
                                                                <th>Sub Kategori</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($buku as $item)
                                                                <tr>
                                                                    <td>{{ $item->judul }}</td>
                                                                    <td>{{ $item->penulis }}</td>
                                                                    <td>{{ $item->penerbit }}</td>
                                                                    <td>{{ $item->tahun_terbit }}</td>
                                                                    <td>{{ $item->kategori->nama_kategori }}</td>
                                                                    <td>{{ $item->kategori->sub_kategori }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('clustering.index') }}" class="btn btn-primary">
                                        Kembali ke Daftar Clustering
                                    </a>
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
