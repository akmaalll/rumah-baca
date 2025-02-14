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
                                {{-- <div class="ml-auto">
                                    <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Data</a>
                                </div> --}}
                            </div>

                            <div class="card-body">
                                <form action="{{ route('clustering.proses') }}" method="GET">
                                    @csrf
                                    {{-- <div class="form-group">
                                        <label for="jumlah_cluster">Jumlah Cluster</label>
                                        <input type="number" class="form-control" id="jumlah_cluster" name="jumlah_cluster"
                                            min="2">
                                    </div> --}}
                                    <button type="submit" class="btn btn-primary">Mulai Clustering</button>
                                </form>
                            </div>

                            {{--  --}}
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
