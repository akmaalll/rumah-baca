@extends('layouts.app', ['title' => 'Forms > Editor'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('library/codemirror/lib/codemirror.css') }}">
        <link rel="stylesheet" href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    @endpush

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Editor</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Editor</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit {{ $menu }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('buku.update', $data->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="hidden" name="gambarLama" value="{{ $data->image }}">
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="judul"
                                                value="{{ $data->judul }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="kategori_id" required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($kategori as $k)
                                                    <option value="{{ $k->id }}"
                                                        @if ($data->kategori_id == $k->id) selected @endif>
                                                        {{ $k->sub_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penulis</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="penulis"
                                                value="{{ $data->penulis }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penerbit</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="penerbit"
                                                value="{{ $data->penerbit }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun
                                            Terbit</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" class="form-control" name="tahun_terbit"
                                                value="{{ $data->tahun_terbit }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">ISBN</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" class="form-control" name="isbn"
                                                value="{{ $data->isbn }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah
                                            Halaman</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="number" class="form-control" name="jumlah_halaman"
                                                value="{{ $data->jumlah_halaman }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bahasa</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="bahasa"
                                                value="{{ $data->bahasa }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="summernote-simple" name="deskripsi">{{ $data->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tag</label>
                                        <div class="col-sm-12 col-md-7">
                                            @php
                                                $selectedTags = explode(',', $data->tag); // Mengubah string "1,2" menjadi array
                                            @endphp

                                            <select class="form-control selectric" multiple name="tag[]">
                                                @foreach ($tag as $t)
                                                    <option value="{{ $t->id }}"
                                                        @if (in_array($t->id, $selectedTags)) selected @endif>
                                                        {{ $t->nama_tag }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar</label>
                                        <div class="col-sm-12 col-md-5">
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <div class="col-md-3">
                                            @if ($data->image)
                                                <img class="img-thumbnail"
                                                    src="{{ asset('images/buku/' . $data->image) }}" width="100"
                                                    alt="image">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    @push('scripts')
        <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
        <script src="{{ asset('library/codemirror/lib/codemirror.js') }}"></script>
        <script src="{{ asset('library/codemirror/mode/javascript/javascript.js') }}"></script>
        <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    @endpush
@endsection
