<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('setting_img') }}/{{ $general->site_favicon }}" type="image/png" sizes="16x16">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title, Description, Keywords -->
	@if(Route::current()->getName() == 'homepage')
    <title>{{ $general->site_name }} - {{ $general->site_title }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @elseif(Route::current()->getName() == 'single-movie')
    <title>{{ $movies->name }} ({{ date('Y', strtotime($movies->release_date))  }}) - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $movies->name}} ({{date('Y', strtotime($movies->release_date))}}) - {{ $movies->description }}"/>
        <meta name="keywords" content="{{ strtolower($movies->name)}},@php $resultstr = array(); foreach ($movies->keywords as $result) { $resultstr[] = $result->name; } echo implode(',',$resultstr); @endphp"/>
        @elseif(Route::current()->getName() == 'single-series')
    <title>{{ $series->name }} ({{ date('Y', strtotime($series->release_date))  }}) - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $series->name}} ({{date('Y', strtotime($series->release_date))}}) - {{ $series->description }}"/>
        <meta name="keywords" content="{{ strtolower($series->name)}},@php $resultstr = array(); foreach ($series->keywords as $result) { $resultstr[] = $result->name; } echo implode(',',$resultstr); @endphp"/>
        @elseif(Route::current()->getName() == 'single-episode')
    <title>{{ $series->name }} Season {{ $episode->season_id }} Episode {{ $episode->episode_id }} (S{{ $episode->season_id }}E{{ $episode->episode_id }}) - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $series->name }} Season {{ $episode->season_id }} Episode {{ $episode->episode_id }} (S{{ $episode->season_id }}E{{ $episode->episode_id }}) - {{ $series->description }}"/>
        <meta name="keywords" content="{{ $series->name }}, Season {{ $episode->season_id }}, Episode {{ $episode->episode_id }}, S{{ $episode->season_id }}E{{ $episode->episode_id }},Episode , Season"/>
        @elseif(Route::current()->getName() == 'movies-lists')
    <title>All Movies Lists - {{ $general->site_name }}</title>
        <meta name="description" content="All Movies Lists - {{ $general->site_name }} - {{ $general->site_description }}"/>
        <meta name="keywords" content="all, movies, lists,{{ $general->site_name }}"/>
        @elseif(Route::current()->getName() == 'series-lists')
    <title>All Series Lists - {{ $general->site_name }}</title>
        <meta name="description" content="All Series Lists - {{ $general->site_name }} - {{ $general->site_description }}"/>
        <meta name="keywords" content="all, series, lists,{{ $general->site_name }}"/>
        @elseif(Route::current()->getName() == 'latest-episode-list')
    <title>All Latest Episodes Lists - {{ $general->site_name }}</title>
        <meta name="description" content="All Latest Episodes Lists - {{ $general->site_name }} - {{ $general->site_description }}"/>
        <meta name="keywords" content="all, latest, episodes, lists,{{ $general->site_name }}"/>
        @elseif(Route::current()->getName() == 'single-page')
    <title>{{ $pages->title }} - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $pages->title }} - {{ $general->site_name }} - {{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $pages->title }},page,{{ $general->site_name }}"/>
        @elseif(Route::current()->getName() == 'genres-list')
    <title>{{ $pagename }} - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @elseif(Route::current()->getName() == 'country-list')
    <title>{{ $pagename }} - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @elseif(Route::current()->getName() == 'year-list')
    <title>{{ $pagename }} - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @elseif(Route::current()->getName() == 'quality-list')
    <title>{{ $pagename }} - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @elseif(Route::current()->getName() == 'director-list')
    <title>{{ $pagename }} - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @elseif(Route::current()->getName() == 'creator-list')
    <title>{{ $pagename }} - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @elseif(Route::current()->getName() == 'actor-list')
    <title>{{ $pagename }} - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @elseif(Route::current()->getName() == 'start-with-list')
    <title>{{ $pagename }} - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @elseif(Route::current()->getName() == 'trending-list')
    <title>{{ $pagename }} - {{ $general->site_name }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @else
    <title>{{ $general->site_name }} - {{ $general->site_title }}</title>
        <meta name="description" content="{{ $general->site_description }}"/>
        <meta name="keywords" content="{{ $general->site_keywords }}"/>
        @endif

    <!-- Seo Verification -->
    <meta name="google-site-verification" content="{{ $seosettings->site_google_verification_code }}" />
    <meta name="msvalidate.01" content="{{ $seosettings->site_bing_verification_code }}" />
    <meta name="yandex-verification" content="{{ $seosettings->site_yandex_verification_code }}"/>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://kit.fontawesome.com/71b7145720.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        [x-cloak] { display: none }

        .slide {
            display: inline;
            vertical-align: top;
        }
        .card-wrapper {
            display: inline;
        }
        body[data-theme=dark] .card, body[data-theme=dark] .card-header, body[data-theme=dark] .card-subheader {
            color: #dadde4;
        }
        .card.loaded {
            opacity: 1;
            transform: translateY(0);
        }
        .inline-top {
            display: inline-block;
            vertical-align: top;
        }
        .card {
            width: auto;
            position: relative;
            padding: 0 6px;
            margin: 5px 0;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: transform .2s,opacity .2s;
        }
        .card.loaded:hover, .card.playing {
            transition: transform .2s;
            transform: translateY(0);
        }
        .card .card-content-wrap {
            width: 100%;
            position: relative;
        }
        .card:hover .card-actions{
            opacity:1
        }
        .card-actions{
            z-index:3;
            position:absolute;
            opacity:0;
            height:100%;
            width:100%;
            top:0;
            left:0;
            transition:opacity .2s;
            pointer-events:none
        }
        .watchlist-button-card{
            display:inline-block;
            position:absolute;
            top:5px;
            right:5px;
            line-height:1;
            color:#fff;
            vertical-align:top;
            cursor:pointer;
            overflow:visible;
            pointer-events:all
        }
        .watchlist-button-card svg{
            width:24px;
            height:24px;
            vertical-align:top;
            fill:#fff
        }
        .watchlist-button-card:before{
            position:absolute;
            right:100%;
            opacity:0;
            transition:opacity .3s;
            padding:2px 5px;
            font-size:11px;
            content:attr(data-text);
            pointer-events:none;
            white-space:nowrap
        }
        .watchlist-button-card:hover:before{
            pointer-events:all;
            opacity:1
        }
        .watchlist-button-text{
            vertical-align:top;
            text-align:right;
            padding:2px;
            font-size:9px;
            opacity:0;
            pointer-events:none;
            display:inline-block;
            transition:opacity .3s
        }
        .card .card-image-content {
            position: relative;
            border-radius: 3px;
            font-size: 0;
            overflow: hidden;
            box-shadow: 0 2px 5px 0 rgb(34 34 34 / 40%);
        }
        .card:hover .card-image-content {
            box-shadow: 0 4px 10px 0 rgb(34 34 34 / 40%);
        }
        .card .image-card {
            transition: transform .2s;
        }
        .card.playing .base-card-image, .card:hover .base-card-image {
            transform: scale(1.05,1.1);
        }
        .image-card {
            position: relative;
            width: 100%;
        }
        .image-card .hidden {
            visibility: hidden;
        }
        .image-card .original-image {
            left: 0;
            top: 0;
            height: 100%;
        }
        .image-card img {
            width: 100%;
        }
        .card .card-overlay {
            background: url('https://api.iconify.design/bi:play.svg?color=%23ffffff&width=60&height=60') no-repeat center center;
            opacity: 0;
            top: 0;
            left: 0;
            transition: opacity .2s;
            background-color: rgba(0,0,0,.6);
        }
        .card .card-overlay, .card .normal-image {
            position: absolute;
            width: 100%;
            height: 100%;
        }
        .card.playing .card-overlay.show-icon, .card:hover .card-overlay.show-icon {
            opacity: 1;
        }
        .card-details{
            padding:10px 0
        }
        .text-overflow{
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis
        }
        .card-header{
            color:#ffffff;
            font-weight:600;
            font-size:14px;
            margin-bottom:3px;
            line-height:20px;
            letter-spacing:0;
            letter-spacing:.1px
        }
        .card-subheader{
            color:#ffffff;
            font-size:12px;
            line-height:16px
        }

        /*--------------------Scroll--------------------*/
        body ::-webkit-scrollbar{-webkit-appearance:none;width:10px;height:10px}
        body ::-webkit-scrollbar-track{background:rgb(0, 0, 0);border-radius:0}
        body ::-webkit-scrollbar-thumb{cursor:pointer;border-radius:5px;background:rgba(0,0,0,.25);-webkit-transition:color .2s ease;transition:color .2s ease}
        body ::-webkit-scrollbar-thumb:window-inactive{background:rgb(0, 0, 0)}
        body ::-webkit-scrollbar-thumb:hover{background:rgb(0, 140, 255)}
        body .ui.inverted::-webkit-scrollbar-track{background:rgba(255,255,255,.1)}
        body .ui.inverted::-webkit-scrollbar-thumb{background:rgba(255,255,255,.25)}
        body .ui.inverted::-webkit-scrollbar-thumb:window-inactive{background:rgba(255,255,255,.15)}
        body .ui.inverted::-webkit-scrollbar-thumb:hover{background:rgb(0, 140, 255)}
    </style>

    @if(isset($seosettings->site_google_analytics))
    <!-- Google analytics -->
    {!! $seosettings->site_google_analytics !!}
    @endif

    @yield('css')
</head>
<body class="bg-gray-900 h-screen antialiased leading-none font-Poppins">
    <header class="fixed sticky top-0 container mx-auto bg-gray-700 z-50 h-14">
        <div class="flex justify-between items-center px-6 h-full">
            <div class="flex items-center">
                <a href="{{ url('/') }}" >
                    <img src="{{ asset('public/setting_img') }}/{{ $general->site_logo }}" alt="logo" class="h-8">
                </a>
                {{-- Mobile Menu --}}
                <div x-cloak class="relative flex items-center w-auto h-full rounded-lg lg:hidden" x-data="{ open: false, visible: false }" x-init="
                    $watch('open', value => {
                    if (value === true) { visible = true; }
                    else { setTimeout(function(){ visible = false; }, 500); }
                    });" >
                    <div @click="open=true" class="flex items-center justify-center text-white hover:text-blue-400 cursor-pointer w-9 h-9">
                        <svg class="w-6 h-6 fill-current" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"></path>
                        </svg>
                    </div>
                    <div  @keydown.window.escape="open = false;" :class="{ 'hidden': !visible }" class="fixed inset-0 z-50 overflow-hidden hidden">
                        <div class="absolute inset-0 overflow-hidden">
                            <div x-show="open" x-transition:enter="ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 transition-opacity bg-gray-900 bg-opacity-75" style="display: none;"></div>
                            <section @click.away="open = false;" class="absolute inset-y-0 left-0 flex max-w-full pr-10">
                                <div class="relative w-screen max-w-md" x-description="Slide-over panel, show/hide based on slide-over state." x-show="open" x-transition:enter="transform transition ease-out duration-500 sm:duration-700" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" style="display: none;">
                                    <div class="flex flex-col h-full py-4 space-y-6 overflow-y-scroll bg-gray-900 shadow-xl">
                                        <div class="relative flex flex-col flex-1 px-4 sm:px-6 top-12">
                                            <nav>
                                                <div>
                                                    <a href="/" class="mx-auto py-5 flex items-center justify-center"><img src="{{ asset('public/setting_img') }}/{{ $general->site_logo }}" class="h-12"></a>

                                                    <a href="/" class="px-3 py-2 flex items-center text-xl uppercase font-bold {{ request()->is('/') ? 'text-white' : 'text-gray-400' }} hover:text-white"><span class="iconify text-lg leading-lg" data-icon="bx:bxs-home" data-inline="false" data-width="18" data-height="18"></span><span class="ml-2">Home</span></a>
                                                    <a href="/movies" class="px-3 py-2 flex items-center text-xl uppercase font-semibold {{ request()->is('movies') ? 'text-white' : 'text-gray-400' }} hover:text-white"><span class="iconify text-lg leading-lg" data-icon="bx:bx-movie-play" data-inline="false" data-width="18" data-height="18"></span><span class="ml-2">Movies</span></a>
                                                    <a href="/series" class="px-3 py-2 flex items-center text-xl uppercase font-semibold {{ request()->is('series') ? 'text-white' : 'text-gray-400' }} hover:text-white"><span class="iconify text-lg leading-lg" data-icon="fa-solid:tv" data-inline="false" data-width="18" data-height="18"></span><span class="ml-2">Series</span></a>
                                                    <a href="/latest-episodes" class="px-3 py-2 flex items-center text-xl uppercase font-semibold {{ request()->is('latest-episodes') ? 'text-white' : 'text-gray-400' }} hover:text-white"><span class="iconify text-lg leading-lg" data-icon="el:video" data-inline="false" data-width="18" data-height="18"></span><span class="ml-2">Episodes</span></a>
                                                    <a href="/trending" class="px-3 py-2 flex items-center text-xl uppercase font-semibold {{ request()->is('trending') ? 'text-white' : 'text-gray-400' }} hover:text-white"><span class="iconify text-lg leading-lg" data-icon="emojione-monotone:fire" data-inline="false" data-width="18" data-height="18"></span><span class="ml-2">Trending</span></a>

                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                    <div x-description="Close button, show/hide based on slide-over state." x-show="open" x-transition:enter="ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-out duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute top-0 right-0 flex pt-4 pl-2 -mr-8 sm:-mr-10 sm:pl-4" style="display: none;">
                                        <button @click="open = false;" aria-label="Close panel" class="text-gray-300 transition duration-150 ease-out hover:text-white">
                                            <svg class="w-6 h-6" x-description="Heroicon name: x" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                {{-- Mobile Menu End --}}
            </div>
            {{-- Desktop menu --}}
            <div class="lg:flex hidden flex-grow items-center mx-5">
                <ul class="flex flex-col md:flex-row list-none md:mr-auto">
                    <li class="nav-item">
                        <a href="/" class="px-3 py-2 flex items-center text-sm uppercase font-bold {{ request()->is('/') ? 'text-white' : 'text-gray-400' }} hover:text-white"><span class="iconify text-lg leading-lg" data-icon="bx:bxs-home" data-inline="false" data-width="18" data-height="18"></span><span class="ml-2">Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/movies" class="px-3 py-2 flex items-center text-sm uppercase font-semibold {{ request()->is('movies') ? 'text-white' : 'text-gray-400' }} hover:text-white"><span class="iconify text-lg leading-lg" data-icon="bx:bx-movie-play" data-inline="false" data-width="18" data-height="18"></span><span class="ml-2">Movies</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/series" class="px-3 py-2 flex items-center text-sm uppercase font-semibold {{ request()->is('series') ? 'text-white' : 'text-gray-400' }} hover:text-white"><span class="iconify text-lg leading-lg" data-icon="fa-solid:tv" data-inline="false" data-width="18" data-height="18"></span><span class="ml-2">Series</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/latest-episodes" class="px-3 py-2 flex items-center text-sm uppercase font-semibold {{ request()->is('latest-episodes') ? 'text-white' : 'text-gray-400' }} hover:text-white"><span class="iconify text-lg leading-lg" data-icon="el:video" data-inline="false" data-width="18" data-height="18"></span><span class="ml-2">Episodes</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="/trending" class="px-3 py-2 flex items-center text-sm uppercase font-semibold {{ request()->is('trending') ? 'text-white' : 'text-gray-400' }} hover:text-white"><span class="iconify text-lg leading-lg" data-icon="emojione-monotone:fire" data-inline="false" data-width="18" data-height="18"></span><span class="ml-2">Trending</span></a>
                    </li>
                </ul>
            </div>
            {{-- End Desktop menu --}}
            {{-- Right Menu --}}
            <nav class="flex items-center justify-center space-x-4 text-gray-300 text-sm sm:text-base">

                <!-- search modal start -->
                <div x-cloak x-data="{ 'searchModal': false }" @keydown.escape="searchModal = false" class="flex items-center justify-center ">
                    <!-- Modal -->
                    <button class="cursor-pointer focus:outline-none text-xl hover:text-white duration-200 " @click="searchModal = true">
                        <span class="iconify" data-icon="octicon:search-16" data-inline="false"  data-width="25" data-height="25"></span>
                    </button>
                    <!-- Modal inner -->
                    <div class="container mx-auto fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="searchModal">
                        <!-- inner modal -->
                        <div class="w-full h-full mx-auto text-left bg-gray-800 shadow-lg" @click.away="searchModal = false">
                            {{-- Close Modal --}}
                            <div class="absolute top-1 right-2">
                                <span class="flex shadow-sm">
                                <button @click="searchModal = false" class="inline-flex justify-end w-full p-4 text-white text-3xl hover:text-gray-400 focus:outline-none">
                                    <i class="fas fa-times"></i>
                                </button>
                                </span>
                            </div>
                            {{-- End Close Modal --}}

                            <div class="container bg-gray-900 mx-auto pt-20 pb-3 px-10">
                                <div class="w-full mx-auto relative">
                                    <input name="items" id="search" type="text" placeholder="Search Videos.." class="w-full h-full text-lg font-bold px-5 py-2 text-gray-800 rounded" />
                                    <span class="iconify absolute right-1 top-1 bottom-1 hover:text-gray-400 cursor-pointer" data-icon="ant-design:search-outlined" data-inline="false" data-width="30" data-height="30"></span>
                                </div>
                                <div class="my-2 text-white">Type to search for movies and tv shows.</div>
                            </div>

                            <div class="container bg-gray-800 mx-auto px-10" id="searchother">
                                <div class="w-full">
                                    <h2 class="text-white text-xl font-bold uppercase my-5">Years</h2>
                                    <div class="flex flex-wrap">
                                        @if(count($years) > 0)
                                            @foreach($years as $year)
                                                @if(count($year->items) > 0)
                                                    <div class="flex text-white mr-2 uppercase mb-3">
                                                        <a class="px-2 bg-blue-500 py-1 rounded-l hover:bg-white hover:text-blue-500 duration-150" href="{{ url('/year/') }}/@php echo strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $year->name)));  @endphp">{{ $year->name }}  </a><span class="rounded-r px-2 py-1 bg-gray-900 font-bold " >@php echo count($year->items); @endphp</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div style="font-size: 14px">We couldn't find any items with years.</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-full">
                                    <h2 class="text-white text-xl font-bold uppercase my-5">Genres</h2>
                                    <div class="flex flex-wrap">
                                        @if(count($genres) > 0)
                                            @foreach($genres as $genre)
                                                @if(count($genre->items) > 0)
                                                    <div class="flex text-white mr-2 uppercase mb-3">
                                                        <a class="px-2 bg-blue-500 py-1 rounded-l hover:bg-white hover:text-blue-500 duration-150" href="{{ url('/genre/') }}/@php echo strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $genre->name)));  @endphp">{{ $genre->name }}  </a><span class="rounded-r px-2 py-1 bg-gray-900 font-bold " >@php echo count($genre->items); @endphp</span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div style="font-size: 14px">We couldn't find any genres.</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="container bg-gray-800 mx-auto p-5" id="search-list" style="min-height: calc(100vh - 175px);">

                            </div>

                            <script type="text/javascript">
                                $('#search').on('keyup',function(){

                                    var input = $(this);

                                    $('#searchother').addClass('hidden');

                                    if( input.val() == "" ) {
                                        $('#searchother').removeClass('hidden');
                                    }

                                    $value=$(this).val();
                                    $.ajax({
                                        type : 'get',
                                        url : '{{URL::to('search')}}',
                                        data:{'items':$value},
                                        success:function(data){
                                            $('#search-list').html(data);
                                        }
                                    });
                                })
                            </script>
                            <script type="text/javascript">
                                $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                            </script>

                        </div>
                    </div>
                </div>
                <!-- search modal end -->
                {{-- Login And Register / Dropdown  --}}
                @guest
                    <a class="no-underline hover:text-blue-400 font-semibold uppercase" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="no-underline hover:text-blue-400 font-semibold uppercase" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <div class="cursor-pointer">
                        <a class="flex items-center justify-center uppercase hover:text-white duration-200 text-base font-bold" href="/watchlists">
                            <span class="iconify mr-0 lg:mr-2" data-icon="vaadin:stopwatch" data-inline="false" data-width="25" data-height="25"></span> <span class="lg:inline-block hidden">watchlists</span>
                        </a>
                    </div>
                    <div x-cloak x-data="{ open: false }" class="ml-3">
                        <button @click="open = true" class="rounded-full flex items-center justify-center cursor-pointer bg-blue-600 hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-600 focus:ring-opacity-50 h-9 w-9">
                            <img class="rounded-full focus:outline-none" src="/profile_img/{{ Auth::user()->profile_img }}" alt="{{ Auth::user()->name }}"/>
                        </button>

                        <ul x-show="open"
                        @click.away="open = false"
                        class="absolute bg-white font-normal bg-white shadow overflow-hidden rounded w-48 mt-2 py-1 right-5 z-100"
                        x-transition:enter="transition transform origin-top-right ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-75"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition transform origin-top-right ease-out duration-200"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-75">
                            <li class="px-5 py-2">
                                <span class="no-underline text-gray-900 font-semibold uppercase">{{ Auth::user()->name }}</span>
                            </li>
                            @if(Auth::user()->role == 'administrators' || Auth::user()->role == 'moderators' || Auth::user()->role == 'authors')
                                <div class="py-2 px-4 bg-blue-500">
                                    <span class="no-underline font-semibold uppercase">
                                        <a class="text-white hover:text-gray-200" href="{{ url('/admin') }}" >Control Panel</a>
                                    </span>
                                </div>
                            @endif
                            @foreach($front_pages as $page)
                                @php  $sho = explode(",",$page->show_in);  @endphp
                                @foreach ($sho as $shw)
                                    @if($shw == 1)
                                        <li class="px-5 py-2">
                                            <span class="no-underline text-gray-900 uppercase">
                                                <a href="{{ url('/page').'/'.$page->slug }}">{{$page->title}}</a>
                                            </span>
                                        </li>
                                    @endif
                                @endforeach
                            @endforeach

                            <li class="px-5 py-2 border-t-2">
                                <a href="{{ route('logout') }}"
                                    class="no-underline text-gray-900 hover:text-gray-800 font-semibold uppercase"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
                {{-- End Login And Register / Dropdown  --}}
            </nav>
            {{-- End Right Menu --}}
        </div>
    </header>
    <div class="container mx-auto bg-black hidden md:flex">
        <div class="flex w-full text-white">
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/0-9')}}">#</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/a')}}">A</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/b')}}">B</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/c')}}">C</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/d')}}">D</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/e')}}">E</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/f')}}">F</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/g')}}">G</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/h')}}">H</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/i')}}">I</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/j')}}">J</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/k')}}">K</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/l')}}">L</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/m')}}">M</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/n')}}">N</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/o')}}">O</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/p')}}">P</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/q')}}">Q</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/r')}}">R</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/s')}}">S</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/t')}}">T</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/u')}}">U</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/v')}}">V</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/w')}}">W</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/x')}}">X</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/y')}}">Y</a>
            <a class="py-3 w-full text-center hover:text-white hover:bg-gray-700 transition duration-200 ease-out" href="{{url('/start-with/z')}}">Z</a>
        </div>
    </div>
    @yield('content')
    <footer class="container mx-auto bg-black">
        <div class="p-10 w-full">
            <div class="w-full lg:w-1/5 align-top inline-block mb-5">
                <a href="/">
                    <div>
                        <img class="h-10" src="{{ asset('public/setting_img') }}/{{ $general->site_logo }}" alt="MX Player Logo">
                    </div>
                </a>
                <div class="py-2 text-gray-300 text-sm leading-4 tracking-wide">{{ $general->site_description }} <p class="my-2"><b>{{ $general->site_copyright }}</b></p></div>
            </div>
            <div class="w-full lg:w-1/5 align-top inline-block mb-5 lg:pl-5">
                <div class="text-lg text-white uppercase mb-2 tracking-widest">Explore</div>
                <div class="text-sm text-gray-300">
                    <ul class="flex flex-wrap uppercase">
                        <li class="pr-4 pb-2 hover:text-white"><a href="/">Home</a></li>
                        <li class="pr-4 pb-2 hover:text-white"><a href="/series">Series</a></li>
                        <li class="pr-4 pb-2 hover:text-white"><a href="/movies">Movies</a></li>
                        <li class="pr-4 pb-2 hover:text-white"><a href="/trending">Trending</a></li>
                        <li class="pr-4 pb-2 hover:text-white"><a href="/watchlists">Watchlists</a></li>
                    </ul>
                </div>
            </div>
            <div class="w-full lg:w-1/4 align-top inline-block mb-5 lg:pl-5">
                <div class="text-lg text-white uppercase mb-2 tracking-widest">Newsletter</div>
                <div class="text-sm text-gray-300">
                    <div class="mb-5">Sign up to our emails for regular updates.</div>
                    <div class="pr-10 flex-wrap">
                        <form method="post" action="{{url('newsletter/store')}}" class="ui form">
                            @csrf
                            <input type="email" class="p-2 rounded text-gray-900 mb-2 mr-3 " id="inputName" placeholder="Enter Email.." name="email">
                            <button type="submit" class="bg-white rounded px-5 py-2 text-black uppercase">Subscribe</button>
                        </form>
                        @if ($message = Session::get('subscribed'))
                            <script>
                                swal({
                                    title: "Subscribed Successfully",
                                    text: "{{ $message }}",
                                    icon: "success",
                                    button: "OK!",
                                });
                            </script>
                        @endif
                        @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <script>
                                        swal({
                                            title: "Error Subscribing",
                                            text: "{{ $error }}",
                                            icon: "error",
                                            button: "OK!",
                                        });
                                    </script>
                                @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/6 align-top inline-block mb-5 lg:pl-5">
                <div class="text-lg text-white uppercase mb-2 tracking-widest">Pages</div>
                <div class="text-sm text-gray-300">
                    <ul class="uppercase">
                        <li class="pr-4 pb-2 hover:text-white"><a href="/">Home</a></li>
                        @foreach($front_pages as $page)
                            @php  $sho = explode(",",$page->show_in);  @endphp
                            @foreach ($sho as $shw)
                                @if($shw == 0)
                                    <li class="pr-4 pb-2 hover:text-white"><a href="{{ url('/page').'/'.$page->slug }}">{{$page->title}}</a></li>
                                @endif
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="w-full lg:w-1/6 align-top inline-block lg:pl-5">
                <div class="text-lg text-white uppercase mb-2 tracking-widest">Social Links</div>
                <div class="text-sm text-gray-300">
                    <ul class="flex flex-wrap uppercase">
                        @if(isset($general->site_twitter))
                        <li class="pr-4 pb-2 hover:text-white"><a target="_blank" href="{{ $general->site_twitter }}"><i class="fab fa-twitter"></i> twitter</a></li>
                        @endif
                        @if(isset($general->site_pinterest))
                        <li class="pr-4 pb-2 hover:text-white"><a target="_blank" href="{{ $general->site_pinterest }}"><i class="fab fa-pinterest"></i> pinterest</a></li>
                        @endif
                        @if(isset($general->site_youtube))
                        <li class="pr-4 pb-2 hover:text-white"><a target="_blank" href="{{ $general->site_youtube }}"><i class="fab fa-youtube"></i> youtube</a></li>
                        @endif
                        @if(isset($general->site_facebook))
                        <li class="pr-4 pb-2 hover:text-white"><a target="_blank" href="{{ $general->site_facebook }}"><i class="fab fa-facebook"></i> facebook</a></li>
                        @endif
                        @if(isset($general->site_linkedin))
                        <li class="pr-4 pb-2 hover:text-white"><a target="_blank" href="{{ $general->site_linkedin }}"><i class="fab fa-linkedin"></i> linkedin</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </footer>
@yield('js')
{{-- Watchlists --}}
<script>
    $('.card-actions .watchlist-button-card').on('click', function(event) {
        event.preventDefault();
        var $current = $(this);
        var $currentIcon = $(this).children('i');
        var id      = parseInt($(this).attr('id'));

        var _token = $('input[name="_token"]').val();
        var data        = {'id': id, 'watchlist': 1, '_token' : _token};
        var ajaxReqUrl  = '/watchlist';
        $.ajax({
            method: 'POST',
            url: ajaxReqUrl,
            data: data
        })
        .done(function(result) {
            if(result.watchlist == true){
                $currentIcon.attr('class', 'fas fa-plus-circle');
                $current.attr('data-text', 'ADD TO WATCHLIST');
            }else if(result.watchlist == false){
                $currentIcon.attr('class', 'fas fa-minus-circle');
                $current.attr('data-text', 'REMOVE FROM WATCHLIST');
            }else{
                console.log('Error adding to watchlists');
            }
        });
    });
</script>
<script src="//cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
@if($ads->activate == 1)
	@if(isset($ads->site_popunder))
	<!-- Ads : Popup -->
	{!! $ads->site_popunder !!}
	@endif
	@if(isset($ads->site_sticky_banner))
	<!-- Ads : Sticky Banner -->
	{!! $ads->site_sticky_banner !!}
	@endif
	@if(isset($ads->site_push_notifications))
	<!-- Ads : Push notifications -->
	{!! $ads->site_push_notifications !!}
	@endif
	@if(isset($ads->site_desktop_fullpage_interstitial))
	<!-- Ads : Desktop Fullpage Interstitial -->
	{!! $ads->site_desktop_fullpage_interstitial !!}
	@endif
@endif
</body>
</html>
