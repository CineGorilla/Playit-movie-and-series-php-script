@extends('admin.layouts.master')
@section('content')

<!-- Series Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Settings</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Search Engines Settings</span></li>
                </ul>
            </div>
        </div>
        <!-- Account -->
        @include('admin.layouts.account')
    </div>
</div>

<!-- Main Content -->
<div class="main-content-inner">
    {{-- Alert Message --}}
    @if ($message = Session::get('success'))
    <div class="alert-dismiss" style="margin-top: 10px;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
        </div>
    </div>
    @endif

    {{-- Error Message --}}
    @if ($errors->any())
    <div class="alert-dismiss" style="margin-top: 10px;">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <li><strong>{{ $error }}</strong></li>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span class="fa fa-times"></span>
            </button>
        </div>
    </div>
    @endif

{!! Form::model($seosettings, ['route' => ['update_search_engines_settings'],'method'=>'put','enctype' => 'multipart/form-data', 'class' => 'form series']) !!}
    
    <div class="columns" style="margin-top : 5px;">
        <div class="column">
            <div class="field">
                <label><h4>Google - site verification</h4></label>
                <div class="control">
                    <input name="site_google_verification_code" class="input is-primary is-fullwidth" type="text" placeholder="meta tag content.." value="{{ $seosettings->site_google_verification_code }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Bing - site verification</h4></label>
                <div class="control">
                    <input name="site_bing_verification_code" class="input is-primary is-fullwidth" type="text" placeholder="meta tag content.." value="{{ $seosettings->site_bing_verification_code }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Yandex - site verification</h4></label>
                <div class="control">
                    <input name="site_yandex_verification_code" class="input is-primary is-fullwidth" type="text" placeholder="meta tag content.." value="{{ $seosettings->site_yandex_verification_code }}">
                </div>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label><h4>Google analytics</h4></label>
                <div class="control">
                    <textarea name="site_google_analytics" class="textarea is-primary is-fullwidth" placeholder="google analytics code..">{{ $seosettings->site_google_analytics }}</textarea>
                </div>
            </div>
            <div class="field">
                <label><h4>Robots</h4></label>
                <div class="control">
                    <input name="site_robots" class="input is-primary is-fullwidth" type="text" placeholder=".." value="{{ $seosettings->site_robots }}">
                </div>
            </div>
        </div>
    </div>
    <div class="field is-grouped is-pulled-right">
        <div class="control">
            <button type="submit" class="button is-primary is-normal">Save Setting</button>
        </div>
        <div class="control">
            <a href="/admin" class="button is-danger is-normal" style="color:white;">Cancel</a>
        </div>
    </div>

{!! Form::close() !!}

</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        
    });
</script>
@endsection