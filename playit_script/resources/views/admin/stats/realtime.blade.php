@extends('admin.layouts.master')
@section('content')

<!-- Page Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Stats</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Home</a></li>
                    <li><span>Realtime</span></li>
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
            <div class="col-md-4">
                <div class="box mb-5">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Right now</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <center><p class="title is-2" style="margin-bottom: 0;"><i class="fas fa-users" style="font-size: 35px;"></i> {{ $visitorsOnline }}</p>
                                <p style="font-size: 12px;">active users on site</p></center>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="box mb-5">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Locations</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 210px;overflow-x: auto;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Country</th>
                                                <th scope="col">Active Users</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($gioTopLocationsResults) > 0)
                                                @foreach ($gioTopLocationsResults as $gioTopLocationsResult)
                                                <tr>
                                                    <td>{{ $gioTopLocationsResult[0] }}</td>
                                                    <td>{{ $gioTopLocationsResult[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No data!</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box mb-5">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Top Locations</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div id="regions_div" style="width: 100%;"></div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Active Pages</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 210px;overflow-x: auto;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Active Page</th>
                                                <th scope="col">Active Users</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($pagePathResults) > 0)
                                                @foreach ($pagePathResults as $pagePathResult)
                                                <tr>
                                                    <td>{{ $pagePathResult[0] }}</td>
                                                    <td>{{ $pagePathResult[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No data!</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Source</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 210px;overflow-x: auto;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Source</th>
                                                <th scope="col">Active Users</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($visitorsSources) > 0)
                                                @foreach ($visitorsSources as $visitorsSource)
                                                <tr>
                                                    <td>{{ $visitorsSource[0] }}</td>
                                                    <td>{{ $visitorsSource[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No data!</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Keywords</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 210px;overflow-x: auto;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Keywords</th>
                                                <th scope="col">Active Users</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($keywords) > 0)
                                                @foreach ($keywords as $keyword)
                                                <tr>
                                                    <td>{{ $keyword[0] }}</td>
                                                    <td>{{ $keyword[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No data!</td>
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages':['geochart'],
            'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
        });
        google.charts.setOnLoadCallback(drawRegionsMap);
        function drawRegionsMap() {
            var geo = google.visualization.arrayToDataTable(
               {!!$gioTopLocations!!}
            );
            var options = {
                backgroundColor: '#81d4fa',
            };
            //Geo Chart
            var Geochart = new google.visualization.GeoChart(document.getElementById('regions_div'));
            Geochart.draw(geo, options);
        }
    </script>
@endsection