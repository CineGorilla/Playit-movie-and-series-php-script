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
                    <li><span>Pageviews</span></li>
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
        {{-- Month Select --}}
        <div style="display: flex;">
            <span class="ml-auto" style="line-height: 30px;"><b>Select Month :&nbsp;</b></span>
            <h6 class="title is-6">
                {!! Form::open(['url' => '/admin/stats/pageviews','method'=>'get', 'class' => 'item p-0', 'id' => 'month-select']) !!}
                    <select name="month" class="custom-select custom-select-sm">
                        <option value="1" @if($month == 1) selected @endif>January</option>
                        <option value="2" @if($month == 2) selected @endif>February</option>
                        <option value="3" @if($month == 3) selected @endif>March</option>
                        <option value="4" @if($month == 4) selected @endif>April</option>
                        <option value="5" @if($month == 5) selected @endif>May</option>
                        <option value="6" @if($month == 6) selected @endif>June</option>
                        <option value="7" @if($month == 7) selected @endif>July</option>
                        <option value="8" @if($month == 8) selected @endif>August</option>
                        <option value="9" @if($month == 9) selected @endif>September</option>
                        <option value="10" @if($month == 10) selected @endif>October</option>
                        <option value="11" @if($month == 11) selected @endif>November</option>
                        <option value="12" @if($month == 12) selected @endif>December</option>
                    </select>
                {!! Form::close() !!}
            </h6>
        </div>
        {{-- End Month Select --}}
        {{-- PageView --}}
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="box">
                     <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Visitors and Pageviews</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div id="columnchart_material" style="width: 100%;"></div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        {{-- PageView End --}}
        {{-- Visitors and Pageviews --}}
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="box">
                     <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Latest Visitors and Pageviews Lists</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 510px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Page Title</th>
                                                <th scope="col">Page Views</th>
                                                <th scope="col">Visitors</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($pageviewslists) > 0)
                                                @foreach ($pageviewslists->sortByDesc('date') as $pageviewslist)
                                                <tr>
                                                    <td>{{ date("d-M-Y",strtotime($pageviewslist['date'])) }}</td>
                                                    <td>{{ $pageviewslist['pageTitle'] }}</td>
                                                    <td>{{ $pageviewslist['pageViews'] }}</td>
                                                    <td>{{ $pageviewslist['visitors'] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data for pageviews or visitors for the current month!</td>
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
        {{-- Visitors and Pageviews End --}}
        {{-- Most Visited Pages and Top referrers --}}
        <div class="row mb-5">
            <div class="col-md-8">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Most Visited Pages</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 410px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Page Title</th>
                                                <th scope="col">Page Views</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($mostVisitedPages) > 0)
                                                @foreach ($mostVisitedPages as $mostVisitedPage)
                                                <tr>
                                                    <td>
                                                        {{ $mostVisitedPage['pageTitle'] }}
                                                        <p style=" font-size: 12px; line-height: 13px; ">{{ $mostVisitedPage['url'] }}</p>
                                                    </td>
                                                    <td>{{ $mostVisitedPage['pageViews'] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data for Most Visited Pages!</td>
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
                            <h6 class="title is-6">Top Referrers</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 410px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Url</th>
                                                <th scope="col">Page Views</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($topReferrers) > 0)
                                                @foreach ($topReferrers as $topReferrer)
                                                <tr>
                                                    <td>{{ $topReferrer['url'] }}</td>
                                                    <td>{{ $topReferrer['pageViews'] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data for Most Visited Pages!</td>
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
        {{-- Most Visited Pages and Top referrers End --}}
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(
                {!! $pageviewsValue !!}
            );
            var options = {
                chart: {
                    subtitle: 'visitors and pageviews for the month of {{ $month_name }} - {{ $currentYear }}',
                },
                bars: 'vertical',
                vAxis: {format: 'short'},
                height: 400,
                colors: ['#1b9e47', '#d95f02']
            };
            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        $(document).ready(function(){
            //Month Select
            $('#month-select')
            .on('change', function() {
                $(this).submit();
            })
        });
    </script>
@endsection
