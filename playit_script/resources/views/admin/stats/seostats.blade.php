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
                    <li><span>SEO Stats</span></li>
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
                {!! Form::open(['url' => '/admin/stats/seo-stats','method'=>'get', 'class' => 'item p-0', 'id' => 'month-select']) !!}
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

        {{-- New vs Returning Visitor --}}
        <div class="row mb-5">
            <div class="col-md-8">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">New vs Returning Visitor</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div id="piechart" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Session Duration</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 100px;">
                                    <table class="table">
                                        <tbody >
                                            @if(count($newVsReturningsessionsDurations) > 0)
                                                @foreach ($newVsReturningsessionsDurations as $newVsReturningsessionsDuration)
                                                <tr>
                                                    <td>{{ $newVsReturningsessionsDuration[0] }}</td>
                                                    <td>{{ $newVsReturningsessionsDuration[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data!</td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                 <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Pageviews</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 100px;">
                                    <table class="table">
                                        <tbody >
                                            @if(count($newVsReturningPageviews) > 0)
                                                @foreach ($newVsReturningPageviews as $newVsReturningPageview)
                                                <tr>
                                                    <td>{{ $newVsReturningPageview[0] }}</td>
                                                    <td>{{ $newVsReturningPageview[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data!</td>
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
        {{-- New vs Returning Visitor End --}}

        {{-- Info Other --}}
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Mobile Devices</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 300px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Device Name</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($mobileDevices) > 0)
                                                @foreach ($mobileDevices as $mobileDevice)
                                                <tr>
                                                    <td>{{ $mobileDevice[0] }}</td>
                                                    <td>{{ $mobileDevice[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data!</td>
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
                            <h6 class="title is-6">Operating System</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 300px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">OS Name</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($operatingSystems) > 0)
                                                @foreach ($operatingSystems as $operatingSystem)
                                                <tr>
                                                    <td>{{ $operatingSystem[0] }}</td>
                                                    <td>{{ $operatingSystem[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data!</td>
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
                            <h6 class="title is-6">Countries</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 300px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Country</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($countrys) > 0)
                                                @foreach ($countrys as $country)
                                                <tr>
                                                    <td>{{ $country[0] }}</td>
                                                    <td>{{ $country[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data!</td>
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
        {{-- Info Other End --}}

        {{-- Source Info Other --}}
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Sources</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 300px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Sources</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($sources) > 0)
                                                @foreach ($sources as $source)
                                                <tr>
                                                    <td>{{ $source[0] }}</td>
                                                    <td>{{ $source[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data!</td>
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
                            <h6 class="title is-6">Mediums</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 300px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Mediums</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($mediums) > 0)
                                                @foreach ($mediums as $medium)
                                                <tr>
                                                    <td>{{ $medium[0] }}</td>
                                                    <td>{{ $medium[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data!</td>
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
        {{-- Source Info End --}}

        {{-- Search Engines and Keywords --}}
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="box">
                    <article>
                        <div style="display: flex;">
                            <h6 class="title is-6">Search Engines</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 300px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Search Engines</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($searchEngines) > 0)
                                                @foreach ($searchEngines as $searchEngine)
                                                <tr>
                                                    <td>{{ $searchEngine[0] }}</td>
                                                    <td>{{ $searchEngine[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data!</td>
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
                            <h6 class="title is-6">Keywords</h6>
                            <span class="ml-auto"></span>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <div class="table-responsive" style="display: block;height: 300px;">
                                    <table class="table">
                                        <thead class="bg-danger">
                                            <tr>
                                                <th scope="col">Keywords</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @if(count($keywords) > 0)
                                                @foreach ($keywords as $keyword)
                                                <tr>
                                                    <td>{{ $keyword[0] }}</td>
                                                    <td>{{ $keyword[1] }}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <td>No Data!</td>
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
        {{-- Search Engines and Keywords End --}}

    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable({!! $newVsReturningValue !!});
            var options = {
                title: 'New vs Returning Visitor'
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            //Month Select
            $('#month-select')
            .on('change', function() {
                $(this).submit();
            })
        });
    </script>
@endsection