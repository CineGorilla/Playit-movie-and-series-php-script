@extends('layouts.app')

@section('content')

{{-- Container Start --}}
<div class="container mx-auto bg-gray-800 items-center justify-center">

    {{-- Heading --}}
    <div class="container mx-auto p-10 inline-block bg-gray-700 ">
        <h2 class="text-white uppercase text-4xl">Episodes</h2>
        <h4 class="text-white text-xl pt-1">Latest Episodes added!</h4>
    </div>
    {{-- End Heading --}}

    {{-- Latest Episodes Listing --}}
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
                @foreach($data as $episode)
                    <div class="relative mb-2 px-1">
                        <div class="slide">
                            <div class="card-wrapper">
                                <a href="{{ url($episode->series->id) }}/{{$episode->series->slug}}/season-{{ $episode->season_id }}/episode-{{ $episode->episode_id}}" title="{{$episode->series->name}} - s{{ $episode->season_id }}e{{ $episode->episode_id}} - {{ $episode->name }}">
                                    <div class="card inline-top loaded portrait-card" style="width:300px; height:250px">
                                        <div class="card-content-wrap ">
                                            @if(Auth::user())
                                                <div class="card-actions">
                                                    <div class="absolute left-0 right-0 bottom-20 px-2 text-white z-50 rounded uppercase flex text-center justify-between leading-6 h-6 text-xs">
                                                        <div class="flex leading-6 h-6 text-xs">
                                                            <span class="iconify mr-1" data-icon="la:imdb" data-inline="false" data-width="25" data-height="25"></span> {{ $episode->series->rating }}
                                                        </div>
                                                        <div class="flex leading-5 h-5 text-xs">
                                                            <span class="iconify mr-1" data-icon="ion:time-outline" data-inline="false" data-width="20" data-height="20"></span> {{ $episode->series->duration }}min
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="card-image-content">
                                                <div class="image-card base-card-image">
                                                    <img alt="{{$episode->series->name}} - s{{ $episode->season_id }}e{{ $episode->episode_id}} - {{ $episode->name }}" class="original-image" src="{{ $episode->backdrop }}">
                                                </div>
                                                <div>
                                                    <div class="card-overlay show-icon"></div>
                                                </div>
                                            </div>
                                            <div class="card-details" style="overflow: hidden;text-overflow: ellipsis;width: 270px;">
                                                <h3 class="text-overflow text-white font-bold text-base mb-1">{{$episode->series->name}} - (S{{ $episode->season_id }}E{{ $episode->episode_id}})</h3>
                                                <h5 class="text-overflow  text-white text-xs mb-1">{{ $episode->name }}</h5>
                                                <div class="text-overflow card-subheader">
                                                    @foreach ($episode->series->genres as $singleGenre)
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
                <div class="text-white text-2xl">We Counldn't find any episodes!</div>
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
    {{-- End Latest Episodes Listing --}}

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
