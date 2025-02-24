@extends('layouts.app')

@section('content')
<script src="{{ asset('public/backend/js/html5_entities.js') }}"></script>
<style>
    h1{
        font-size: 30px;
        line-height: 60px;
    }
    h2{
        font-size: 24px;
        line-height: 50px;
    }
    h3{
        font-size: 20px;
        line-height: 40px;
    }
    h4{
        font-size: 18px;
        line-height: 35px;
    }
    h5{
        font-size: 16px;
        line-height: 30px;
    }
    h6{
        font-size: 14px;
        line-height: 28px;
    }
</style>

{{-- Container Start --}}
<div class="container mx-auto bg-gray-800 items-center justify-center">

    {{-- Heading --}}
    <div class="container mx-auto p-10 inline-block bg-gray-700 ">
        <h2 class="text-white uppercase text-4xl">{{ $pages->title }}</h2>
        <h4 class="text-white text-base pt-5">{{ $pages->summary }}</h4>
    </div>
    {{-- End Heading --}}



    {{-- Page --}}
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
            <div class="text-white text-base" id="page_content" style="color:white !important;"></div>
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
    {{-- End Page--}}




</div>
{{-- Container End --}}

@endsection

@section('js')
<script>
	function b64DecodeUnicode(str) {
	    return decodeURIComponent(atob(str).split('').map(function(c) {
	        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
	    }).join(''));
	}

	$(document).ready(function(){
		var content = b64DecodeUnicode('{{ $pages->content }}');
		document.getElementById("page_content").innerHTML = Html5Entities.decode(content);
	});
</script>
@endsection
