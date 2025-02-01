@extends('layouts.app', ['title' => 'Modules > DataTables'])
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
                                    <a href="{{ route('tag.create') }}" class="btn btn-primary">Tambah Data</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    No
                                                </th>
                                                <th>Nama tag</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tag as $v)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>{{ $v->nama_tag }}</td>
                                                    <td>
                                                        <a href="{{ route('tag.edit', $v->id) }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <form action="{{ route('tag.delete', $v->id) }}" method="POST"
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
