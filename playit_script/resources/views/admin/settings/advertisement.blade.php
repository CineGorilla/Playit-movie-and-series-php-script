@extends('admin.layouts.master')
@section('content')

<!-- Series Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Advertisement</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Advertisement</span></li>
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
{!! Form::model($ads, ['route' => ['update_advertisement_settings'],'method'=>'put','enctype' => 'multipart/form-data', 'class' => 'form']) !!}

    <div class="columns" style="margin-top : 5px;">
        <div class="column">
            <div class="field">
                <label><h4>728x90 Ads Unit</h4></label>
                <div class="control">
                    <textarea name="site_728x90_banner" class="textarea is-primary is-fullwidth" placeholder=".." rows="2">{{ base64_decode($ads->site_728x90_banner) }}</textarea>
                </div>
            </div>
            <div class="field">
                <label><h4>468x60 Ads Unit</h4></label>
                <div class="control">
                    <textarea name="site_468x60_banner" class="textarea is-primary is-fullwidth" placeholder=".." rows="2">{{ base64_decode($ads->site_468x60_banner) }}</textarea>
                </div>
            </div>
            <div class="field">
                <label><h4>320x100 Ads Unit</h4></label>
                <div class="control">
                    <textarea name="site_320x100_banner" class="textarea is-primary is-fullwidth" placeholder=".." rows="2">{{ base64_decode($ads->site_320x100_banner) }}</textarea>
                </div>
            </div>
            <div class="field ">
                <label><h4>VAST URL</h4></label>
                <div class="control">
                    <textarea name="site_300x250_banner" class="textarea is-primary is-fullwidth" placeholder=".." rows="2">{{ base64_decode($ads->site_300x250_banner) }}</textarea>
                </div>
                <p>Please Note that vast ads are only supported in direct and stream player only!</p>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label><h4>Popunder</h4></label>
                <div class="control">
                    <textarea name="site_popunder" class="textarea is-primary is-fullwidth" placeholder=".." rows="2">{{ base64_decode($ads->site_popunder) }}</textarea>
                </div>
            </div>
            <div class="field">
                <label><h4>Sticky Banner</h4></label>
                <div class="control">
                    <textarea name="site_sticky_banner" class="textarea is-primary is-fullwidth" placeholder=".." rows="2">{{ base64_decode($ads->site_sticky_banner) }}</textarea>
                </div>
            </div>
            <div class="field">
                <label><h4>Push Notifications</h4></label>
                <div class="control">
                    <textarea name="site_push_notifications" class="textarea is-primary is-fullwidth" placeholder=".." rows="2">{{ base64_decode($ads->site_push_notifications) }}</textarea>
                </div>
            </div>
            <div class="field">
                <label><h4>Desktop Fullpage Interstitial</h4></label>
                <div class="control">
                    <textarea name="site_desktop_fullpage_interstitial" class="textarea is-primary is-fullwidth" placeholder=".." rows="2">{{ base64_decode($ads->site_desktop_fullpage_interstitial) }}</textarea>
                </div>
            </div>
             <div class="field box">
                <label class="checkbox" style="margin-bottom:0">
                    <input type="checkbox" name="activate" @if($ads->activate == 1) Checked @endif> Activate Advertisement
                </label>
                <p>If it's checked, then only all advertisement will be shown on the site!</p>
            </div>
        </div>
    </div>
    <div class="field is-grouped is-pulled-right">
        <div class="control">
            <button type="submit" class="button is-primary is-normal">Save</button>
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
