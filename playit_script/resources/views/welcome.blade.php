@extends('layouts.app')
{{-- CSS --}}
@section('css')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <style>
        .flickity-page-dots{
            bottom: 15px !important;
        }
        .flickity-page-dots .dot{
            background: white !important;
        }
        .carousel-cell.is-selected {
            background: #ED2;
        }
        .flickity-button:disabled {
            opacity: 0;
        }
    </style>

@endsection
{{-- CSS End --}}

@section('content')

{{-- Container Start --}}
<div class="container mx-auto bg-gray-800 items-center justify-center text-white">

    {{-- Carousel Start --}}
    @if(count($sliders) >= 1)
    <main class="bg-black text-white flex items-center justify-center w-full" x-data="carouselFilter()">
        <div class="container grid grid-cols-1">
            <div
                class="row-start-2 col-start-1"
                x-show="active == 0"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90">
                <div class="grid grid-cols-1 grid-rows-1" x-data="carousel()" x-init="init()">
                    <div class="col-start-1 row-start-1 relative z-20 flex items-center justify-center pointer-events-none">
                        @foreach($sliders as $key => $slider)
                        <div class="absolute text-center"
                            x-show="active == {{$key}}"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-12"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-out duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform -translate-y-12">
                            <h2 class="flex lg:text-3xl md:text-xl text-lg uppercase text-white tracking-widest bg-blue-500 rounded lg:w-32 md:w-24 w-20  mx-auto md:pb-1 md:pb-1 pb-0 justify-center">@if($slider->type == 'movie') Movie @else Series @endif</h2>
                            <h1 class="lg:text-5xl md:text-3xl text-xl uppercase font-black text-white tracking-widest ">{{ $slider->name }}</h1>
                            <h2 class="lg:text-3xl md:text-xl text-lg uppercase text-white font-bold tracking-widest ">({{ date('Y',strtotime($slider->release_date)) }})</h2>
                        </div>
                        @endforeach
                    </div>
                    <div class="carousel col-start-1 row-start-1" x-ref="carousel">
                        @foreach($sliders as $slider)
                        <div class="w-3/5 px-2">
                            <a href="@if($slider->type == 'movie') {{ url('/movie') }}/{{ $slider->slug }} @else {{ url('/series') }}/{{ $slider->slug }} @endif"><img class="mx-auto" src="{{ $slider->backdrop }}"></a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
    @endif
    {{-- Carousel End --}}

    @if($ads->activate == 1)
        <!-- Ads Start -->
        @if(isset($ads->site_728x90_banner))
        <div class=" 2xl:flex xl:flex lg:hidden md:hidden sm:hidden hidden py-4 justify-center">
            {!! base64_decode($ads->site_728x90_banner) !!}
        </div>
        @endif
        @if(isset($ads->site_468x60_banner))
        <div class="flex 2xl:hidden xl:hidden lg:flex md:flex sm:hidden hidden py-4 justify-center">
            {!!  base64_decode($ads->site_468x60_banner) !!}
        </div>
        @endif
        @if(isset($ads->site_320x100_banner))
        <div class="flex 2xl:hidden xl:hidden lg:hidden md:hidden sm:flex  py-4 justify-center">
            {!!  base64_decode($ads->site_320x100_banner) !!}
        </div>
        @endif
    <!-- Ads End -->
    @endif

    {{-- Trending --}}
    <div class="pt-5">
        <div class="px-5">
            {{-- Header --}}
            <div class="flex justify-between text-2xl font-medium mb-5 tracking-wide">
                <h2 class="text-white text-center flex items-center justify-center">Trending</h2>
                <a class="text-sm text-blue-400 text-center flex items-center justify-center" href="/trending">VIEW MORE</a>
            </div>
            {{-- Card Slider --}}
            <div>
                <div class="relative w-full ">
                    @if(count($trending) > 0)
                        <div class="card-trending"  style="height:425px">
                            @foreach($trending as $trend)

                            <div class="relative" style="width:249px">
                                <div class="slide">
                                    <div class="card-wrapper">
                                        <a href="@if($trend->type == 'movie') {{ url('/movie') }}/{{ $trend->slug }} @else {{ url('/series') }}/{{ $trend->slug }} @endif" title="{{ $trend->name }}" >
                                            <div class="card inline-top loaded portrait-card">
                                                <div class="card-content-wrap ">
                                                    <div class="absolute left-0 top-0 px-2 py-1 bg-blue-500 text-white z-50 ml-1 mt-1 rounded uppercase">@if($trend->type == 'movie') Movie @else Series @endif</div>
                                                    @if(Auth::user())
                                                        <div class="card-actions">
                                                            <button class="watchlist-button-card mr-1 mt-1" data-text="@if(isset(Auth::user()->watchlists()->where('items_id', $trend->id)->first()->watchlist))REMOVE FROM WATCHLIST @else ADD TO WATCHLIST @endif" id="{{ $trend->id }}">
                                                                @if(isset(Auth::user()->watchlists()->where('items_id', $trend->id)->first()->watchlist))
                                                                    <i class="fas fa-minus-circle"></i>
                                                                @else
                                                                    <i class="fas fa-plus-circle"></i>
                                                                @endif
                                                            </button>
                                                            <div class="absolute left-0 right-0 bottom-16 px-2 text-white z-50 rounded uppercase flex text-center justify-between leading-6 h-6 text-xs">
                                                                <div class="flex leading-6 h-6 text-xs">
                                                                    <span class="iconify mr-1" data-icon="la:imdb" data-inline="false" data-width="25" data-height="25"></span> {{ $trend->rating }}
                                                                </div>
                                                                <div class="flex leading-5 h-5 text-xs">
                                                                    <span class="iconify mr-1" data-icon="ion:time-outline" data-inline="false" data-width="20" data-height="20"></span> {{ $trend->duration }}min
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="card-image-content">
                                                        <div class="image-card base-card-image">
                                                            <img width="320px" height="480px" alt="{{ $trend->name }} ({{ date('Y',strtotime($trend->release_date)) }})" title="{{ $trend->name }} ({{ date('Y',strtotime($trend->release_date)) }})" class="original-image" src="{{ $trend->poster }}">
                                                        </div>
                                                        <div>
                                                            <div class="card-overlay show-icon"></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-details" style="overflow: hidden;text-overflow: ellipsis;width: 237px;">
                                                        <h3 class="text-overflow card-header">{{ $trend->name }} ({{ date('Y',strtotime($trend->release_date)) }})</h3>
                                                        <div class="text-overflow card-subheader">
                                                            @foreach ($trend->genres as $singleGenre)
                                                                {{ $loop->first ? '' : ', ' }}
                                                                {{ $singleGenre->name }}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    @else
                        <div class="p-10" >
                            <p>We couldn't find any trending movies or series!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Movies --}}
    <div class="pt-5">
        <div class="px-5">
            {{-- Header --}}
            <div class="flex justify-between text-2xl font-medium mb-5 tracking-wide">
                <h2 class="text-white text-center flex items-center justify-center">Movies</h2>
                <a class="text-sm text-blue-400 text-center flex items-center justify-center" href="/movies">MORE MOVIES</a>
            </div>
            {{-- Card Slider --}}
            <div>
                <div class="relative w-full ">
                    @if(count($front_movies) > 0)
                        <div class="card-movies"  style="height:425px">
                            @foreach($front_movies as $movie)

                            <div class="relative" style="width:249px">
                                <div class="slide">
                                    <div class="card-wrapper">
                                        <a href="{{ url('/movie') }}/{{ $movie->slug }}" title="{{ $movie->name }}">
                                            <div class="card inline-top loaded portrait-card">
                                                <div class="card-content-wrap ">
                                                    @if(Auth::user())
                                                        <div class="card-actions">
                                                            <button class="watchlist-button-card mr-1 mt-1" data-text="@if(isset(Auth::user()->watchlists()->where('items_id', $movie->id)->first()->watchlist))REMOVE FROM WATCHLIST @else ADD TO WATCHLIST @endif" id="{{ $movie->id }}">
                                                                @if(isset(Auth::user()->watchlists()->where('items_id', $movie->id)->first()->watchlist))
                                                                    <i class="fas fa-minus-circle"></i>
                                                                @else
                                                                    <i class="fas fa-plus-circle"></i>
                                                                @endif
                                                            </button>
                                                            <div class="absolute left-0 right-0 bottom-16 px-2 text-white z-50 rounded uppercase flex text-center justify-between leading-6 h-6 text-xs">
                                                                <div class="flex leading-6 h-6 text-xs">
                                                                    <span class="iconify mr-1" data-icon="la:imdb" data-inline="false" data-width="25" data-height="25"></span> {{ $movie->rating }}
                                                                </div>
                                                                <div class="flex leading-5 h-5 text-xs">
                                                                    <span class="iconify mr-1" data-icon="ion:time-outline" data-inline="false" data-width="20" data-height="20"></span> {{ $movie->duration }}min
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="card-image-content">
                                                        <div class="image-card base-card-image">
                                                            <img width="320px" height="480px" alt="{{ $movie->name }} ({{ date('Y',strtotime($movie->release_date)) }})" title="{{ $movie->name }} ({{ date('Y',strtotime($movie->release_date)) }})" class="original-image" src="{{ $movie->poster }}">
                                                        </div>
                                                        <div>
                                                            <div class="card-overlay show-icon"></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-details" style="overflow: hidden;text-overflow: ellipsis;width: 237px;">
                                                        <h3 class="text-overflow card-header">{{ $movie->name }} ({{ date('Y',strtotime($movie->release_date)) }})</h3>
                                                        <div class="text-overflow card-subheader">
                                                            @foreach ($movie->genres as $singleGenre)
                                                                {{ $loop->first ? '' : ', ' }}
                                                                {{ $singleGenre->name }}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    @else
                        <div class="p-10" >
                            <p>We couldn't find any movies!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($ads->activate == 1)
        <!-- Ads Start -->
        @if(isset($ads->site_728x90_banner))
        <div class=" 2xl:flex xl:flex lg:hidden md:hidden sm:hidden hidden py-4 justify-center">
            {!! base64_decode($ads->site_728x90_banner) !!}
        </div>
        @endif
        @if(isset($ads->site_468x60_banner))
        <div class="flex 2xl:hidden xl:hidden lg:flex md:flex sm:hidden hidden py-4 justify-center">
            {!!  base64_decode($ads->site_468x60_banner) !!}
        </div>
        @endif
        @if(isset($ads->site_320x100_banner))
        <div class="flex 2xl:hidden xl:hidden lg:hidden md:hidden sm:flex  py-4 justify-center">
            {!!  base64_decode($ads->site_320x100_banner) !!}
        </div>
        @endif
    <!-- Ads End -->
    @endif

    {{-- Series --}}
    <div class="pt-5">
        <div class="px-5">
            {{-- Header --}}
            <div class="flex justify-between text-2xl font-medium mb-5 tracking-wide">
                <h2 class="text-white text-center flex items-center justify-center">Series</h2>
                <a class="text-sm text-blue-400 text-center flex items-center justify-center" href="/series">MORE SERIES</a>
            </div>
            {{-- Card Slider --}}
            <div>
                <div class="relative w-full ">
                    @if(count($front_series) > 0)
                        <div class="card-series"  style="height:425px">
                            @foreach($front_series as $series)

                            <div class="relative" style="width:249px">
                                <div class="slide">
                                    <div class="card-wrapper">
                                        <a href="{{ url('/series') }}/{{ $series->slug }}" title="{{ $series->name }}">
                                            <div class="card inline-top loaded portrait-card">
                                                <div class="card-content-wrap ">
                                                    @if(Auth::user())
                                                        <div class="card-actions">
                                                            <button class="watchlist-button-card mr-1 mt-1" data-text="@if(isset(Auth::user()->watchlists()->where('items_id', $series->id)->first()->watchlist))REMOVE FROM WATCHLIST @else ADD TO WATCHLIST @endif" id="{{ $series->id }}">
                                                                @if(isset(Auth::user()->watchlists()->where('items_id', $series->id)->first()->watchlist))
                                                                    <i class="fas fa-minus-circle"></i>
                                                                @else
                                                                    <i class="fas fa-plus-circle"></i>
                                                                @endif
                                                            </button>
                                                            <div class="absolute left-0 right-0 bottom-16 px-2 text-white z-50 rounded uppercase flex text-center justify-between leading-6 h-6 text-xs">
                                                                <div class="flex leading-6 h-6 text-xs">
                                                                    <span class="iconify mr-1" data-icon="la:imdb" data-inline="false" data-width="25" data-height="25"></span> {{ $series->rating }}
                                                                </div>
                                                                <div class="flex leading-5 h-5 text-xs">
                                                                    <span class="iconify mr-1" data-icon="ion:time-outline" data-inline="false" data-width="20" data-height="20"></span> {{ $series->duration }}min
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="card-image-content">
                                                        <div class="image-card base-card-image">
                                                            <img width="320px" height="480px" alt="{{ $series->name }} ({{ date('Y',strtotime($series->release_date)) }})" title="{{ $series->name }} ({{ date('Y',strtotime($series->release_date)) }})" class="original-image" src="{{ $series->poster }}">
                                                        </div>
                                                        <div>
                                                            <div class="card-overlay show-icon"></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-details" style="overflow: hidden;text-overflow: ellipsis;width: 237px;">
                                                        <h3 class="text-overflow card-header">{{ $series->name }} ({{ date('Y',strtotime($series->release_date)) }})</h3>
                                                        <div class="text-overflow card-subheader">
                                                            @foreach ($series->genres as $singleGenre)
                                                                {{ $loop->first ? '' : ', ' }}
                                                                {{ $singleGenre->name }}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    @else
                        <div class="p-10" >
                            <p>We couldn't find any series!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Recommend --}}
    <div class="pt-5">
        <div class="px-5">
            {{-- Header --}}
            <div class="flex justify-between text-2xl font-medium mb-5 tracking-wide">
                <h2 class="text-white text-center flex items-center justify-center">Recommended</h2>
            </div>
            {{-- Card Slider --}}
            <div>
                <div class="relative w-full ">
                    @if(count($recommended) > 0)
                        <div class="card-recommend"  style="height:425px">
                            @foreach($recommended as $recommend)

                            <div class="relative" style="width:249px">
                                <div class="slide">
                                    <div class="card-wrapper">
                                        <a href="@if($recommend->type == 'movie') {{ url('/movie') }}/{{ $recommend->slug }} @else {{ url('/series') }}/{{ $recommend->slug }} @endif" title="{{ $recommend->name }}" >
                                            <div class="card inline-top loaded portrait-card">
                                                <div class="card-content-wrap ">
                                                    <div class="absolute left-0 top-0 px-2 py-1 bg-blue-500 text-white z-50 ml-1 mt-1 rounded uppercase">@if($recommend->type == 'movie') Movie @else Series @endif</div>
                                                    @if(Auth::user())
                                                        <div class="card-actions">
                                                            <button class="watchlist-button-card mr-1 mt-1" data-text="@if(isset(Auth::user()->watchlists()->where('items_id', $recommend->id)->first()->watchlist))REMOVE FROM WATCHLIST @else ADD TO WATCHLIST @endif" id="{{ $recommend->id }}">
                                                                @if(isset(Auth::user()->watchlists()->where('items_id', $recommend->id)->first()->watchlist))
                                                                    <i class="fas fa-minus-circle"></i>
                                                                @else
                                                                    <i class="fas fa-plus-circle"></i>
                                                                @endif
                                                            </button>
                                                            <div class="absolute left-0 right-0 bottom-16 px-2 text-white z-50 rounded uppercase flex text-center justify-between leading-6 h-6 text-xs">
                                                                <div class="flex leading-6 h-6 text-xs">
                                                                    <span class="iconify mr-1" data-icon="la:imdb" data-inline="false" data-width="25" data-height="25"></span> {{ $recommend->rating }}
                                                                </div>
                                                                <div class="flex leading-5 h-5 text-xs">
                                                                    <span class="iconify mr-1" data-icon="ion:time-outline" data-inline="false" data-width="20" data-height="20"></span> {{ $recommend->duration }}min
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="card-image-content">
                                                        <div class="image-card base-card-image">
                                                            <img width="320px" height="480px" alt="{{ $recommend->name }} ({{ date('Y',strtotime($recommend->release_date)) }})" title="{{ $recommend->name }} ({{ date('Y',strtotime($recommend->release_date)) }})" class="original-image" src="{{ $recommend->poster }}">
                                                        </div>
                                                        <div>
                                                            <div class="card-overlay show-icon"></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-details" style="overflow: hidden;text-overflow: ellipsis;width: 237px;">
                                                        <h3 class="text-overflow card-header">{{ $recommend->name }} ({{ date('Y',strtotime($recommend->release_date)) }})</h3>
                                                        <div class="text-overflow card-subheader">
                                                            @foreach ($recommend->genres as $singleGenre)
                                                                {{ $loop->first ? '' : ', ' }}
                                                                {{ $singleGenre->name }}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    @else
                        <div class="p-10" >
                            <p>We couldn't find any recommended movies or series!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($ads->activate == 1)
        <!-- Ads Start -->
        @if(isset($ads->site_728x90_banner))
        <div class=" 2xl:flex xl:flex lg:hidden md:hidden sm:hidden hidden py-4 justify-center">
            {!! base64_decode($ads->site_728x90_banner) !!}
        </div>
        @endif
        @if(isset($ads->site_468x60_banner))
        <div class="flex 2xl:hidden xl:hidden lg:flex md:flex sm:hidden hidden py-4 justify-center">
            {!!  base64_decode($ads->site_468x60_banner) !!}
        </div>
        @endif
        @if(isset($ads->site_320x100_banner))
        <div class="flex 2xl:hidden xl:hidden lg:hidden md:hidden sm:flex  py-4 justify-center">
            {!!  base64_decode($ads->site_320x100_banner) !!}
        </div>
        @endif
    <!-- Ads End -->
    @endif

    {{-- Randoms --}}
    <div class="pt-5">
        <div class="px-5">
            {{-- Header --}}
            <div class="flex justify-between text-2xl font-medium mb-5 tracking-wide">
                <h2 class="text-white text-center flex items-center justify-center">Randoms</h2>
            </div>
            {{-- Card Slider --}}
            <div>
                <div class="relative w-full ">
                    @if(count($randoms) > 0)
                        <div class="card-randoms"  style="height:425px">
                            @foreach($randoms as $random)

                            <div class="relative" style="width:249px">
                                <div class="slide">
                                    <div class="card-wrapper">
                                        <a href="@if($random->type == 'movie') {{ url('/movie') }}/{{ $random->slug }} @else {{ url('/series') }}/{{ $random->slug }} @endif" title="{{ $random->name }}" >
                                            <div class="card inline-top loaded portrait-card">
                                                <div class="card-content-wrap ">
                                                    <div class="absolute left-0 top-0 px-2 py-1 bg-blue-500 text-white z-50 ml-1 mt-1 rounded uppercase">@if($random->type == 'movie') Movie @else Series @endif</div>
                                                    @if(Auth::user())
                                                        <div class="card-actions">
                                                            <button class="watchlist-button-card mr-1 mt-1" data-text="@if(isset(Auth::user()->watchlists()->where('items_id', $random->id)->first()->watchlist))REMOVE FROM WATCHLIST @else ADD TO WATCHLIST @endif" id="{{ $random->id }}">
                                                                @if(isset(Auth::user()->watchlists()->where('items_id', $random->id)->first()->watchlist))
                                                                    <i class="fas fa-minus-circle"></i>
                                                                @else
                                                                    <i class="fas fa-plus-circle"></i>
                                                                @endif
                                                            </button>
                                                            <div class="absolute left-0 right-0 bottom-16 px-2 text-white z-50 rounded uppercase flex text-center justify-between leading-6 h-6 text-xs">
                                                                <div class="flex leading-6 h-6 text-xs">
                                                                    <span class="iconify mr-1" data-icon="la:imdb" data-inline="false" data-width="25" data-height="25"></span> {{ $random->rating }}
                                                                </div>
                                                                <div class="flex leading-5 h-5 text-xs">
                                                                    <span class="iconify mr-1" data-icon="ion:time-outline" data-inline="false" data-width="20" data-height="20"></span> {{ $random->duration }}min
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="card-image-content">
                                                        <div class="image-card base-card-image">
                                                            <img width="320px" height="480px" alt="{{ $random->name }} ({{ date('Y',strtotime($random->release_date)) }})" title="{{ $random->name }} ({{ date('Y',strtotime($random->release_date)) }})" class="original-image" src="{{ $random->poster }}">
                                                        </div>
                                                        <div>
                                                            <div class="card-overlay show-icon"></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-details" style="overflow: hidden;text-overflow: ellipsis;width: 237px;">
                                                        <h3 class="text-overflow card-header">{{ $random->name }} ({{ date('Y',strtotime($random->release_date)) }})</h3>
                                                        <div class="text-overflow card-subheader">
                                                            @foreach ($random->genres as $singleGenre)
                                                                {{ $loop->first ? '' : ', ' }}
                                                                {{ $singleGenre->name }}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    @else
                        <div class="p-10" >
                            <p>We couldn't find any randoms movies or series!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
{{-- Container End --}}

{{-- JavaScript --}}
@section('js')
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    <script>
        function carousel() {
            return {
                active: 0,
                init() {
                    var flkty = new Flickity(this.$refs.carousel, {
                        wrapAround: true,
                        autoPlay: true,
                        pauseAutoPlayOnHover: false,
                        lazyLoad: false,
                    });
                    flkty.on('change', i => this.active = i);
                }
            }
        }

        function carouselFilter() {
            return {
                active: 0,
                changeActive(i) {
                    this.active = i;
                    this.$nextTick(() => {
                        let flkty = Flickity.data( this.$el.querySelectorAll('.card-slider')[i] );
                        flkty.resize();
                        console.log(flkty);
                    });
                }
            }
        }

        var trending = new Flickity( '.card-trending', {
            // options, defaults listed
            accessibility: true,
            // enable keyboard navigation, pressing left & right keys
            adaptiveHeight: false,
            // set carousel height to the selected slide
            autoPlay: false,
            // advances to the next cell
            // if true, default is 3 seconds
            // or set time between advances in milliseconds
            // i.e. `autoPlay: 1000` will advance every 1 second
            cellAlign: 'left',
            // alignment of cells, 'center', 'left', or 'right'
            // or a decimal 0-1, 0 is beginning (left) of container, 1 is end (right)
            cellSelector: undefined,
            // specify selector for cell elements
            contain: true,
            // will contain cells to container
            // so no excess scroll at beginning or end
            // has no effect if wrapAround is enabled
            draggable: '>1',
            // enables dragging & flicking
            // if at least 2 cells
            dragThreshold: 3,
            // number of pixels a user must scroll horizontally to start dragging
            // increase to allow more room for vertical scroll for touch devices
            freeScroll: false,
            // enables content to be freely scrolled and flicked
            // without aligning cells
            friction: 0.2,
            // smaller number = easier to flick farther
            groupCells: false,
            // group cells together in slides
            initialIndex: 0,
            // zero-based index of the initial selected cell
            lazyLoad: false,
            // enable lazy-loading images
            // set img data-flickity-lazyload="src.jpg"
            // set to number to load images adjacent cells
            percentPosition: true,
            // sets positioning in percent values, rather than pixels
            // Enable if items have percent widths
            // Disable if items have pixel widths, like images
            prevNextButtons: true,
            // creates and enables buttons to click to previous & next cells
            pageDots: false,
            // create and enable page dots
            resize: true,
            // listens to window resize events to adjust size & positions
            rightToLeft: false,
            // enables right-to-left layout
            setGallerySize: false,
            // sets the height of gallery
            // disable if gallery already has height set with CSS
            watchCSS: false,
            // watches the content of :after of the element
            // activates if #element:after { content: 'flickity' }
            wrapAround: true
            // at end of cells, wraps-around to first for infinite scrolling

        });

        var movies = new Flickity( '.card-movies', {
            // options, defaults listed
            accessibility: true,
            // enable keyboard navigation, pressing left & right keys
            adaptiveHeight: false,
            // set carousel height to the selected slide
            autoPlay: false,
            // advances to the next cell
            // if true, default is 3 seconds
            // or set time between advances in milliseconds
            // i.e. `autoPlay: 1000` will advance every 1 second
            cellAlign: 'left',
            // alignment of cells, 'center', 'left', or 'right'
            // or a decimal 0-1, 0 is beginning (left) of container, 1 is end (right)
            cellSelector: undefined,
            // specify selector for cell elements
            contain: true,
            // will contain cells to container
            // so no excess scroll at beginning or end
            // has no effect if wrapAround is enabled
            draggable: '>1',
            // enables dragging & flicking
            // if at least 2 cells
            dragThreshold: 3,
            // number of pixels a user must scroll horizontally to start dragging
            // increase to allow more room for vertical scroll for touch devices
            freeScroll: false,
            // enables content to be freely scrolled and flicked
            // without aligning cells
            friction: 0.2,
            // smaller number = easier to flick farther
            groupCells: false,
            // group cells together in slides
            initialIndex: 0,
            // zero-based index of the initial selected cell
            lazyLoad: false,
            // enable lazy-loading images
            // set img data-flickity-lazyload="src.jpg"
            // set to number to load images adjacent cells
            percentPosition: true,
            // sets positioning in percent values, rather than pixels
            // Enable if items have percent widths
            // Disable if items have pixel widths, like images
            prevNextButtons: true,
            // creates and enables buttons to click to previous & next cells
            pageDots: false,
            // create and enable page dots
            resize: true,
            // listens to window resize events to adjust size & positions
            rightToLeft: false,
            // enables right-to-left layout
            setGallerySize: false,
            // sets the height of gallery
            // disable if gallery already has height set with CSS
            watchCSS: false,
            // watches the content of :after of the element
            // activates if #element:after { content: 'flickity' }
            wrapAround: true
            // at end of cells, wraps-around to first for infinite scrolling

        });

        var series = new Flickity( '.card-series', {
            // options, defaults listed
            accessibility: true,
            // enable keyboard navigation, pressing left & right keys
            adaptiveHeight: false,
            // set carousel height to the selected slide
            autoPlay: false,
            // advances to the next cell
            // if true, default is 3 seconds
            // or set time between advances in milliseconds
            // i.e. `autoPlay: 1000` will advance every 1 second
            cellAlign: 'left',
            // alignment of cells, 'center', 'left', or 'right'
            // or a decimal 0-1, 0 is beginning (left) of container, 1 is end (right)
            cellSelector: undefined,
            // specify selector for cell elements
            contain: true,
            // will contain cells to container
            // so no excess scroll at beginning or end
            // has no effect if wrapAround is enabled
            draggable: '>1',
            // enables dragging & flicking
            // if at least 2 cells
            dragThreshold: 3,
            // number of pixels a user must scroll horizontally to start dragging
            // increase to allow more room for vertical scroll for touch devices
            freeScroll: false,
            // enables content to be freely scrolled and flicked
            // without aligning cells
            friction: 0.2,
            // smaller number = easier to flick farther
            groupCells: false,
            // group cells together in slides
            initialIndex: 0,
            // zero-based index of the initial selected cell
            lazyLoad: false,
            // enable lazy-loading images
            // set img data-flickity-lazyload="src.jpg"
            // set to number to load images adjacent cells
            percentPosition: true,
            // sets positioning in percent values, rather than pixels
            // Enable if items have percent widths
            // Disable if items have pixel widths, like images
            prevNextButtons: true,
            // creates and enables buttons to click to previous & next cells
            pageDots: false,
            // create and enable page dots
            resize: true,
            // listens to window resize events to adjust size & positions
            rightToLeft: false,
            // enables right-to-left layout
            setGallerySize: false,
            // sets the height of gallery
            // disable if gallery already has height set with CSS
            watchCSS: false,
            // watches the content of :after of the element
            // activates if #element:after { content: 'flickity' }
            wrapAround: true
            // at end of cells, wraps-around to first for infinite scrolling

        });

        var recommend = new Flickity( '.card-recommend', {
            // options, defaults listed
            accessibility: true,
            // enable keyboard navigation, pressing left & right keys
            adaptiveHeight: false,
            // set carousel height to the selected slide
            autoPlay: false,
            // advances to the next cell
            // if true, default is 3 seconds
            // or set time between advances in milliseconds
            // i.e. `autoPlay: 1000` will advance every 1 second
            cellAlign: 'left',
            // alignment of cells, 'center', 'left', or 'right'
            // or a decimal 0-1, 0 is beginning (left) of container, 1 is end (right)
            cellSelector: undefined,
            // specify selector for cell elements
            contain: true,
            // will contain cells to container
            // so no excess scroll at beginning or end
            // has no effect if wrapAround is enabled
            draggable: '>1',
            // enables dragging & flicking
            // if at least 2 cells
            dragThreshold: 3,
            // number of pixels a user must scroll horizontally to start dragging
            // increase to allow more room for vertical scroll for touch devices
            freeScroll: false,
            // enables content to be freely scrolled and flicked
            // without aligning cells
            friction: 0.2,
            // smaller number = easier to flick farther
            groupCells: false,
            // group cells together in slides
            initialIndex: 0,
            // zero-based index of the initial selected cell
            lazyLoad: false,
            // enable lazy-loading images
            // set img data-flickity-lazyload="src.jpg"
            // set to number to load images adjacent cells
            percentPosition: true,
            // sets positioning in percent values, rather than pixels
            // Enable if items have percent widths
            // Disable if items have pixel widths, like images
            prevNextButtons: true,
            // creates and enables buttons to click to previous & next cells
            pageDots: false,
            // create and enable page dots
            resize: true,
            // listens to window resize events to adjust size & positions
            rightToLeft: false,
            // enables right-to-left layout
            setGallerySize: false,
            // sets the height of gallery
            // disable if gallery already has height set with CSS
            watchCSS: false,
            // watches the content of :after of the element
            // activates if #element:after { content: 'flickity' }
            wrapAround: true
            // at end of cells, wraps-around to first for infinite scrolling

        });

        var randoms = new Flickity( '.card-randoms', {
            // options, defaults listed
            accessibility: true,
            // enable keyboard navigation, pressing left & right keys
            adaptiveHeight: false,
            // set carousel height to the selected slide
            autoPlay: false,
            // advances to the next cell
            // if true, default is 3 seconds
            // or set time between advances in milliseconds
            // i.e. `autoPlay: 1000` will advance every 1 second
            cellAlign: 'left',
            // alignment of cells, 'center', 'left', or 'right'
            // or a decimal 0-1, 0 is beginning (left) of container, 1 is end (right)
            cellSelector: undefined,
            // specify selector for cell elements
            contain: true,
            // will contain cells to container
            // so no excess scroll at beginning or end
            // has no effect if wrapAround is enabled
            draggable: '>1',
            // enables dragging & flicking
            // if at least 2 cells
            dragThreshold: 3,
            // number of pixels a user must scroll horizontally to start dragging
            // increase to allow more room for vertical scroll for touch devices
            freeScroll: false,
            // enables content to be freely scrolled and flicked
            // without aligning cells
            friction: 0.2,
            // smaller number = easier to flick farther
            groupCells: false,
            // group cells together in slides
            initialIndex: 0,
            // zero-based index of the initial selected cell
            lazyLoad: false,
            // enable lazy-loading images
            // set img data-flickity-lazyload="src.jpg"
            // set to number to load images adjacent cells
            percentPosition: true,
            // sets positioning in percent values, rather than pixels
            // Enable if items have percent widths
            // Disable if items have pixel widths, like images
            prevNextButtons: true,
            // creates and enables buttons to click to previous & next cells
            pageDots: false,
            // create and enable page dots
            resize: true,
            // listens to window resize events to adjust size & positions
            rightToLeft: false,
            // enables right-to-left layout
            setGallerySize: false,
            // sets the height of gallery
            // disable if gallery already has height set with CSS
            watchCSS: false,
            // watches the content of :after of the element
            // activates if #element:after { content: 'flickity' }
            wrapAround: true
            // at end of cells, wraps-around to first for infinite scrolling

        });
    </script>
@endsection
{{-- JavaScript End--}}

@endsection

