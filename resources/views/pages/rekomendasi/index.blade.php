@extends('layouts.auth', ['title' => 'Register'])
@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
    @endpush

    <div class="card card-primary" style="max-width: 600px; margin: auto;">
        <div class="card-header text-center">
            <h4>Preferensi</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('simpan.preferensi') }}">
                @csrf

                <h5 class="mb-3">Pilih Kategori yang Anda Sukai:</h5>
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    @foreach ($kategoris as $kategori)
                        <label style="display: flex; align-items: center; gap: 5px;">
                            <input type="checkbox" name="kategori_id[]" value="{{ $kategori->id }}">
                            {{ $kategori->sub_kategori }}
                        </label>
                    @endforeach
                </div>

                <hr>

                <h5 class="mb-3">Pilih Buku yang Anda Sukai:</h5>
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    @foreach ($bukuPopuler as $buku)
                        <label style="display: flex; align-items: center; gap: 5px;">
                            <input type="checkbox" name="buku_id[]" value="{{ $buku->id }}">
                            {{ $buku->judul }}
                        </label>
                    @endforeach
                </div>

                <div class="form-group mt-4 text-center">
                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; max-width: 250px; font-size: 16px; padding: 10px;">
                        Simpan Preferensi
                    </button>
                </div>
            </form>
        </div>
    </div>


    @push('scripts')
        <script src="{{ asset('library/jquery-pwstrength/pwstrength.js') }}"></script>
        <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
        <script src="{{ asset('library/izitoast/dist/js/iziToast.min.js') }}"></script>
        <script src="{{ asset('js/page/modules-toastr.js') }}"></script>
        <script src="{{ asset('js/page/auth-register.js') }}"></script>
        <script>
            @if (session('success'))
                iziToast.success({
                    title: 'Sukses',
                    message: "{{ session('success') }}",
                    position: 'topRight'
                });
            @endif

            @if (session('error'))
                iziToast.error({
                    title: 'Error',
                    message: "{{ session('error') }}",
                    position: 'topRight'
                });
            @endif
        </script>
    @endpush
@endsection
