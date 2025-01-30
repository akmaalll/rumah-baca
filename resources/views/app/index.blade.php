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
                                    {{ config('app.name', 'Your Site Title') }}
                                </h3>
                            </div>
                            <div class="tp-caption lft" data-x="center" data-y="center" data-voffset="110" data-speed="900"
                                data-start="2000" data-transform_idle="o:1;"
                                data-transform_in="x:100;y:100;rX:120;scaleX:0.75;scaleY:0.75;o:0;s:500;e:Back.easeInOut;"
                                data-transform_out="x:100;y:100;rX:120;scaleX:0.75;scaleY:0.75;o:0;s:500;e:Back.easeInOut;">
                                <a href=""
                                    class="c-action-btn btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase">
                                    Learn More
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Popular Categories Section -->
        <section class="c-content-box c-size-md c-bg-white">
            <div class="container">
                <div class="c-content-title-1">
                    <h3 class="c-center c-font-uppercase c-font-bold">Kategori Populer</h3>
                    <div class="c-line-center"></div>
                </div>

                <div class="row">
                    <div class="cbp-panel">
                        <div id="filters-container" class="cbp-l-filters-buttonCenter">
                            <!-- Tambahkan filter untuk 'All' -->
                            <div data-filter="*" class="cbp-filter-item cbp-filter-item-active">
                                All
                            </div>
                            @forelse ($clusterResults as $clusterName => $books)
                                <div data-filter=".{{ Str::slug($clusterName) }}" class="cbp-filter-item">
                                    {{ $clusterName }}
                                </div>
                            @empty
                                <p class="text-center">No categories found.</p>
                            @endforelse
                        </div>
                    </div>

                    <div id="grid-container" class="cbp cbp-l-grid-masonry-projects">
                        @forelse ($clusterResults as $clusterName => $books)
                            @foreach ($books as $book)
                                <div class="cbp-item {{ Str::slug($clusterName) }}">
                                    <div class="cbp-caption">
                                        <div class="cbp-caption-defaultWrap">
                                            @if ($book->buku->image)
                                                <img src="{{ asset('images/buku/' . $book->buku->image) }}"
                                                    alt="{{ $book->buku->judul }}" class="img-fluid book-thumbnail">
                                            @else
                                                <div class="no-image-placeholder">
                                                    <i class="fa fa-book"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="" {{-- <a href="{{ route('books.show', $book->buku->id) }}" --}} class="cbp-l-grid-masonry-projects-title">
                                        {{ Str::limit($book->buku->judul, 50) }}
                                    </a>
                                    <div class="cbp-l-grid-masonry-projects-desc">
                                        <p class="author">{{ $book->buku->penulis }}</p>
                                        <p class="year">{{ $book->buku->tahun_terbit }}</p>
                                        @if ($book->buku->tag)
                                            <div class="tags mt-2">
                                                @foreach (explode(',', $book->buku->tag) as $tag)
                                                    <span class="badge badge-primary">
                                                        {{ trim($tag) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @empty
                            <p class="text-center">No books found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Recommended Novels Section -->
        <section class="c-content-box c-size-md c-bg-grey">
            <div class="container">
                <div class="c-content-title-1">
                    <h3 class="c-center c-font-uppercase c-font-bold">Rekomendasi Novel</h3>
                    <div class="c-line-center c-theme-bg"></div>
                </div>
                {{-- <div class="row">
                    @forelse ($recommendedNovels as $novel)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="c-novel-card">
                                <img src="{{ asset('storage/novels/' . $novel->image) }}" class="img-fluid"
                                    alt="{{ $novel->title }}">
                                <h5 class="c-font-bold c-font-uppercase">{{ $novel->title }}</h5>
                                <p>Penulis: {{ $novel->author }}</p>
                                <a href="{{ route('novels.show', $novel->id) }}"
                                    class="btn c-btn-square c-btn-bold c-theme-btn">
                                    Baca Sekarang
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">No recommended novels available.</p>
                        </div>
                    @endforelse
                </div> --}}
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="c-content-box c-size-md c-bg-img-center"
            style="background-image: url('{{ asset('images/cta-bg.jpg') }}');">
            <div class="container">
                <div class="c-content-title-1 c-center">
                    <h3 class="c-font-uppercase c-font-bold c-font-white">Ayo Mulai Membaca Sekarang</h3>
                    <div class="c-line-center c-theme-bg"></div>
                    <a href="" class="btn c-btn-square c-btn-bold c-theme-btn">
                        Jelajahi Sekarang
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')

    <script>
        $(document).ready(function() {
            // Initialize cubeportfolio
            $('#grid-container').cubeportfolio({
                filters: '#filters-container',
                defaultFilter: '*',
                animationType: 'fadeOut',
                gapHorizontal: 30,
                gapVertical: 30,
                gridAdjustment: 'responsive',
                mediaQueries: [{
                    width: 1500,
                    cols: 4,
                }, {
                    width: 1100,
                    cols: 3,
                }, {
                    width: 800,
                    cols: 2,
                }, {
                    width: 480,
                    cols: 1,
                    options: {
                        caption: '',
                        gapHorizontal: 15,
                        gapVertical: 15,
                    }
                }],
                caption: 'overlayBottom',
                displayType: 'fadeIn',
                displayTypeSpeed: 100,
            });

            // Handle filter click
            $('.cbp-filter-item').on('click', function() {
                var $this = $(this);

                // Remove active class from all items
                $('.cbp-filter-item').removeClass('cbp-filter-item-active');

                // Add active class to clicked item
                $this.addClass('cbp-filter-item-active');

                // Get the filter value
                var filterValue = $this.attr('data-filter');

                // Filter the grid
                $('#grid-container').cubeportfolio('filter', filterValue);
            });

            // Set first item as active by default
            $('.cbp-filter-item:first').addClass('cbp-filter-item-active');
        });
    </script>
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

            .book-thumbnail:hover {
                transform: scale(1.05);
                transition: transform 0.3s ease;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .c-novel-card {
                background: white;
                padding: 15px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease;
            }

            .c-novel-card:hover {
                transform: translateY(-5px);
            }

            .tags .badge {
                margin-right: 5px;
                margin-bottom: 5px;
            }
        </style>
    @endpush
