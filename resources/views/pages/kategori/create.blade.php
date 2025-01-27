@extends('layouts.app', ['title' => 'Forms > Editor'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ asset('library/codemirror/lib/codemirror.css') }}">
        <link rel="stylesheet" href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
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
                                <h4>Tambah {{ $menu }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Kategori</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control select2"
                                                data-placeholder="Pilih atau Ketikkan Nama Kategori" name="nama_kategori"
                                                id="nama_kategori">
                                                <option value="">Pilih Nama Kategori...</option>
                                                @foreach ($kategori as $a)
                                                    <option value="{{ $a->id }}">
                                                        {{ $a->nama_kategori }}
                                                    </option>
                                                @endforeach
                                                <option value="20" class="tujuan-lain">Lainnya...</option>
                                            </select>
                                            <input type="text" id="kategoriLain" name="kategori_lain"
                                                class="form-control mt-2" placeholder="Masukkan kategori lainnya"
                                                style="display:none;">  
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub
                                            Kategori</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="sub_kategori" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary">Publish</button>
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
        <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

        <script>
            $('#nama_kategori').select2({
                tags: true,
            });

            const kategoriForm = $('#kategoriLain');

            $('#nama_kategori').on('change', function() {
                let kategoriValue = $(this).val();

                // Tampilkan input teks jika memilih 'Lainnya...'
                kategoriForm.show();
                if (kategoriValue == '20') {} else {
                    kategoriForm.hide();
                }
            });

            const editKategori = "{{ isset($data->nama_kategori) ? $data->nama_kategori : '' }}";
            if (editKategori && editKategori?.length > 0) {
                $("#nama_kategori").val(editKategori).trigger("change");
            }
        </script>
    @endpush
@endsection
