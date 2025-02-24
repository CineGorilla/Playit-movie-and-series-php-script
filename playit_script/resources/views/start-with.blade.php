@extends('layouts.app')

@section('content')

{{-- Container Start --}}
<div class="container mx-auto bg-gray-800 items-center justify-center">

    {{-- Heading --}}
    <div class="container mx-auto p-10 inline-block bg-gray-700 ">
        <h2 class="text-white uppercase text-4xl">Start With "{{ strtoupper($id) }}"</h2>
        <h4 class="text-white text-xl pt-1">Latest Movies and Tv shows start with letter "{{ strtoupper($id) }}"</h4>
    </div>
    {{-- End Heading --}}

    {{-- Movies Listing --}}
    <div class="container mx-auto p-10 inline-block">

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

        <div class="flex flex-wrap justify-center">
            @if(count($data) > 0)
                @foreach($data as $items)
                    <div class="relative mb-2 px-1">
                        <div class="slide">
                            <div class="card-wrapper">
                                <a href="@if($items->type == 'movie'){{ url('/movie') }}@else{{ url('/series') }}@endif/{{ $items->slug }}" title="{{ $items->name }}">
                                    <div class="card inline-top loaded portrait-card" style="width:230px; height:380px">
                                        <div class="card-content-wrap ">
                                            <div class="absolute left-0 top-0 px-2 py-1 bg-blue-500 text-xs text-white z-50 ml-1 mt-1 rounded uppercase">@if($items->type == 'movie') Movie @else Series @endif</div>
                                            @if(Auth::user())
                                                <div class="card-actions">
                                                    <button class="watchlist-button-card mr-1 mt-1" data-text="@if(isset(Auth::user()->watchlists()->where('items_id', $items->id)->first()->watchlist))REMOVE FROM WATCHLIST @else ADD TO WATCHLIST @endif" id="{{ $items->id }}">
                                                        @if(isset(Auth::user()->watchlists()->where('items_id', $items->id)->first()->watchlist))
                                                            <i class="fas fa-minus-circle"></i>
                                                        @else
                                                            <i class="fas fa-plus-circle"></i>
                                                        @endif
                                                    </button>
                                                    <div class="absolute left-0 right-0 bottom-16 px-2 text-white z-50 rounded uppercase flex text-center justify-between leading-6 h-6 text-xs">
                                                        <div class="flex leading-6 h-6 text-xs">
                                                            <span class="iconify mr-1" data-icon="la:imdb" data-inline="false" data-width="25" data-height="25"></span> {{ $items->rating }}
                                                        </div>
                                                        <div class="flex leading-5 h-5 text-xs">
                                                            <span class="iconify mr-1" data-icon="ion:time-outline" data-inline="false" data-width="20" data-height="20"></span> {{ $items->duration }}min
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="card-image-content">
                                                <div class="image-card base-card-image">
                                                    <img alt="{{ $items->name }} ({{ date('Y',strtotime($items->release_date)) }})" title="{{ $items->name }} ({{ date('Y',strtotime($items->release_date)) }})" class="original-image" src="{{ $items->poster }}">
                                                </div>
                                                <div>
                                                    <div class="card-overlay show-icon"></div>
                                                </div>
                                            </div>
                                            <div class="card-details" style="overflow: hidden;text-overflow: ellipsis;width: 200px;">
                                                <h3 class="text-overflow card-header">{{ $items->name }} ({{ date('Y',strtotime($items->release_date)) }})</h3>
                                                <div class="text-overflow card-subheader">
                                                    @foreach ($items->genres as $singleGenre)
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
            @else
                <div class="text-white text-2xl">We counldn't find any items start with letter "{{ strtoupper($id) }}"</div>
            @endif
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

    </div>
    {{-- End Movies Listing --}}

    {{-- Pagenation --}}
    <div class="container mx-auto p-10 inline-block bg-gray-700 ">
        {{ $data->links('layouts.pagination')  }}
    </div>
    {{-- End Pagenation --}}

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
</div>
{{-- Container End --}}

@endsection
