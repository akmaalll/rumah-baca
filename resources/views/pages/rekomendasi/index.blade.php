@extends('layouts.auth', ['title' => 'Register'])

@section('content')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
        <link rel="stylesheet" href="{{ asset('library/izitoast/dist/css/iziToast.min.css') }}">
        <style>
            .rating {
                display: flex;
                flex-direction: row-reverse;
                justify-content: start;
                gap: 5px;
            }

            .rating input {
                display: none;
            }

            .rating label {
                font-size: 24px;
                color: #ddd;
                cursor: pointer;
                transition: color 0.3s;
            }

            /* Efek hover dan checked */
            .rating input:checked~label,
            .rating label:hover,
            .rating label:hover~label {
                color: #f39c12;
            }

            .kategori-item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                background: #f8f9fa;
                padding: 10px;
                border-radius: 8px;
                border: 1px solid #ddd;
            }

            .kategori-label {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            /* Nonaktifkan bintang rating secara default */
            .rating input[type="radio"] {
                pointer-events: none;
            }

            .rating label {
                opacity: 0.5;
            }

            /* Aktifkan bintang rating ketika kategori dicentang */
            .kategori-item.active .rating input[type="radio"] {
                pointer-events: auto;
            }

            .kategori-item.active .rating label {
                opacity: 1;
            }
        </style>
    @endpush

    <div class="card card-primary" style="max-width: 600px; margin: auto;">
        <div class="card-header text-center">
            <h4>Preferensi</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('simpan.preferensi') }}">
                @csrf

                <h5 class="mb-3">Pilih Kategori yang Anda Sukai:</h5>
                <div class="form-group">
                    @foreach ($kategoris as $kategori)
                        <div class="kategori-item" id="kategori_{{ $kategori->id }}">
                            <div class="kategori-label">
                                <input type="checkbox" name="kategori_id[]" value="{{ $kategori->id }}"
                                    id="checkbox_{{ $kategori->id }}">
                                <span>{{ $kategori->sub_kategori }}</span>
                            </div>

                            <div class="rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="rating_{{ $kategori->id }}_{{ $i }}"
                                        name="rating_{{ $kategori->id }}" value="{{ $i }}">
                                    <label for="rating_{{ $kategori->id }}_{{ $i }}">&#9733;</label>
                                @endfor
                            </div>
                        </div>
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

            // Script untuk mengontrol bintang rating
            document.querySelectorAll('.kategori-item input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const kategoriItem = this.closest('.kategori-item');
                    if (this.checked) {
                        kategoriItem.classList.add('active'); // Aktifkan bintang rating
                    } else {
                        kategoriItem.classList.remove('active'); // Nonaktifkan bintang rating
                        // Reset bintang rating yang dipilih
                        kategoriItem.querySelectorAll('input[type="radio"]').forEach(radio => {
                            radio.checked = false;
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
