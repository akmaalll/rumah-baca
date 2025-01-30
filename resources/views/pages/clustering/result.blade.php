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
                                <div class="mb-4">
                                    <h6 class="font-weight-bold">Detail Proses</h6>
                                    <div class="bg-light p-3 rounded">
                                        <p><strong>Tanggal Proses:</strong>
                                            {{ $clustering->created_at->format('d/m/Y H:i') }}</p>
                                        <p><strong>Jumlah Cluster:</strong> {{ $clustering->jumlah_cluster }}</p>
                                        <p><strong>Status:</strong>
                                            <span
                                                class="badge {{ $clustering->status == 'completed' ? 'badge-success' : 'badge-warning' }}">
                                                {{ $clustering->status }}
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    @foreach ($clusterResults as $clusterName => $books)
                                        <div class="col-md-6 col-lg-4"> 
                                            <div class="card">
                                                <div class="card-header">
                                                    <h6 class="font-weight-bold">{{ $clusterName }}</h6>
                                                </div>
                                                <div class="card-body">
                                                    <p>Jumlah Buku: {{ $books->count() }}</p>
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($books as $clusterBook)
                                                            <li class="list-group-item">
                                                                <div class="d-flex">
                                                                    @if ($clusterBook->buku->image)
                                                                        <img src="{{ asset('storage/' . $clusterBook->buku->image) }}"
                                                                            alt="{{ $clusterBook->buku->judul }}"
                                                                            class="img-thumbnail mr-3"
                                                                            style="width: 60px; height: 90px;">
                                                                    @else
                                                                        <div class="bg-light d-flex align-items-center justify-content-center mr-3"
                                                                            style="width: 60px; height: 90px;">
                                                                            <span class="text-muted">No Image</span>
                                                                        </div>
                                                                    @endif

                                                                    <div>
                                                                        <strong>{{ $clusterBook->buku->judul }}</strong>
                                                                        <p class="mb-0 text-muted">
                                                                            {{ $clusterBook->buku->penulis }}</p>
                                                                        <p class="mb-0 text-muted">Tahun:
                                                                            {{ $clusterBook->buku->tahun_terbit }}</p>

                                                                        @if ($clusterBook->buku->tag)
                                                                            <div class="mt-2">
                                                                                @foreach (explode(',', $clusterBook->buku->tag) as $tag)
                                                                                    <span class="badge badge-primary">
                                                                                        {{ trim($tag) }}
                                                                                    </span>
                                                                                @endforeach
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
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
