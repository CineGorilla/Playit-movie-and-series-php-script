@extends('admin.layouts.master')
@section('content')

<!-- Page Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Episodes</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Add Episode</span></li>
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

    {!! Form::open(['route' => 'save_episodes','method'=>'post','enctype' => 'multipart/form-data', 'class' => 'form episodes']) !!}

        <div class="columns" style="margin-top : 5px;">
            <div class="column is-one-quarter" id="series_tmdb">
                <div class="field" id="series_id">
                    <label><h4>Select Series</h4></label>
                    <div class="control">
                        <div class="select is-multiple is-primary is-fullwidth">
                            <select id="series_list" name="series_list" type="text" value="" placeholder="Select Series" ></select>
                        </div>
                        <button type="button" class="button is-small is-fullwidth is-primary">GENERATE SEASONS</button>
                    </div>
                </div>
                <div class="field" id="series_seasons">
                    <label><h4>Select Season</h4></label>
                    <div class="control">
                        <div class="select is-multiple is-primary is-fullwidth is-hidden">
                            <select id="series_seasons" name="tmdb_series_seasons" type="text" value="" placeholder="Select Season" ></select>
                        </div>
                        <div class="addown is-primary is-fullwidth is-fullwidth">
                            <input class="input is-primary" type="text" name="series_seasons" placeholder="Enter Season" value="">
                        </div>
                        <button type="button" class="button is-small is-fullwidth is-primary is-hidden">GENERATE EPISODES</button>
                    </div>
                </div>
                <div class="field" id="series_episode">
                    <label><h4>Select Episode</h4></label>
                    <div class="control">
                        <div class="select is-multiple is-primary is-fullwidth is-hidden">
                            <select id="series_episode" name="tmdb_series_episode" type="text" value="" placeholder="Select Episode" ></select>
                        </div>
                        <div class="addown is-primary is-fullwidth is-fullwidth">
                            <input class="input is-primary" type="text" name="series_episode" placeholder="Enter Episode" value="">
                        </div>
                        <button type="button" class="button is-small is-fullwidth is-primary is-hidden">GENERATE DATA</button>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="columns">
                    <div class="column">
                        <div class="field image">
                            <img src="{{ asset('public/backend/images/default_backdrop.jpg') }}" alt="backdrop image" id="episode_image">
                            <input type="hidden" name="episode_image_url" value="">
                            <input type="file" accept="image/*" name="episode_image" class="d-none">
                            <button type="button" class="button is-small is-fullwidth">Select Backdrop</button>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label><h4>Episode Name</h4></label>
                            <div class="control">
                                <input name="episode_name" class="input is-primary is-fullwidth" type="text" placeholder="Name" val="">
                            </div>
                        </div>
                        <div class="field">
                            <label><h4>Description</h4></label>
                            <div class="control">
                                <textarea name="episode_description" class="textarea is-primary is-fullwidth" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label><h4>Air Date (YYYY-MM-DD)</h4></label>
                            <div class="control">
                                <input name="episode_airdate" class="input is-primary is-fullwidth" type="text" placeholder="Air Date" val="">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Player --}}
                <div class="columns" style="margin-bottom : -20px;">
                    <div class="column">
                        <div class="field">
                            <label><h4>Players</h4></label>
                        </div>
                    </div>
                </div>
                <div class="field" id="players">
                    <div class="control player1">
                        <div class="columns">
                            <div class="column is-one-fifth">
                                <div class="select is-primary">
                                    <select name="episode_player_type[]">
                                        <option>Select Options</option>
                                        <option value="embeded">Embeded</option>
                                        <option value="direct">Direct Link</option>
                                        <option value="stream">Stream</option>
                                    </select>
                                </div>
                            </div>
                            <div class="column is-one-fifth">
                                <div class="control">
                                    <input name="episode_player_name[]" class="input is-primary is-one-quarter" type="text" placeholder="Player Name..">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <input name="episode_player_url[]" class="input is-primary" type="text" placeholder="Player Url..">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <button type="button" id="addPlayer" class="button is-primary is-small is-fullwidth">Add New Player</button>
                    </div>
                    <div class="column">
                        <button type="button" id="removePlayer" class="button is-danger is-small is-fullwidth">Remove Last Player</button>
                    </div>
                </div>
                <div class="notification is-primary">
                    <strong>Direct Links :</strong> support for the major formats - Mp4, Mkv, Mov, etc..<br/>
                    <strong>Stream :</strong> support hls formats - m3u8..<br/>
                </div>
                {{-- Download --}}
                <div class="columns" style="margin-bottom : -20px;">
                    <div class="column">
                        <div class="field">
                            <label><h4>Downloads</h4></label>
                        </div>
                    </div>
                </div>
                <div class="field" id="downloads">
                    <div class="control download1">
                        <div class="columns">
                            <div class="column is-one-quarter">
                                <div class="control">
                                    <input name="episode_download_name[]" class="input is-primary is-one-quarter" type="text" placeholder="Download Name..">
                                </div>
                            </div>
                            <div class="column">
                                <div class="control">
                                    <input name="episode_download_url[]" class="input is-primary" type="text" placeholder="Download Url..">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="columns">
                    <input type="hidden" id="episode_unique_id" name="episode_unique_id" value="">
                    <div class="column">
                        <button type="button" id="addDownload" class="button is-primary is-small is-fullwidth">Add New Download</button>
                    </div>
                    <div class="column">
                        <button type="button" id="removeDownload" class="button is-danger is-small is-fullwidth">Remove Last Download</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="field is-grouped is-pulled-right">
            <div class="control">
                <button type="submit" class="button is-primary is-normal">Publish</button>
            </div>
            <div class="control">
                <a href="/admin/episodes" class="button is-danger is-normal" style="color:white;">Cancel</a>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection

@section('js')
<script type="text/javascript">
    //Fetch TMDB Series Episodes
    $(document).ready(function(){
        //Series list
        var $series = $('#series_list').selectize({
            create      : true,
            sortField   : 'text',
        });
        var seriesList = $series[0].selectize;
        $.getJSON('../data/get_series', function(genresData) {
            $.each(genresData, function(val, key) {
                    seriesList.addOption({ value: key.id, text: key.name + ' [ TMDB ID : '+ key.tmdb_id +' ]' });
            });
        });

        //Series Season list
        var $season = $('.select #series_seasons').selectize({
            create: false,
        });
        var seasonList = $season[0].selectize;

        //Series Episode list
        var $episode = $('.select #series_episode').selectize({
            create: false,
        });
        var episodeList = $episode[0].selectize;

        // Search Season
        $('#series_id button').click(function(){
          var seriesID = $('#series_id select[name="series_list"]').val();
            if(seriesID > 0){
                fetchSeason(seriesID);
            }else{
                alert('TMDB added series can only be genrated seasons!');
            }
        });

        function fetchSeason(id){
            $('#series_id button').addClass('is-loading');
            $.ajax({
                url: 'get_series/'+id,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    if(data['name'] === undefined){
                        $('#series_id button').removeClass('is-loading');
                        //not valid series id!
                        alert(data['status_message']);
                    }
                    else{
                        $('#series_seasons .select').removeClass('is-hidden');
                        $('#series_seasons button').removeClass('is-hidden');
                        $('#series_seasons .addown').addClass('is-hidden');

                        var seasons;
                        for (seasons = 1; seasons <= data['number_of_seasons']; seasons++) {
                            seasonList.addOption({ value: seasons, text: "Season "+seasons });
                        }
                        $('#series_id button').removeClass('is-loading');
                    }
                }
            });
        }
        //Fetch End

        // Fetch Episode
        $('#series_seasons button').click(function(){
            var seriesSeasonID = $('#series_seasons select[name="tmdb_series_seasons"]').val();
            var seriesID = $('#series_id select[name="series_list"]').val();
            fetchEpisodes(seriesSeasonID,seriesID);
        });
        function fetchEpisodes(seriesSeasonID,seriesID){
            $('#series_seasons button').addClass('is-loading');
            $.ajax({
                url: 'get_series/'+seriesID+'/'+seriesSeasonID,
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $('#series_episode .select').removeClass('is-hidden');
                    $('#series_episode button').removeClass('is-hidden');
                    $('#series_episode .addown').addClass('is-hidden');
                    $.each(data.episodes, function(val, key) {
                        episodeList.addOption({ value: key.episode_number, text: "Episode "+key.episode_number });
                    });
                    $('#series_seasons button').removeClass('is-loading');
                }
            });
        }
        //Fetch End

        // Fetch Episode Data
        $('#series_episode button').click(function(){
            var seriesSeasonID = $('#series_seasons select[name="tmdb_series_seasons"]').val();
            var seriesEpisodeID = $('#series_episode select[name="tmdb_series_episode"]').val();
            var seriesID = $('#series_id select[name="series_list"]').val();

            fetchEpisodesData(seriesSeasonID,seriesEpisodeID,seriesID);
        });
        function fetchEpisodesData(seriesSeasonID,seriesEpisodeID,seriesID){
            $('#series_episode button').addClass('is-loading');
            $.ajax({
                url: 'get_series/'+seriesID+'/'+seriesSeasonID+'/'+seriesEpisodeID,
                type: 'get',
                dataType: 'json',
                success: function(data){
                    //title
                    $('input[name="episode_name"]').val(data['name']);
                    //desc
                    $('textarea[name="episode_description"]').val(data['overview']);
                    //Air Date
                    $('input[name="episode_airdate"]').val(data['air_date']);

                    //Backdrop Image
                    if (data['still_path'] == null) {
                        var episode_image = '{{ URL::asset('public/backend/images/default_backdrop.jpg') }}';
                    }else{
                        var episode_image = 'https://image.tmdb.org/t/p/w1280'+data['still_path'];
                    }
                    //Backdrop Image
                    $('input[name="episode_image_url"]')
                    .val(episode_image);
                    $('#episode_image')[0].src  = episode_image;

                    $('#series_episode button').removeClass('is-loading');
                }
            });
        }
        //Fetch End

        //On Form Submit Check Episode already added!
        $(":submit").click(function () {
            var seriesSeasonID = $('#series_seasons select[name="tmdb_series_seasons"]').val();
            var seriesEpisodeID = $('#series_episode select[name="tmdb_series_episode"]').val();
            var seriesID = $('#series_id select[name="series_list"]').val();
            var seriesSeasonID1 = $('#series_seasons input[name="series_seasons"]').val();
            var seriesEpisodeID1 = $('#series_episode input[name="series_episode"]').val();
            if(!seriesSeasonID){
                $('input[name="episode_unique_id"]').val(seriesID+seriesSeasonID1+seriesEpisodeID1);
            }else{
                $('input[name="episode_unique_id"]').val(seriesID+seriesSeasonID+seriesEpisodeID);
            }
        });

    });

    //Image Upload
    $(function () {
        $('.field.image button').click(function() {
            $(this).siblings('input[type="file"]')
            .click()
        });

        $('form.episodes input[type="file"]').on('change', function() {
            var file    = $(this)[0].files[0];
            var reader  = new FileReader();
            var This    = $(this);

            if(/^image\/(jpeg|jpg|ico|png|svg)$/.test(file.type))
            {
                reader.addEventListener("load", function()
                {
                    This.siblings('img')
                    .attr('src', reader.result);
                }, false);

                if(file)
                    reader.readAsDataURL(file);
            }
            else
            {
                $(this).val('');
            }

            $('input[name="episode_image_url"]')
                .val('');
        });
    });

    //Players and Download
    $(document).ready(function(){
        //Player Adding
        var player = 2;
        $("#addPlayer").click(function(){
            if(player>6){
                alert("Only 6 players are allowed!");
                return false;
            }
            var newPlayerDiv = $(document.createElement('div'))
             .attr("class", 'control player'+player).attr("id", 'player'+player);

            newPlayerDiv.after().html('<div class="columns"><div class="column is-one-fifth"><div class="select is-primary"><select name="episode_player_type[]"><option>Select Options</option><option value="embeded">Embeded</option><option value="direct">Direct Link</option><option value="stream">Stream</option></select></div></div><div class="column is-one-fifth"><input name="episode_player_name[]" class="input is-primary is-one-quarter" type="text" placeholder="Player Name.."></div><div class="column"><input name="episode_player_url[]" class="input is-primary" type="text" placeholder="Player Url.."></div></div>');

            newPlayerDiv.appendTo("#players");
            player++;
        });

        $("#removePlayer").click(function(){
            if(player==2){
                alert("No more player to remove");
                return false;
            }
            player--;
            $("#player" + player).remove();
        });

        //Download Adding
        var download = 2;
        $("#addDownload").click(function(){
            if(download>6){
                alert("Only 6 downloads are allowed!");
                return false;
            }
            var newDownloadDiv = $(document.createElement('div'))
             .attr("class", 'control download'+download).attr("id", 'download'+download);

            newDownloadDiv.after().html('<div class="columns"><div class="column is-one-quarter"><input name="episode_download_name[]" class="input is-primary is-one-quarter" type="text" placeholder="Download Name.."></div><div class="column"><input name="episode_download_url[]" class="input is-primary" type="text" placeholder="Download Embed Url.."></div></div>');

            newDownloadDiv.appendTo("#downloads");
            download++;
        });

        $("#removeDownload").click(function(){
            if(download==2){
                alert("No more download to remove");
                return false;
            }
            download--;
            $("#download" + download).remove();
        });
    });
</script>
@endsection
