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
                    <li><span>General Settings</span></li>
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

{!! Form::model($general, ['route' => ['update_general_settings'],'method'=>'put','enctype' => 'multipart/form-data', 'class' => 'form series']) !!}

    <div class="columns" style="margin-top : 5px;">
        <div class="column">
            <div class="field">
                <label><h4>Site Name</h4></label>
                <div class="control">
                    <input name="site_name" class="input is-primary is-fullwidth" type="text" placeholder="Site Name.." value="{{ $general->site_name }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Site Title</h4></label>
                <div class="control">
                    <input name="site_title" class="input is-primary is-fullwidth" type="text" placeholder="Site Title.." value="{{ $general->site_title }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Site Description</h4></label>
                <div class="control">
                    <textarea name="site_description" class="textarea is-primary is-fullwidth" placeholder="Site Description..">{{ $general->site_description }}</textarea>
                </div>
            </div>
            <div class="field">
                <label><h4>Site Keywords</h4></label>
                <div class="control">
                    <input name="site_keywords" class="input is-primary is-fullwidth" type="text" placeholder="Site Keywords.." value="{{ $general->site_keywords }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Copyright Text</h4></label>
                <div class="control">
                    <input name="site_copyright" class="input is-primary is-fullwidth" type="text" placeholder="Copyright Text.." value="{{ $general->site_copyright }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Site Author</h4></label>
                <div class="control">
                    <input name="site_author" class="input is-primary is-fullwidth" type="text" placeholder="Site Author Name.." value="{{ $general->site_author }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Site Email</h4></label>
                <div class="control">
                    <input name="site_email" class="input is-primary is-fullwidth" type="text" placeholder="Site Email.." value="{{ $general->site_email }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Logo</h4></label>
                <div class="control">
                    {{ Form::file('site_logo',['class'=>' is-primary is-fullwidth']) }}
                </div>
            </div>
            <div class="field">
                <label><h4>Favicon</h4></label>
                <div class="control">
                    {{ Form::file('site_favicon',['class'=>' is-primary is-fullwidth']) }}
                </div>
            </div>
        </div>
        <div class="column">
            <div class="field">
                <label><h4>Movies / Series / Items Per Page</h4></label>
                <div class="control">
                    <input name="site_items_per_page" class="input is-primary is-fullwidth" type="number" placeholder="Items Per Page.." value="{{ $general->site_items_per_page }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Default Player</h4></label>
                <div class="control">
                    <div class="select is-primary is-fullwidth">
                        <select name="site_player">
                            <option @if($general->site_player == 'embeded') selected @endif value="embeded">Embeded</option>
                            <option @if($general->site_player == 'direct') selected @endif value="direct">Direct Link</option>
                            <option @if($general->site_player == 'stream') selected @endif value="stream">Stream</option>
                            <option @if($general->site_player == 'trailer') selected @endif value="trailer">Trailer</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                {{-- <label><h4>Website Style</h4></label>
                <div class="control" id="site_styleID">
                    <select id="site_style" name="site_style" type="text" value="" placeholder="Select Style" ></select>
                    <input type="hidden" name="site_style_id" value="{{ $general->site_style }}">
                </div> --}}
                <input type="hidden" name="site_style" value="dark">
            </div>
            <div class="field box">
                <label class="checkbox" style="margin-bottom:0">
                    <input type="checkbox" name="site_comments_moderation" @if($general->site_comments_moderation == 1) Checked @endif> Comments Moderation
                </label>
            </div>
            <div class="field box">
                <label class="checkbox" style="margin-bottom:20px">
                    <input type="checkbox" name="maintenance" @if($general->maintenance == 1) Checked @endif> Maintenance Mode(Check this if your site in maintenance!)
                </label>
                <div class="control">
                    <textarea name="site_maintenance_description" class="textarea is-primary is-fullwidth" placeholder="Maintenance Description..">{{ $general->site_maintenance_description }}</textarea>
                    <p><b>Note :</b> Admin member can view the website while in maintenance mode. Whereas, other users & visitors would get a maintenance page with above textbox message.</p>
                </div>
            </div>
            <div class="field">
                <label><h4>Twitter</h4></label>
                <div class="control">
                    <input name="site_twitter" class="input is-primary is-fullwidth" type="text" placeholder="Twitter Url.." value="{{ $general->site_twitter }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Youtube</h4></label>
                <div class="control">
                    <input name="site_youtube" class="input is-primary is-fullwidth" type="text" placeholder="Youtube Url.." value="{{ $general->site_youtube }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Pinterest</h4></label>
                <div class="control">
                    <input name="site_pinterest" class="input is-primary is-fullwidth" type="text" placeholder="Pinterest Url.." value="{{ $general->site_pinterest }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Linkedin</h4></label>
                <div class="control">
                    <input name="site_linkedin" class="input is-primary is-fullwidth" type="text" placeholder="Linkedin Url.." value="{{ $general->site_linkedin }}">
                </div>
            </div>
            <div class="field">
                <label><h4>Facebook</h4></label>
                <div class="control">
                    <input name="site_facebook" class="input is-primary is-fullwidth" type="text" placeholder="Facebook Url.." value="{{ $general->site_facebook }}">
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
        //Site Style
        var $site_style = $('#site_style').selectize({
            create      : false,
            sortField   : 'text',
        });
        var siteStyle = $site_style[0].selectize;
        var $site_style_id = $('#site_styleID input[name="site_style_id"]').val();
        siteStyle.addOption({ value: 'dark', text: 'Dark' });
        siteStyle.addOption({ value: 'light', text: 'Light' });
        siteStyle.addItem($site_style_id);
    });
</script>
@endsection
