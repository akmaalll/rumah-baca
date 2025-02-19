@extends('app._layouts.index')

@section('content')
    <div class="c-layout-page">
        <!-- Rekomendasi Buku Section -->
        <section class="c-content-box c-size-md c-bg-white">
            <div class="container p-5">
                <!-- Tombol Update Rekomendasi -->


                <!-- Form Pilih Kategori dan Buku -->
                <div class="card p-4 mb-5">
                    <form method="POST" action="{{ route('simpan.preferensi') }}">
                        @csrf
                        <h3 class="mb-3">Pilih Kategori yang Anda Sukai:</h3>
                        <div class="row">
                            @foreach ($kategoris as $kategori)
                                <div class="col-md-4 mb-2">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="kategori_id[]" value="{{ $kategori->id }}">
                                        {{ $kategori->sub_kategori }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <h3 class="mt-4 mb-3">Pilih Buku yang Anda Sukai:</h3>
                        <div class="row">
                            @foreach ($bukuPopuler as $buku)
                                <div class="col-md-4 mb-2">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="buku_id[]" value="{{ $buku->id }}">
                                        {{ $buku->judul }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group mt-4" style="text-align: center;">
                            <button type="submit"
                                class="btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase mb-4">
                                Update Preferensi
                            </button>

                        </div>

                    </form>

                    <form action="{{ route('user.rekomendasi.generate') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase mb-4">
                            Update Rekomendasi
                        </button>
                    </form>


                </div>

                <!-- Tampilkan Rekomendasi Buku -->
                @if ($rekomendasi->isEmpty())
                    <p class="text-center">Tidak ada rekomendasi untuk saat ini.</p>
                @else
                    <div class="row">
                        <div class="cbp-panel">
                            <div id="filters-container" class="cbp-l-filters-buttonCenter mb-4">
                                <div data-filter="*" class="cbp-filter-item cbp-filter-item-active">All</div>
                            </div>

                            <div id="grid-container" class="cbp cbp-l-grid-masonry-projects row">
                                @foreach ($rekomendasi as $rek)
                                    <div class="cbp-item col-md-4 mb-4">
                                        <div class="card h-100">
                                            <div class="cbp-caption">
                                                <div class="cbp-caption-defaultWrap text-center p-3">
                                                    @if (!empty($rek->buku->gambar) && file_exists(public_path('images/buku/' . $rek->buku->gambar)))
                                                        <img src="{{ asset('images/buku/' . $rek->buku->gambar) }}"
                                                            alt="{{ $rek->buku->judul }}" class="img-fluid book-thumbnail">
                                                    @else
                                                        <img src="{{ asset('images/buku/no-image.png') }}"
                                                            alt="No Image Available" class="img-fluid book-thumbnail">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="#" class="text-dark">
                                                        {{ Str::limit($rek->buku->judul, 50) }}
                                                    </a>
                                                </h5>
                                                <p class="card-text text-muted">
                                                    <strong>Penulis:</strong> {{ $rek->buku->penulis }}<br>
                                                    <strong>Tahun Terbit:</strong> {{ $rek->buku->tahun_terbit }}<br>
                                                    <strong>Kategori:</strong> {{ $rek->buku->kategori->sub_kategori }}
                                                </p>
                                                <div class="tags mt-2">
                                                    @foreach (explode(',', $rek->buku->tag) as $tag)
                                                        <span class="badge badge-primary">{{ trim($tag) }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize cubeportfolio for filtering and grid layout
            $('#grid-container').cubeportfolio({
                filters: '#filters-container',
                defaultFilter: '*',
                animationType: 'fadeOut',
                gapHorizontal: 30,
                gapVertical: 30,
                gridAdjustment: 'responsive',
                caption: 'overlayBottom',
                displayType: 'fadeIn',
                displayTypeSpeed: 100,
            });

            $('.cbp-filter-item').on('click', function() {
                var filterValue = $(this).attr('data-filter');
                $('#grid-container').cubeportfolio('filter', filterValue);
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .book-thumbnail {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
        }

        .no-image-placeholder {
            width: 100%;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
            color: #999;
            border-radius: 8px;
        }

        .cbp-caption-defaultWrap {
            display: flex;
            justify-content: center;
            padding: 10px;
        }

        .tags .badge {
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
