@extends('layouts.app')
{{-- CSS --}}
@section('css')
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
<style>
    /*--------------------Player--------------------*/
    body ::-webkit-scrollbar{-webkit-appearance:none;width:10px;height:10px}
    body ::-webkit-scrollbar-track{background:rgba(0,0,0,.1);border-radius:0}
    body ::-webkit-scrollbar-thumb{cursor:pointer;border-radius:5px;background:rgba(0,0,0,.25);-webkit-transition:color .2s ease;transition:color .2s ease}
    body ::-webkit-scrollbar-thumb:window-inactive{background:rgba(0,0,0,.15)}
    body ::-webkit-scrollbar-thumb:hover{background:rgba(54, 67, 255, 0.473)}
    body .ui.inverted::-webkit-scrollbar-track{background:rgba(255,255,255,.1)}
    body .ui.inverted::-webkit-scrollbar-thumb{background:rgba(255,255,255,.25)}
    body .ui.inverted::-webkit-scrollbar-thumb:window-inactive{background:rgba(255,255,255,.15)}
    body .ui.inverted::-webkit-scrollbar-thumb:hover{background:rgba(54, 67, 255, 0.473)}
    #player-wrapper {
        position: relative;
    }
    #player-wrapper:after, #player-wrapper:before {
        bottom: 15px;
        left: 10px;
        width: 50%;
        height: 10%;
        max-width: 300px;
        max-height: 100px;
        -webkit-box-shadow: 0 15px 10px rgba(0, 0, 0, 0.5);
        -moz-box-shadow: 0 15px 10px rgba(0, 0, 0, 0.5);
        box-shadow: 0 15px 10px rgba(0, 0, 0, 0.5);
        -webkit-transform: skew(-15deg) rotate(-6deg);
        -moz-transform: skew(-15deg) rotate(-6deg);
        -ms-transform: skew(-15deg) rotate(-6deg);
        -o-transform: skew(-15deg) rotate(-6deg);
        transform: skew(-15deg) rotate(-6deg);
        content: "";
        position: absolute;
        z-index: -1;
    }
    #player-wrapper:after {
        right: 10px;
        left: auto;
        -webkit-transform: skew(15deg) rotate(6deg);
        -moz-transform: skew(15deg) rotate(6deg);
        -ms-transform: skew(15deg) rotate(6deg);
        -o-transform: skew(15deg) rotate(6deg);
        transform: skew(15deg) rotate(6deg);
    }
    #movie-players .image {
        float: right;
        position: relative;
        margin: 0;
        width: 20px;
    }
    #movie-players.bottom.attached.menu {
        overflow-y: hidden;
        overflow-x: auto;
        padding: 0.5rem 0.25rem;
        background: #1f2022;
        border-bottom: 0;
    }
    #movie-players.bottom.attached.menu a {
        margin-right: 5px;
        background: #000000;
        color: #fff;
        flex: none;
    }
    #movie-players.bottom.attached.menu a.trailer {
        background: #880005;
        margin-left: auto;
        margin-right: 0.25rem;
    }
    #movie-players.bottom.attached.menu a:hover {
        -webkit-filter: brightness(1.2) !important;
        -moz-filter: brightness(1.2) !important;
        -o-filter: brightness(1.2) !important;
        -ms-filter: brightness(1.2) !important;
        filter: brightness(1.2) !important;
    }
    #player-wrapper .segment{
        background: #fff;
        cursor: pointer;
        box-shadow: none !important;
        bottom: 0;
        top: 0;
        border-radius: .28571429rem .28571429rem 0 0;
        margin: 0;
        width: calc(100%);
        max-width: calc(100%);
        position: relative;
        padding: 0rem !important;
        border: none !important;
    }
    .nav-btn{
        cursor: pointer;
    }
    .nav-btn.active{
        background: brown!important;
    }
    .item.trailer{
        cursor: pointer;
    }
    .plyr__poster{
        background-size: cover!important;
    }

    .ui.embed{position:relative;max-width:100%;height:0;overflow:hidden;background:#dcddde;padding-bottom:56.25%}.ui.embed embed,.ui.embed iframe,.ui.embed object{position:absolute;border:none;width:100%;height:100%;top:0;left:0;margin:0;padding:0}.ui.embed>.embed{display:none}.ui.embed>.placeholder{position:absolute;cursor:pointer;top:0;left:0;display:block;width:100%;height:100%;background-color:radial-gradient(transparent 45%,rgba(0,0,0,.3))}.ui.embed>.icon{cursor:pointer;position:absolute;top:0;left:0;width:100%;height:100%;z-index:2}.ui.embed>.icon:after{position:absolute;top:0;left:0;width:100%;height:100%;z-index:3;content:'';background:-webkit-radial-gradient(transparent 45%,rgba(0,0,0,.3));background:radial-gradient(transparent 45%,rgba(0,0,0,.3));opacity:.5;-webkit-transition:opacity .5s ease;transition:opacity .5s ease}.ui.embed>.icon:before{position:absolute;top:50%;left:50%;z-index:4;-webkit-transform:translateX(-50%) translateY(-50%);transform:translateX(-50%) translateY(-50%);color:#fff;font-size:6rem;text-shadow:0 2px 10px rgba(34,36,38,.2);-webkit-transition:opacity .5s ease,color .5s ease;transition:opacity .5s ease,color .5s ease;z-index:10}.ui.embed .icon:hover:after{background:-webkit-radial-gradient(transparent 45%,rgba(0,0,0,.3));background:radial-gradient(transparent 45%,rgba(0,0,0,.3));opacity:1}.ui.embed .icon:hover:before{color:#fff}.ui.active.embed>.icon,.ui.active.embed>.placeholder{display:none}.ui.active.embed>.embed{display:block}.ui.square.embed{padding-bottom:100%}.ui[class*="4:3"].embed{padding-bottom:75%}.ui[class*="16:9"].embed{padding-bottom:56.25%}.ui[class*="21:9"].embed{padding-bottom:42.85714286%}
    .ui.embed>.icon:before {
        font-size: 4rem;
    }

    #movie-players.bottom.attached.menu{
        overflow-y: hidden;
        overflow-x: auto;
        padding: 0.5rem 0.25rem;
        background: #1f2022;
        border: none;
        box-shadow: none;
        bottom: 0;
        top: 0;
        margin: 0 -1px;
        width: calc(100% + 2px);
        max-width: calc(100% + 2px);
        display: flex;
        font-size: 15px;
    }

    .item-poster img{
        width:100%;
        border-radius: 5px;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<style>
    #movie-players .active{
        background: #880005 !important;
    }
</style>
@endsection
{{-- CSS End --}}

@section('content')

{{-- Container Start --}}
<div class="container mx-auto bg-gray-800 items-center justify-center">
    {{-- Player --}}
    <div class="bg-black items-center justify-center">
        {{-- Player Start --}}
        <div id="player-wrapper">
            {{-- Trailer Youtube--}}
            <div class="ui top attached segment borderless p-0" id="player-trailer"  style="display: block;">
                <link rel="stylesheet" href="https://cdn.plyr.io/3.6.4/plyr.css" />
                <div id="playerYoutube" data-plyr-provider="youtube" data-plyr-embed-id="{{ $series->trailer }}"></div>
                <script src="https://cdn.plyr.io/3.5.6/plyr.js"></script>
                <script>
                    var playerYoutube = new Plyr('#playerYoutube');
                    playerYoutube.poster = '{!! $series->backdrop !!}';
                </script>
            </div>
            <div class="flex overflow-x-scroll" id="movie-players">
                @if(count($uniqueSeason))
                    @foreach($uniqueSeason as $seasons)
                        <a href="javascript:void(0)" data-series="{{ $series->id }}" data-season="{{ $seasons->season_id }}" class="item text-white uppercase px-4 py-2 rounded bg-blue-500 mx-2 mt-3">Season {{ $seasons->season_id }}</a>
                    @endforeach
                @else
                    <div class="m-2 px-4 py-2 text-white">There is no season set for this series!</div>
                @endif
            </div>
        </div>
        {{-- Player End --}}
    </div>
    {{-- Player End --}}

    {{-- Seasons Episodes --}}
    <div id="season-episodes" class="my-3 relative w-full"></div>
    {{-- Seasons Episodes End --}}

    {{-- Series Details --}}
    <div class="container mx-auto p-10 inline-block">
        <div class="w-full flex justify-between mb-5 ">
            <div>
                <ol class="py-2 text-base flex h-auto leading-7">
                    <li class="flex text-gray-400"><a class="" href="/">Home</a><span class="iconify" data-icon="ic:outline-navigate-next" data-inline="false" style="color: white;" data-width="30" data-height="30"></span></li>
                    <li class="flex text-gray-400"><a class="" href="/series">Series</a><span class="iconify" data-icon="ic:outline-navigate-next" data-inline="false" style="color: white;" data-width="30" data-height="30"></span></li>
                    <li class="flex text-white"><a class="" href="/series/{{ $series->slug }}">{{ $series->name }} ({{ date('Y',strtotime($series->release_date)) }})</a></li>
                </ol>
            </div>
            <div class="py-2 text-sm md:text-base flex h-auto leading-7 text-white">
                @if(Auth::user())
                    @if(isset(Auth::user()->watchlists()->where('items_id', $series->id)->first()->watchlist))
                        <div class="flex leading-7 cursor-pointer text-gray-400 hover:text-white duration-200" id="watchlists" data-id="{{ $series->id }}">
                            <span class="iconify" data-icon="bi:bookmark-x" data-inline="false" data-width="30" data-height="30"></span><span class="md:inline hidden pl-2">REMOVE FROM WATCHLIST</span>
                        </div>
                    @else
                        <div class="flex leading-7 cursor-pointer text-gray-400 hover:text-white duration-200" id="watchlists" data-id="{{ $series->id }}">
                            <span class="iconify" data-icon="bi:bookmark-plus" data-inline="false" data-width="30" data-height="30"></span><span class="md:inline hidden pl-2">ADD TO WATCHLIST</span>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="w-full flex mb-5 text-white ">
            <div class="w-full lg:w-1/4 lg:inline-flex hidden">
                <div class="block w-full pr-10 relative">
                    <img src="{{ $series->poster }}" class="rounded">
                    <div class="absolute left-2 right-12 top-2 px-2 text-white z-50 rounded uppercase flex text-center justify-between leading-6 h-6 text-xs">
                        <div class="flex leading-6 h-6 text-xs">
                            <span class="iconify mr-1" data-icon="la:imdb" data-inline="false" data-width="25" data-height="25"></span> {{ $series->rating }}
                        </div>
                        <div class="flex leading-5 h-5 text-xs">
                            <span class="iconify mr-1" data-icon="ion:time-outline" data-inline="false" data-width="20" data-height="20"></span> {{ $series->duration }}min
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-3/4 w-full flex">
                <div class="align-center">
                    <h2 class="text-4xl mb-3">{{ $series->name }} ({{ date('Y',strtotime($series->release_date)) }})</h2>
                    <div class="flex divide-x-2 divide-gray-300 mb-5 uppercase text-sm">
                        <div class="pr-2">{{ date('d M, Y',strtotime($series->release_date)) }}</div>
                        @if(count($series->genres) > 0)
                            <div class="px-2">
                                @php
                                    $num_of_items = count($series->genres);
                                    $num_count = 0;
                                @endphp
                                @foreach ($series->genres as $singleGenre)
                                    <a href="{{ url('/genre/') }}/@php echo strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $singleGenre->name)));  @endphp" >{{ $singleGenre->name }}</a>
                                    @php
                                        $num_count = $num_count + 1;
                                        if ($num_count < $num_of_items) {
                                            echo ", ";
                                        }
                                    @endphp
                                @endforeach
                            </div>
                        @endif
                        @if(count($series->qualities) > 0)
                            <div class="px-2">
                                @php
                                    $num_of_items = count($series->qualities);
                                    $num_count = 0;
                                @endphp
                                @foreach ($series->qualities as $singleQuality)
                                    <a href="{{ url('/quality/') }}/@php echo strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $singleQuality->name)));  @endphp" >{{ $singleQuality->name }}</a>
                                    @php
                                        $num_count = $num_count + 1;
                                        if ($num_count < $num_of_items) {
                                            echo ", ";
                                        }
                                @endphp
                                @endforeach
                            </div>
                        @endif
                        <div class="pl-2">
                            {{ $series->duration }} MIN
                        </div>
                    </div>
                    <h3 class="text-base mb-3 text-gray-300">{{ $series->tagline }}</h3>
                    <div>
                        <h4 class="text-xl mb-2">Overview</h4>
                        <p class="leading-6 text-gray-300 text-sm mb-5">{{ $series->description }}</p>
                        <h4 class="text-xl mb-2">Cast</h4>
                        <p class="leading-6 text-sm mb-5">
                            @if(count($series->actors) > 0)
                                @php
                                    $num_of_items = count($series->actors);
                                    $num_count = 0;
                                @endphp
                                @foreach ($series->actors as $singleActors)
                                    <span><a class="text-gray-300 hover:text-white" href="{{ url('/actor/') }}/@php echo strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $singleActors->name)));  @endphp" >{{ $singleActors->name }}</a><span>
                                    @php
                                        $num_count = $num_count + 1;
                                        if ($num_count < $num_of_items) {
                                            echo ", ";
                                        }
                                    @endphp
                                @endforeach
                            @else
                                <span>Not Available</span>
                            @endif
                        </p>
                        <h4 class="text-xl mb-2">Director</h4>
                        <p class="leading-6 text-sm mb-5">
                            @if(count($series->directors) > 0)
                                @php
                                    $num_of_items = count($series->directors);
                                    $num_count = 0;
                                @endphp
                                @foreach ($series->directors as $singleDirector)
                                    <span><a class="text-gray-300 hover:text-white" href="{{ url('/director/') }}/@php echo strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $singleDirector->name)));  @endphp">{{ $singleDirector->name }}</a></span>
                                    @php
                                        $num_count = $num_count + 1;
                                        if ($num_count < $num_of_items) {
                                            echo ", ";
                                        }
                                    @endphp
                                @endforeach
                            @else
                                <span>Not Available</span>
                            @endif
                        </p>
                        <h4 class="text-xl mb-2">Creator</h4>
                        <p class="leading-6 text-sm mb-5">
                            @if(count($series->creators) > 0)
                                @php
                                    $num_of_items = count($series->creators);
                                    $num_count = 0;
                                @endphp
                                @foreach ($series->creators as $singleCreators)
                                    <span><a class="text-gray-300 hover:text-white" href="{{ url('/creator/') }}/@php echo strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $singleCreators->name)));  @endphp">{{ $singleCreators->name }}</a></span>
                                    @php
                                        $num_count = $num_count + 1;
                                        if ($num_count < $num_of_items) {
                                            echo ", ";
                                        }
                                    @endphp
                                @endforeach
                            @else
                                <span>Not Available</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Series Details --}}


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

    {{-- Related Series --}}
    <div class="container mx-auto p-10 inline-block text-white">
        <h2 class="text-3xl mb-5 uppercase">Related Series</h2>
        <div class="flex flex-wrap justify-center">
            @foreach($relatedseries as $relatedseries)
                <div class="relative mb-2 px-1">
                    <div class="slide">
                        <div class="card-wrapper">
                            <a href="{{ url('/series') }}/{{ $relatedseries->slug }}" title="{{ $relatedseries->name }}">
                                <div class="card inline-top loaded portrait-card" style="width:230px; height:380px">
                                    <div class="card-content-wrap ">
                                        @if(Auth::user())
                                            <div class="card-actions">
                                                <button class="watchlist-button-card" data-text="@if(isset(Auth::user()->watchlists()->where('items_id', $relatedseries->id)->first()->watchlist))REMOVE FROM WATCHLIST @else ADD TO WATCHLIST @endif" id="{{ $relatedseries->id }}">
                                                    @if(isset(Auth::user()->watchlists()->where('items_id', $relatedseries->id)->first()->watchlist))
                                                        <i class="fas fa-minus-circle"></i>
                                                    @else
                                                        <i class="fas fa-plus-circle"></i>
                                                    @endif
                                                </button>
                                                <div class="absolute left-0 right-0 bottom-16 px-2 text-white z-50 rounded uppercase flex text-center justify-between leading-6 h-6 text-xs">
                                                    <div class="flex leading-6 h-6 text-xs">
                                                        <span class="iconify mr-1" data-icon="la:imdb" data-inline="false" data-width="25" data-height="25"></span> {{ $relatedseries->rating }}
                                                    </div>
                                                    <div class="flex leading-5 h-5 text-xs">
                                                        <span class="iconify mr-1" data-icon="ion:time-outline" data-inline="false" data-width="20" data-height="20"></span> {{ $relatedseries->duration }}min
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="card-image-content">
                                            <div class="image-card base-card-image">
                                                <img alt="{{ $relatedseries->name }} ({{ date('Y',strtotime($relatedseries->release_date)) }})" title="{{ $relatedseries->name }} ({{ date('Y',strtotime($relatedseries->release_date)) }})" class="original-image" src="{{ $relatedseries->poster }}">
                                            </div>
                                            <div>
                                                <div class="card-overlay show-icon"></div>
                                            </div>
                                        </div>
                                        <div class="card-details" style="overflow: hidden;text-overflow: ellipsis;width: 200px;">
                                            <h3 class="text-overflow card-header">{{ $relatedseries->name }} ({{ date('Y',strtotime($relatedseries->release_date)) }})</h3>
                                            <div class="text-overflow card-subheader">
                                                @foreach ($relatedseries->genres as $singleGenre)
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
    </div>
    {{-- End Related Series --}}


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

    {{-- Comments --}}
    <div class="container bg-gray-700 mx-auto p-10 inline-block text-white" id="comment-form">
        <h2 class="text-3xl mb-5 uppercase">Write a Comment</h2>
        @if(Auth::user())
        <div class="relative w-full mb-10">

            {!! Form::open(array('url'=>'series-comments','method'=>'POST', 'id'=>'frmComments')) !!}
                {!! Form::hidden('itemname', $series->name, array('id' => 'itemname')) !!}
                {!! Form::hidden('itemid', $series->id, array('id' => 'itemid')) !!}
                {!! Form::textarea('body', null, array('class'=>'w-full p-5 text-white text-xl bg-gray-900 rounded mb-2', 'id'=>'bodyComment', 'rows'=>'5', 'placeholder' => 'Add Comments...')) !!}
                {!! Form::submit('Submit', array('name'=>'submit', 'class'=>'py-2 px-4 uppercase bg-blue-500 rounded text-white float-right cursor-pointer', 'id' => 'btnComments')) !!}
			{!! Form::close() !!}
        </div>
        @else
            <div class="mb-5 text-base">
                <div class="mt-3 mb-3 text-white bg-gray-900 p-5 uppercase" >
                    Create <a href="{{ route('register') }}" class="text-blue-500 font-bold uppercase tracking-widest	">New Account</a> / <a class="text-blue-500 font-bold uppercase tracking-widest	" href="{{ route('login') }}">Sign In</a> to write a comment.
                </div>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="mt-3 mb-3 text-white bg-gray-900 p-5" >{{ $message }}</div>
        @endif
        <h3 class="text-2xl mb-5 uppercase"><i class="comment icon"></i> Comments</h3>
        <div class="relative w-full mb-10">
            @if(count($comments) > 0)
                @foreach($comments as $comment)
                    <div class="flex inline-block mb-8 w-full">
                        <div class="w-15 mr-5">
                            <span class="h-15 w-15 ">
                                <img class="rounded-full" src="{{ asset('/profile_img') }}/{{ $comment->user->profile_img }}" alt="avatar">
                            </span>
                        </div>
                        <div class="w-full bg-gray-900 rounded p-8">
                            <div class="flex leading-8">
                                <span class="mr-2 text-xl">{{$comment->user_name}}</span>
                                @if($comment->user->role == 'administrators')
                                <div class="mr-2">
                                    <span class="text-white bg-red-500 py-1 px-2 rounded date">Admin</span>
                                </div>
                                @elseif($comment->user->role == 'moderators')
                                <div class="mr-2">
                                    <span style="color: #ffffff;background: #0e0e0e;padding: 2px 10px;border-radius: 6px;" class="date">Moderators</span>
                                </div>
                                @elseif($comment->user->role == 'authors')
                                <div class="mr-2">
                                    <span style="color: #ffffff;background: #0e0e0e;padding: 2px 10px;border-radius: 6px;" class="date">Authors</span>
                                </div>
                                @endif

                                @if(isset($comment->season_id))
                                <div class="leading-7">
                                    <span class="text-white text-sm " class="date">comment for <a class="text-gray-400 hover:text-blue-500" href="{{ url($series->id) }}/{{$series->slug}}/season-{{ $comment->season_id }}/episode-{{$comment->episode_id}}">{{ $series->name}} Season {{$comment->season_id}} episode {{$comment->episode_id}}</a></span>
                                </div>
                                @endif
                            </div>
                            <div class="mb-5">
                                <span class="text-xs "> <i class="clock icon"></i>{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="mb-5 leading-6">{{ $comment->comment }}</div>
                            @if($comment->user->id == Auth()->id())
                            <div class="leading-9">
                                <a href="{{ url('/movie-delete-comment/'.$comment->id) }}" class="px-4 py-2 bg-blue-500 uppercase text-base rounded">delete</a>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
            <div class="mt-3 mb-3 text-white bg-gray-900 p-5" ><div>There is no Comments for this item!</div></div>
            @endif
        </div>
    </div>
    {{-- End Comments --}}

</div>
{{-- Container End --}}

{{-- JavaScript --}}
@section('js')
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
    <script>
        $(function()
        {
            $('#movie-players .item').on('click', function(){
                $('#movie-players .item').removeClass('active');
                var series_id    = $(this).data('series');
                var season_id    = $(this).data('season');
                var thisClass = $(this);

                console.log(series_id +' - '+ season_id);
                $.ajax({
                    type: "GET",
                    url: '/get-season-episodes/series-'+series_id+'/season-'+season_id,
                    success: function(data){
                        $(thisClass).toggleClass('active');
                        $data = $(data);
                        $('#season-episodes').hide().html($data).fadeIn()
                    }
                });
            });

			//Single Watchlists adding / removing
            $('#watchlists').on('click', function(event) {
                event.preventDefault();
                var id          = parseInt($(this).attr('data-id'));
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
                        document.getElementById("watchlists").innerHTML = '<span class="iconify" data-icon="bi:bookmark-plus" data-inline="false" data-width="30" data-height="30"></span><span class="md:inline hidden pl-2">ADD TO WATCHLIST</span>';
                    }else if(result.watchlist == false){
                        document.getElementById("watchlists").innerHTML = '<span class="iconify" data-icon="bi:bookmark-x" data-inline="false" data-width="30" data-height="30"></span><span class="md:inline hidden pl-2">REMOVE FROM WATCHLIST</span>';
                    }else{
                        console.log('Error Adding to watchlist!');
                    }
                });
            });
        })
    </script>
@endsection
{{-- JavaScript End--}}

@endsection
