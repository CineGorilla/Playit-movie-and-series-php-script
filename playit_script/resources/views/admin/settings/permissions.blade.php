@extends('admin.layouts.master')
@section('content')

<!-- Series Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Permissions</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Settings</span></li>
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

    <div class="tabs">
        <ul>
            <li class="tab is-active" onclick="openTab(event,'administrators')"><a >Administrators</a></li>
            <li class="tab" onclick="openTab(event,'moderators')"><a >Moderators</a></li>
            <li class="tab" onclick="openTab(event,'authors')"><a >Authors</a></li>
        </ul>
    </div>

    <div id="administrators" class="content-tab" style="width:100%">
        {!! Form::model($administratorsRole, ['route' => ['update_administrators_permissions'],'method'=>'put']) !!}
            <h6 class="title is-6 "><center>Administrators Permissions</center></h6>
            <div class="columns" style="margin-top : 5px;">
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Movies</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_index" name="movie_index" @if($administratorsRole->hasPermissionTo('movie_index')) checked @endif>
                                <label for="movie_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_add" name="movie_add" @if($administratorsRole->hasPermissionTo('movie_add')) checked @endif>
                                <label for="movie_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_update" name="movie_update" @if($administratorsRole->hasPermissionTo('movie_update')) checked @endif>
                                <label for="movie_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_delete" name="movie_delete" @if($administratorsRole->hasPermissionTo('movie_delete')) checked @endif>
                                <label for="movie_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Profile</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="profile_index" name="profile_index" @if($administratorsRole->hasPermissionTo('profile_index')) checked @endif>
                                <label for="profile_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="profile_update" name="profile_update" @if($administratorsRole->hasPermissionTo('profile_update')) checked @endif>
                                <label for="profile_update">Update</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Series</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_index" name="series_index" @if($administratorsRole->hasPermissionTo('series_index')) checked @endif>
                                <label for="series_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_add" name="series_add" @if($administratorsRole->hasPermissionTo('series_add')) checked @endif>
                                <label for="series_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_update" name="series_update" @if($administratorsRole->hasPermissionTo('series_update')) checked @endif>
                                <label for="series_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_delete" name="series_delete" @if($administratorsRole->hasPermissionTo('series_delete')) checked @endif>
                                <label for="series_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Comments</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="comments_index" name="comments_index" @if($administratorsRole->hasPermissionTo('comments_index')) checked @endif>
                                <label for="comments_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="comments_delete" name="comments_delete" @if($administratorsRole->hasPermissionTo('comments_delete')) checked @endif>
                                <label for="comments_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Episodes</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_index" name="episodes_index" @if($administratorsRole->hasPermissionTo('episodes_index')) checked @endif>
                                <label for="episodes_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_add" name="episodes_add" @if($administratorsRole->hasPermissionTo('episodes_add')) checked @endif>
                                <label for="episodes_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_update" name="episodes_update" @if($administratorsRole->hasPermissionTo('episodes_update')) checked @endif>
                                <label for="episodes_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_delete" name="episodes_delete" @if($administratorsRole->hasPermissionTo('episodes_delete')) checked @endif>
                                <label for="episodes_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Newsletters</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="newsletters_index" name="newsletters_index" @if($administratorsRole->hasPermissionTo('newsletters_index')) checked @endif>
                                <label for="newsletters_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="newsletters_send" name="newsletters_send" @if($administratorsRole->hasPermissionTo('newsletters_send')) checked @endif>
                                <label for="newsletters_send">Send</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Pages</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_index" name="pages_index" @if($administratorsRole->hasPermissionTo('pages_index')) checked @endif>
                                <label for="pages_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_add" name="pages_add" @if($administratorsRole->hasPermissionTo('pages_add')) checked @endif>
                                <label for="pages_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_update" name="pages_update" @if($administratorsRole->hasPermissionTo('pages_update')) checked @endif>
                                <label for="pages_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_delete" name="pages_delete" @if($administratorsRole->hasPermissionTo('pages_delete')) checked @endif>
                                <label for="pages_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Analytics Stats</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="stats_index" name="stats_index" @if($administratorsRole->hasPermissionTo('stats_index')) checked @endif>
                                <label for="stats_index">Get</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Users</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_index" name="users_index" @if($administratorsRole->hasPermissionTo('users_index')) checked @endif>
                                <label for="users_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_add" name="users_add" @if($administratorsRole->hasPermissionTo('users_add')) checked @endif>
                                <label for="users_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_update" name="users_update" @if($administratorsRole->hasPermissionTo('users_update')) checked @endif>
                                <label for="users_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_delete" name="users_delete" @if($administratorsRole->hasPermissionTo('users_delete')) checked @endif>
                                <label for="users_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Settings</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="settings_index" name="settings_index" @if($administratorsRole->hasPermissionTo('settings_index')) checked @endif>
                                <label for="settings_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="settings_update" name="settings_update" @if($administratorsRole->hasPermissionTo('settings_update')) checked @endif>
                                <label for="settings_update">Update</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Genres</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_index" name="genres_index" @if($administratorsRole->hasPermissionTo('genres_index')) checked @endif>
                                <label for="genres_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_add" name="genres_add" @if($administratorsRole->hasPermissionTo('genres_add')) checked @endif>
                                <label for="genres_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_update" name="genres_update" @if($administratorsRole->hasPermissionTo('genres_update')) checked @endif>
                                <label for="genres_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_delete" name="genres_delete" @if($administratorsRole->hasPermissionTo('genres_delete')) checked @endif>
                                <label for="episodegenres_deletes_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-grouped is-pulled-right">
                <div class="control">
                    <button type="submit" class="button is-primary is-normal">Save Administrators Permissions</button>
                </div>
                <div class="control">
                    <a href="/admin" class="button is-danger is-normal" style="color:white;">Cancel</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

    <div id="moderators" class="content-tab" style="display:none;width:100%;">
        {!! Form::model($moderatorsRole, ['route' => ['update_moderators_permissions'],'method'=>'put']) !!}
            <h6 class="title is-6 "><center>Moderators Permissions</center></h6>
            <div class="columns" style="margin-top : 5px;">
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Movies</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_index" name="movie_index" @if($moderatorsRole->hasPermissionTo('movie_index')) checked @endif>
                                <label for="movie_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_add" name="movie_add" @if($moderatorsRole->hasPermissionTo('movie_add')) checked @endif>
                                <label for="movie_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_update" name="movie_update" @if($moderatorsRole->hasPermissionTo('movie_update')) checked @endif>
                                <label for="movie_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_delete" name="movie_delete" @if($moderatorsRole->hasPermissionTo('movie_delete')) checked @endif>
                                <label for="movie_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Profile</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="profile_index" name="profile_index" @if($moderatorsRole->hasPermissionTo('profile_index')) checked @endif>
                                <label for="profile_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="profile_update" name="profile_update" @if($moderatorsRole->hasPermissionTo('profile_update')) checked @endif>
                                <label for="profile_update">Update</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Series</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_index" name="series_index" @if($moderatorsRole->hasPermissionTo('series_index')) checked @endif>
                                <label for="series_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_add" name="series_add" @if($moderatorsRole->hasPermissionTo('series_add')) checked @endif>
                                <label for="series_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_update" name="series_update" @if($moderatorsRole->hasPermissionTo('series_update')) checked @endif>
                                <label for="series_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_delete" name="series_delete" @if($moderatorsRole->hasPermissionTo('series_delete')) checked @endif>
                                <label for="series_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Comments</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="comments_index" name="comments_index" @if($moderatorsRole->hasPermissionTo('comments_index')) checked @endif>
                                <label for="comments_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="comments_delete" name="comments_delete" @if($moderatorsRole->hasPermissionTo('comments_delete')) checked @endif>
                                <label for="comments_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Episodes</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_index" name="episodes_index" @if($moderatorsRole->hasPermissionTo('episodes_index')) checked @endif>
                                <label for="episodes_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_add" name="episodes_add" @if($moderatorsRole->hasPermissionTo('episodes_add')) checked @endif>
                                <label for="episodes_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_update" name="episodes_update" @if($moderatorsRole->hasPermissionTo('episodes_update')) checked @endif>
                                <label for="episodes_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_delete" name="episodes_delete" @if($moderatorsRole->hasPermissionTo('episodes_delete')) checked @endif>
                                <label for="episodes_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Newsletters</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="newsletters_index" name="newsletters_index" @if($moderatorsRole->hasPermissionTo('newsletters_index')) checked @endif>
                                <label for="newsletters_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="newsletters_send" name="newsletters_send" @if($moderatorsRole->hasPermissionTo('newsletters_send')) checked @endif>
                                <label for="newsletters_send">Send</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Pages</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_index" name="pages_index" @if($moderatorsRole->hasPermissionTo('pages_index')) checked @endif>
                                <label for="pages_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_add" name="pages_add" @if($moderatorsRole->hasPermissionTo('pages_add')) checked @endif>
                                <label for="pages_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_update" name="pages_update" @if($moderatorsRole->hasPermissionTo('pages_update')) checked @endif>
                                <label for="pages_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_delete" name="pages_delete" @if($moderatorsRole->hasPermissionTo('pages_delete')) checked @endif>
                                <label for="pages_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Analytics Stats</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="stats_index" name="stats_index" @if($moderatorsRole->hasPermissionTo('stats_index')) checked @endif>
                                <label for="stats_index">Get</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Users</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_index" name="users_index" @if($moderatorsRole->hasPermissionTo('users_index')) checked @endif>
                                <label for="users_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_add" name="users_add" @if($moderatorsRole->hasPermissionTo('users_add')) checked @endif>
                                <label for="users_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_update" name="users_update" @if($moderatorsRole->hasPermissionTo('users_update')) checked @endif>
                                <label for="users_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_delete" name="users_delete" @if($moderatorsRole->hasPermissionTo('users_delete')) checked @endif>
                                <label for="users_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Settings</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="settings_index" name="settings_index" @if($moderatorsRole->hasPermissionTo('settings_index')) checked @endif>
                                <label for="settings_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="settings_update" name="settings_update" @if($moderatorsRole->hasPermissionTo('settings_update')) checked @endif>
                                <label for="settings_update">Update</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Genres</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_index" name="genres_index" @if($moderatorsRole->hasPermissionTo('genres_index')) checked @endif>
                                <label for="genres_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_add" name="genres_add" @if($moderatorsRole->hasPermissionTo('genres_add')) checked @endif>
                                <label for="genres_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_update" name="genres_update" @if($moderatorsRole->hasPermissionTo('genres_update')) checked @endif>
                                <label for="genres_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_delete" name="genres_delete" @if($moderatorsRole->hasPermissionTo('genres_delete')) checked @endif>
                                <label for="episodegenres_deletes_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-grouped is-pulled-right">
                <div class="control">
                    <button type="submit" class="button is-primary is-normal">Save Moderators Permissions</button>
                </div>
                <div class="control">
                    <a href="/admin" class="button is-danger is-normal" style="color:white;">Cancel</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

    <div id="authors" class="content-tab" style="display:none;width:100%;">
        {!! Form::model($authorsRole, ['route' => ['update_authors_permissions'],'method'=>'put']) !!}
            <h6 class="title is-6 "><center>Authors Permissions</center></h6>
            <div class="columns" style="margin-top : 5px;">
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Movies</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_index" name="movie_index" @if($authorsRole->hasPermissionTo('movie_index')) checked @endif>
                                <label for="movie_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_add" name="movie_add" @if($authorsRole->hasPermissionTo('movie_add')) checked @endif>
                                <label for="movie_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_update" name="movie_update" @if($authorsRole->hasPermissionTo('movie_update')) checked @endif>
                                <label for="movie_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="movie_delete" name="movie_delete" @if($authorsRole->hasPermissionTo('movie_delete')) checked @endif>
                                <label for="movie_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Profile</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="profile_index" name="profile_index" @if($authorsRole->hasPermissionTo('profile_index')) checked @endif>
                                <label for="profile_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="profile_update" name="profile_update" @if($authorsRole->hasPermissionTo('profile_update')) checked @endif>
                                <label for="profile_update">Update</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Series</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_index" name="series_index" @if($authorsRole->hasPermissionTo('series_index')) checked @endif>
                                <label for="series_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_add" name="series_add" @if($authorsRole->hasPermissionTo('series_add')) checked @endif>
                                <label for="series_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_update" name="series_update" @if($authorsRole->hasPermissionTo('series_update')) checked @endif>
                                <label for="series_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="series_delete" name="series_delete" @if($authorsRole->hasPermissionTo('series_delete')) checked @endif>
                                <label for="series_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Comments</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="comments_index" name="comments_index" @if($authorsRole->hasPermissionTo('comments_index')) checked @endif>
                                <label for="comments_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="comments_delete" name="comments_delete" @if($authorsRole->hasPermissionTo('comments_delete')) checked @endif>
                                <label for="comments_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Episodes</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_index" name="episodes_index" @if($authorsRole->hasPermissionTo('episodes_index')) checked @endif>
                                <label for="episodes_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_add" name="episodes_add" @if($authorsRole->hasPermissionTo('episodes_add')) checked @endif>
                                <label for="episodes_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_update" name="episodes_update" @if($authorsRole->hasPermissionTo('episodes_update')) checked @endif>
                                <label for="episodes_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="episodes_delete" name="episodes_delete" @if($authorsRole->hasPermissionTo('episodes_delete')) checked @endif>
                                <label for="episodes_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Newsletters</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="newsletters_index" name="newsletters_index" @if($authorsRole->hasPermissionTo('newsletters_index')) checked @endif>
                                <label for="newsletters_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="newsletters_send" name="newsletters_send" @if($authorsRole->hasPermissionTo('newsletters_send')) checked @endif>
                                <label for="newsletters_send">Send</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Pages</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_index" name="pages_index" @if($authorsRole->hasPermissionTo('pages_index')) checked @endif>
                                <label for="pages_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_add" name="pages_add" @if($authorsRole->hasPermissionTo('pages_add')) checked @endif>
                                <label for="pages_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_update" name="pages_update" @if($authorsRole->hasPermissionTo('pages_update')) checked @endif>
                                <label for="pages_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="pages_delete" name="pages_delete" @if($authorsRole->hasPermissionTo('pages_delete')) checked @endif>
                                <label for="pages_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Analytics Stats</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="stats_index" name="stats_index" @if($authorsRole->hasPermissionTo('stats_index')) checked @endif>
                                <label for="stats_index">Get</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Users</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_index" name="users_index" @if($authorsRole->hasPermissionTo('users_index')) checked @endif>
                                <label for="users_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_add" name="users_add" @if($authorsRole->hasPermissionTo('users_add')) checked @endif>
                                <label for="users_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_update" name="users_update" @if($authorsRole->hasPermissionTo('users_update')) checked @endif>
                                <label for="users_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="users_delete" name="users_delete" @if($authorsRole->hasPermissionTo('users_delete')) checked @endif>
                                <label for="users_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header"><h2><b>Settings</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="settings_index" name="settings_index" @if($authorsRole->hasPermissionTo('settings_index')) checked @endif>
                                <label for="settings_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="settings_update" name="settings_update" @if($authorsRole->hasPermissionTo('settings_update')) checked @endif>
                                <label for="settings_update">Update</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-header"><h2><b>Genres</b></h2></div>
                        <div class="card-content">
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_index" name="genres_index" @if($authorsRole->hasPermissionTo('genres_index')) checked @endif>
                                <label for="genres_index">Get</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_add" name="genres_add" @if($authorsRole->hasPermissionTo('genres_add')) checked @endif>
                                <label for="genres_add">Add</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_update" name="genres_update" @if($authorsRole->hasPermissionTo('genres_update')) checked @endif>
                                <label for="genres_update">Update</label>
                            </div>
                            <div class="field">
                                <input type="checkbox" tabindex="0" id="genres_delete" name="genres_delete" @if($authorsRole->hasPermissionTo('genres_delete')) checked @endif>
                                <label for="episodegenres_deletes_delete">Delete</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-grouped is-pulled-right">
                <div class="control">
                    <button type="submit" class="button is-primary is-normal">Save Authors Permissions</button>
                </div>
                <div class="control">
                    <a href="/admin" class="button is-danger is-normal" style="color:white;">Cancel</a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

</div>
@endsection

@section('js')
<script type="text/javascript">

        function openTab(evt, tabName) {
            var i, x, tablinks;
            x = document.getElementsByClassName("content-tab");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" is-active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " is-active";
        }

</script>
@endsection
