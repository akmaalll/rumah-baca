@extends('app._layouts.index')

@section('content')
    <div class="c-layout-page">
        <!-- Slider Section -->
        <section class="c-layout-revo-slider c-layout-revo-slider-4" dir="ltr">
            <div class="tp-banner-container c-theme">
                <div class="tp-banner rev_slider" data-version="5.0">
                    <ul>
                        <li data-transition="fade" data-slotamount="1" data-masterspeed="1000">
                            <img alt="Banner Image" src="{{ asset('logo.png') }}" data-bgposition="center center"
                                data-bgfit="cover" data-bgrepeat="no-repeat">
                            <div class="tp-caption customin customout" data-x="center" data-y="center" data-hoffset=""
                                data-voffset="-50" data-speed="500" data-start="1000" data-transform_idle="o:1;"
                                data-transform_in="rX:0.5;scaleX:0.75;scaleY:0.75;o:0;s:500;e:Back.easeInOut;"
                                data-transform_out="rX:0.5;scaleX:0.75;scaleY:0.75;o:0;s:500;e:Back.easeInOut;"
                                data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1"
                                data-endspeed="600">
                                <h3
                                    class="c-main-title-circle c-font-48 c-font-bold c-font-center c-font-uppercase c-font-white c-block">
                                    Rekomendasi Buku untuk Anda
                                </h3>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Rekomendasi Buku Section -->
        <section class="c-content-box c-size-md c-bg-white">
            <div class="container p-5">
                <form action="{{ route('user.rekomendasi.generate') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase">Update
                        Rekomendasi</button>
                </form>
                <br>

                @if ($rekomendasi->isEmpty())
                    <p>Tidak ada rekomendasi untuk saat ini.</p>
                @else
                    <div class="row">
                        <div class="cbp-panel">
                            <div id="filters-container" class="cbp-l-filters-buttonCenter">
                                <div data-filter="*" class="cbp-filter-item cbp-filter-item-active">All</div>
                                <!-- Optionally, add dynamic filtering by category -->
                            </div>

                            <div id="grid-container" class="cbp cbp-l-grid-masonry-projects">
                                @foreach ($rekomendasi as $rek)
                                    <div class="cbp-item">
                                        <div class="cbp-caption">
                                            <div class="cbp-caption-defaultWrap">
                                                @if ($rek->buku->image)
                                                    <img src="{{ asset('images/buku/' . $rek->buku->image) }}"
                                                        alt="{{ $rek->buku->judul }}" class="img-fluid book-thumbnail">
                                                @else
                                                    <div class="no-image-placeholder">
                                                        <i class="fa fa-book"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="#"
                                            class="cbp-l-grid-masonry-projects-title">{{ Str::limit($rek->buku->judul, 50) }}</a>
                                        <div class="cbp-l-grid-masonry-projects-desc">
                                            <p class="author">{{ $rek->buku->penulis }}</p>
                                            <p class="year">{{ $rek->buku->tahun_terbit }}</p>
                                            <div class="tags mt-2">
                                                @foreach (explode(',', $rek->buku->tag) as $tag)
                                                    <span class="badge badge-primary">{{ trim($tag) }}</span>
                                                @endforeach
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
            width: 150px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .no-image-placeholder {
            width: 150px;
            height: 200px;
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
    </style>
@endpush
