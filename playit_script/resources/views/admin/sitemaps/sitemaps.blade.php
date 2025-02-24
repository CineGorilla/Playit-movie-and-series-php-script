@extends('admin.layouts.master')
@section('content')

<!-- Series Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Sitemaps</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Sitemaps Generator</span></li>
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
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="single-table">
                    <div class="table-responsive">
                         <table class="table ">
                            <tbody>
                                <tr>
                                    <td><b>Index All (Homepage / Movies / Series / Episodes / Pages / Genres)</b></td>
                                    <td>
                                        <a class="ui basic small button" href="{{ url('sitemap.xml') }}" target="_blank">Read</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['url' => 'admin/sitemaps/index','method'=>'post']) !!}
                                            <input type="hidden" name="items" value="index">
                                            <button type="submit" class="ui basic small button ">Generate</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Movies</b></td>
                                    <td>
                                        <a class="ui basic small button" href="{{ url('movies-sitemap.xml') }}" target="_blank">Read</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['url' => 'admin/sitemaps/movie','method'=>'post']) !!}
                                            <input type="hidden" name="items" value="movies">
                                            <button type="submit" class="ui basic small button ">Generate</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Series</b></td>
                                    <td>
                                        <a class="ui basic small button" href="{{ url('series-sitemap.xml') }}" target="_blank">Read</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['url' => 'admin/sitemaps/series','method'=>'post']) !!}
                                            <input type="hidden" name="items" value="series">
                                            <button type="submit" class="ui basic small button ">Generate</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Episodes</b></td>
                                    <td>
                                        <a class="ui basic small button" href="{{ url('episodes-sitemap.xml') }}" target="_blank">Read</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['url' => 'admin/sitemaps/episodes','method'=>'post']) !!}
                                            <input type="hidden" name="items" value="episodes">
                                            <button type="submit" class="ui basic small button ">Generate</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Pages</b></td>
                                    <td>
                                        <a class="ui basic small button" href="{{ url('pages-sitemap.xml') }}" target="_blank">Read</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['url' => 'admin/sitemaps/page','method'=>'post']) !!}
                                            <input type="hidden" name="items" value="pages">
                                            <button type="submit" class="ui basic small button ">Generate</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>   
                                <tr>
                                    <td><b>Genres</b></td>
                                    <td>
                                        <a class="ui basic small button" href="{{ url('genres-sitemap.xml') }}" target="_blank">Read</a>
                                    </td>
                                    <td>
                                        {!! Form::open(['url' => 'admin/sitemaps/genre','method'=>'post']) !!}
                                            <input type="hidden" name="items" value="genres">
                                            <button type="submit" class="ui basic small button ">Generate</button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>   
                            </tbody>
                         </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    
</script>
@endsection