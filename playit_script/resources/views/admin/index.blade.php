@extends('admin.layouts.master')
@section('content')

<!-- Page Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Home</a></li>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
        <!-- Account -->
        @include('admin.layouts.account')
    </div>
</div>

<!-- Main Content -->
<div class="main-content-inner">
    <div class="mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 mb-5">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">TOTAL MOVIES</h6>
                            <span class="ml-auto"></span>
                            <h6 class="title is-6"><a style="color: #00d1b2;" href="{{url('/admin/movies')}}">VIEW ALL</a></h6>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p class="title is-2"><i class="fas fa-video" style="font-size: 35px;"></i> {{ $total_movie }}</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">TOTAL SERIES</h6>
                            <span class="ml-auto"></span>
                            <h6 class="title is-6"><a style="color: #00d1b2;" href="{{url('/admin/series')}}">VIEW ALL</a></h6>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p class="title is-2"><i class="fas fa-ticket-alt" style="font-size: 35px;"></i> {{ $total_series }}</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">TOTAL EPISODES</h6>
                            <span class="ml-auto"></span>
                            <h6 class="title is-6"><a style="color: #00d1b2;" href="{{url('/admin/episodes')}}">VIEW ALL</a></h6>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p class="title is-2"><i class="fas fa-film" style="font-size: 35px;"></i> {{ $total_episodes }}</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-5">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">TOTAL USER</h6>
                            <span class="ml-auto"></span>
                            <h6 class="title is-6"><a style="color: #00d1b2;" href="{{url('/admin/users')}}">VIEW ALL</a></h6>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p class="title is-2"><i class="fas fa-users" style="font-size: 35px;"></i> {{ $total_user }}</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">TOTAL SUBSCRIBERS</h6>
                            <span class="ml-auto"></span>
                            <h6 class="title is-6"><a style="color: #00d1b2;" href="{{url('/admin/newsletter')}}">VIEW ALL</a></h6>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p class="title is-2"><i class="fas fa-newspaper" style="font-size: 35px;"></i> {{ $total_subscribers }}</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">TOTAL COMMENTS</h6>
                            <span class="ml-auto"></span>
                            <h6 class="title is-6"><a style="color: #00d1b2;" href="{{url('/admin/comments')}}">VIEW ALL</a></h6>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p class="title is-2"><i class="far fa-comment-alt" style="font-size: 35px;"></i> {{ $total_comments }}</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Most Viewed Movies</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 268px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Movie Name</th>
                                                <th scope="col">Views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($most_view_movies) > 0)
                                                @foreach ($most_view_movies as $most_view_movie)
                                                <tr>
                                                    <td><a style="color: #00d1b2;" href="{{url('movie')}}/{{ $most_view_movie->slug }}" target="_blank">{{ $most_view_movie->name }}</a></td>
                                                    <td>{{ $most_view_movie->views }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>There is no movies!</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Most Viewed Series</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 268px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Series Name</th>
                                                <th scope="col">Views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($most_view_movies) > 0)
                                                @foreach ($most_view_series as $most_view_serie)
                                                <tr>
                                                    <td><a style="color: #00d1b2;" href="{{url('series')}}/{{ $most_view_serie->slug }}" target="_blank">{{ $most_view_serie->name }}</a></td>
                                                    <td>{{ $most_view_serie->views }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>There is no series!</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Latest Users</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 250px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Country</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($latest_users) > 0)
                                                @foreach ($latest_users as $latest_user)
                                                <tr>
                                                    <td>{{ $latest_user->name }}</td>
                                                    <td>{{ $latest_user->email }}</td>
                                                    <td>{{ $latest_user->country }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>There is no user!</td>
                                            @endif    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Latest Subscribers</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 250px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Email</th>
                                                <th scope="col">Country</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($latest_subscribers) > 0)
                                                @foreach ($latest_subscribers as $latest_subscriber)
                                                <tr>
                                                    <td>{{ $latest_subscriber->email }}</td>
                                                    <td>{{ $latest_subscriber->country }}</td>
                                                    <td>{{ $latest_subscriber->created_at }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>There is no subscribers!</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')

@endsection