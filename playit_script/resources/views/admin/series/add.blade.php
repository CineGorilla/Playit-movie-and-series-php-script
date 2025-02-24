@extends('admin.layouts.master')
@section('content')

<!-- Page Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Series</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Add Series</span></li>
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

    {!! Form::open(['route' => 'save_series','method'=>'post','enctype' => 'multipart/form-data', 'class' => 'form series']) !!}

        <div class="columns" style="margin-top : 5px;">
            <div class="column is-one-quarter">
                <div class="field" id="tmdb">
                    <label><h4>TMDB ID</h4></label>
                    <div class="control">
                        <input class="input is-primary" type="text" name="series_id"placeholder="TMDB ID" val="">
                    </div>
                    <button type="button" class="button is-small is-fullwidth is-primary">Generate</button>
                </div>
                <div class="field image">
                    <img src="{{ asset('public/backend/images/default_poster.jpg') }}" alt="poster image" id="series_poster">
                    <input type="hidden" name="series_poster_url" value="">
                    <input type="file" accept="image/*" name="series_poster" class="d-none">
                    <button type="button" class="button is-small is-fullwidth">Select Poster</button>
                </div>
                <div class="field image">
                    <img src="{{ asset('public/backend/images/default_backdrop.jpg') }}" alt="backdrop image" id="series_image">
                    <input type="hidden" name="series_image_url" value="">
                    <input type="file" accept="image/*" name="series_image" class="d-none">
                    <button type="button" class="button is-small is-fullwidth">Select Backdrop</button>
                </div>
                <div class="field">
                    <label><h4>Genre</h4></label>
                    <div class="control">
                        <div class="select is-multiple is-primary is-fullwidth">
                            <input id="series_genres" name="series_genres" type="text" value="" placeholder="Select Genre.." >
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label><h4>Episode Runtime</h4><p>(in min)</p></label>
                    <div class="control">
                        <input name="series_duration" class="input is-primary is-fullwidth" type="text" placeholder="Duration">
                    </div>
                </div>
                <div class="field">
                    <label><h4>Quality</h4></label>
                    <div class="control">
                        <input id="quality" type="text" name="series_quality" value="" placeholder="Quality.." >
                    </div>
                </div>
                <div class="field">
                    <label><h4>Rating</h4></label>
                    <div class="control">
                        <input name="series_rating" class="input is-primary is-fullwidth" type="text" placeholder="Rating">
                    </div>
                </div>
                <div class="field">
                    <label><h4>First Release Date</h4><p>(YYYY-MM-DD)</p></label>
                    <div class="control">
                        <input name="series_release_date" class="input is-primary is-fullwidth" type="text" placeholder="Release Date">
                    </div>
                </div>
                <div class="field">
                    <label><h4>Country</h4></label>
                    <div class="control has-icons-left">
                        <div class="select is-multiple is-primary is-fullwidth">
                            <input id="series_countries" name="series_countries" type="text" value="" placeholder="Select Country.." >
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="field">
                    <label><h4>Name</h4></label>
                    <div class="control">
                        <input name="series_name" class="input is-primary is-fullwidth" type="text" placeholder="Name" val="">
                    </div>
                </div>
                <div class="field">
                    <label><h4>Tagline</h4></label>
                    <div class="control">
                        <input name="series_tagline" class="input is-primary is-fullwidth" type="text" placeholder="tagline..." val="">
                    </div>
                </div>
                <div class="field">
                    <label><h4>Description</h4></label>
                    <div class="control">
                        <textarea name="series_description" class="textarea is-primary is-fullwidth" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="field">
                    <label><h4>Keywords</h4></label>
                    <div class="control">
                        <input id="keywords" type="text" name="series_keywords"  placeholder="Keywords.." >
                    </div>
                </div>
                <div class="field">
                    <label><h4>Actors</h4></label>
                    <div class="control">
                        <input id="actors" type="text" name="series_actors"  placeholder="Actors.." >
                    </div>
                </div>
                <div class="field">
                    <label><h4>Directors</h4></label>
                    <div class="control">
                        <input id="directors" type="text" name="series_directors"  value="" placeholder="Directors.." >
                    </div>
                </div>
                <div class="field">
                    <label><h4>Creators</h4></label>
                    <div class="control">
                        <input id="creators" type="text" name="series_creators"  value="" placeholder="Creators.." >
                    </div>
                </div>
                <div class="field">
                    <label><h4>Trailer</h4></label>
                    <div class="control">
                        <input name="series_trailer" class="input is-primary is-fullwidth" type="text" placeholder="Trailer Url..">
                    </div>
                </div>
            </div>
        </div>
        <div class="field is-grouped is-pulled-right">
            <div class="control">
                <button type="submit" class="button is-primary is-normal">Publish</button>
            </div>
            <div class="control">
                <a href="/admin/series" class="button is-danger is-normal" style="color:white;">Cancel</a>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@endsection

@section('js')
<script type="text/javascript">
    //Fetch TMDB Series
    $(document).ready(function(){
        // Search by seriesID
        $('#tmdb button').click(function(){
          var seriesID = $('#tmdb input[name="series_id"]').val();
            if(seriesID > 0){
                fetchRecords(seriesID);
            }else{
                alert('Series id should not be null or invalid!');
            }
        });
        //actors
        var $actors = $('#actors').selectize({
            delimiter: ',',
            persist: false,
            create: true
        });
        var actor = $actors[0].selectize;
        actor.setMaxItems(20);
        $.getJSON('../data/get_actors', function(actorsData) {
            $.each(actorsData, function(val, key) {
                actor.addOption({ value: key.name, text: key.name });
            }); 
        });
        //creators
        var $creators = $('#creators').selectize({
            delimiter: ',',
            persist: false,
            create: true
        });
        var creator = $creators[0].selectize;
        creator.setMaxItems(20);
        $.getJSON('../data/get_creators', function(creatorsData) {
            $.each(creatorsData, function(val, key) {
                creator.addOption({ value: key.name, text: key.name });
            }); 
        });
        //directors
        var $directors = $('#directors').selectize({
            delimiter: ',',
            persist: false,
            create: true
        });
        var director = $directors[0].selectize;
        director.setMaxItems(20);
        $.getJSON('../data/get_directors', function(directorsData) {
            $.each(directorsData, function(val, key) {
                director.addOption({ value: key.name, text: key.name });
            }); 
        });
        //keywords
        var $keywords = $('#keywords').selectize({
            delimiter: ',',
            persist: false,
            create: true
        });
        var keyword = $keywords[0].selectize;
        keyword.setMaxItems(20);
        $.getJSON('../data/get_keywords', function(keywordsData) {
            $.each(keywordsData, function(val, key) {
                keyword.addOption({ value: key.name, text: key.name });
            }); 
        });
        //countries
        var $countries = $('#series_countries').selectize({
            delimiter: ',',
            persist: false,
            create: false
        });
        var country = $countries[0].selectize;
        $.getJSON('../data/get_countries', function(countriesData) {
            $.each(countriesData, function(val, key) {
                country.addOption({ value: key.name, text: key.name });
            }); 
        });
        
        //genres
        var $genres = $('#series_genres').selectize({
            delimiter: ',',
            persist: false,
            create: false
        });
        var genre = $genres[0].selectize;
        $.getJSON('../data/get_genres', function(genresData) {
            $.each(genresData, function(val, key) {
                genre.addOption({ value: key.id, text: key.name });
            }); 
        });

        //quality
        var $qualitys = $('#quality').selectize({
            delimiter: ',',
            persist: false,
            create: true
        });
        var quality = $qualitys[0].selectize;
        quality.setMaxItems(20);
        $.getJSON('../data/get_quality', function(qualityData) {
            $.each(qualityData, function(val, key) {
                quality.addOption({ value: key.name, text: key.name });
            }); 
        });
        //Fetch Function
        function fetchRecords(id){
            $('#tmdb button').addClass('is-loading');
            $.ajax({
                url: 'get_series_data/'+id,
                type: 'get',
                dataType: 'json',
                success: function(data) {
                    if(data['name'] === undefined){
                        $('#tmdb button').removeClass('is-loading');
                        //not valid series id!
                        alert(data['status_message']);
                    }
                    else{
                        //Add to field
                        $('input[name="series_id"]').val(id);
                        //Tagline
                        $('input[name="series_tagline"]').val(data['tagline']);
                        //title
                        $('input[name="series_name"]').val(data['name']);
                        //desc
                        $('textarea[name="series_description"]')
                        .val(data['overview']);
                        //series rating
                        $('input[name="series_rating"]')
                        .val(data['vote_average']);
                        //series release date
                        $('input[name="series_release_date"]')
                        .val(data['first_air_date']);
                        //series duration
                        $('input[name="series_duration"]')
                        .val(data['episode_run_time'][0]);
                        //Poster Image
                        if (data['poster_path'] == null) {
                            var series_poster = '{{ URL::asset('public/backend/images/default_poster.jpg') }}';
                        }else{
                            var series_poster = 'https://image.tmdb.org/t/p/w500'+data['poster_path'];
                        }
                        //Backdrop Image
                        if (data['backdrop_path'] == null) {
                            var series_image = '{{ URL::asset('public/backend/images/default_backdrop.jpg') }}';
                        }else{
                            var series_image = 'https://image.tmdb.org/t/p/w1280'+data['backdrop_path'];
                        }
                        //Poster Image
                        $('input[name="series_poster_url"]')
                        .val(series_poster);
                        //Backdrop Image
                        $('input[name="series_image_url"]')
                        .val(series_image);
                        //Poster Image //Backdrop Image
                        $('#series_image')[0].src  = series_image;
                        $('#series_poster')[0].src = series_poster;
                        //Trailer
                        var videoid;
                        $.each(data.video, function(val, key) {
                            if(key.site =='YouTube'){
                                //video.push(key.key);
                                videoid = key.key;
                            }
                        });
                        if(videoid == undefined){
                            $('input[name="series_trailer"]')
                            .val('');
                        }else{
                            $('input[name="series_trailer"]')
                            .val('https://www.youtube.com/embed/'+videoid);
                        }
                        //series actors
                        actor.clear();
                        $.each(data.cast, function(val, key) {
                            if (key.known_for_department == 'Acting') {
                                actor.addOption({ value: key.name, text: key.name });
                                actor.addItem(key.name);
                                if(val==19) return false;
                            }
                        });
                        //series directors
                        director.clear();
                        $.each(data.crew, function(val, key) {
                            if (key.known_for_department == 'Directing') {
                                director.addOption({ value: key.name, text: key.name });
                                director.addItem(key.name);
                                if(val==19) return false;
                            }
                        });
                        //series creators
                        creator.clear();
                        $.each(data.crew, function(val, key) {
                            if (key.known_for_department == 'Writing') {
                                creator.addOption({ value: key.name, text: key.name });
                                creator.addItem(key.name);
                                if(val==19) return false;
                            }
                        });
                        //series keywords
                        keyword.clear();
                        $.each(data.results, function(val, key) {
                            keyword.addOption({ value: key.name, text: key.name });
                            keyword.addItem(key.name);
                            if(val==19) return false; 
                        });
                        //Countries
                        country.clear();
                        $.each(data.production_countries, function(val, key) {
                            country.addItem(key.name);
                        }); 
                        //Genres
                        genre.clear();
                        $.each(data.genres, function(val, key) {

                            if(key.id == 10759){
                                genre.addItem(28);
                                genre.addItem(12);
                            }else if(key.id == 10765){
                                genre.addItem(14);
                                genre.addItem(878);
                            }else{
                                genre.addItem(key.id);
                            }
                            
                        });
                        $('#tmdb button').removeClass('is-loading');
                    }
                },
                error: function (request, status, error) {
                    $('#tmdb button').removeClass('is-loading');
                    alert(status + ", " + error);
                }
            });
        }
    });   

    //Image Upload
    $(function () {
        $('.field.image button').click(function() {
            $(this).siblings('input[type="file"]')
            .click()
        });

        $('form.series input[type="file"]').on('change', function() {
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

            $('input[name="series_poster_url"]')
                .val('');

            $('input[name="series_image_url"]')
                .val('');
        });

    });  
</script>
@endsection