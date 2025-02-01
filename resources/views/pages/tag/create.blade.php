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
                                <form action="{{ route('tag.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            tag</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="nama_tag" required>
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
            $('#nama_tag').select2({
                tags: true,
            });

            const tagForm = $('#tagLain');

            $('#nama_tag').on('change', function() {
                let tagValue = $(this).val();

                // Tampilkan input teks jika memilih 'Lainnya...'
                tagForm.show();
                if (tagValue == '20') {} else {
                    tagForm.hide();
                }
            });

            const edittag = "{{ isset($data->nama_tag) ? $data->nama_tag : '' }}";
            if (edittag && edittag?.length > 0) {
                $("#nama_tag").val(edittag).trigger("change");
            }
        </script>
    @endpush
@endsection
