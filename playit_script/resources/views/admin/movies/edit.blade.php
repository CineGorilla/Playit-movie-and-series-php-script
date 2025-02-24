@extends('admin.layouts.master')
@section('content')

<!-- Page Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Movies</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Edit Movies</span></li>
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

{!! Form::model($movies, ['route' => ['update_movie',$movies->id],'method'=>'put','enctype' => 'multipart/form-data', 'class' => 'form movie']) !!}

	<div class="columns" style="margin-top : 5px;">
	  	<div class="column is-one-quarter">
	    	<div class="field" id="tmdb">
	    		<label><h4>TMDB ID</h4></label>
			  	<div class="control">
			    	<input class="input is-primary" type="text" name="movie_id" placeholder="TMDB ID" value="{{ $movies->tmdb_id }}">
			  	</div>
			  	<button type="button" class="button is-small is-fullwidth is-primary">Generate</button>
			</div>
			<div class="field image">
                <img src="{{ $movies->poster }}" alt="poster image" id="movie_poster">
                <input type="hidden" name="movie_poster_url" value="{{ $movies->poster }}">
				<input type="file" accept="image/*" name="movie_poster" class="d-none">
                <button type="button" class="button is-small is-fullwidth">Select Poster</button>
            </div>
            <div class="field image">
                <img src="{{ $movies->backdrop }}" alt="backdrop image" id="movie_image">
                <input type="hidden" name="movie_image_url" value="{{ $movies->backdrop }}">
				<input type="file" accept="image/*" name="movie_image" class="d-none">
                <button type="button" class="button is-small is-fullwidth">Select Backdrop</button>
            </div>
			<div class="field">
	    		<label><h4>Genre</h4></label>
			  	<div class="control">
				    <div class="select is-multiple is-primary is-fullwidth">
				    	<input id="movie_genres" name="movie_genres" type="text" value="" placeholder="Select Genre.." >
				    </div>
				</div>
			</div>
			<div class="field">
	    		<label><h4>Duration (in min)</h4></label>
			  	<div class="control">
				    <input name="movie_duration" value="{{ $movies->duration }}" class="input is-primary is-fullwidth" type="text" placeholder="Duration">
				</div>
			</div>
			<div class="field">
	    		<label><h4>Quality</h4></label>
			  	<div class="control">
				    <input id="quality" type="text" name="movie_quality" placeholder="Quality.." >
				</div>
			</div>
			<div class="field">
	    		<label><h4>Rating</h4></label>
			  	<div class="control">
				    <input name="movie_rating" class="input is-primary is-fullwidth" type="text" placeholder="Rating" value="{{ $movies->rating }}">
				</div>
			</div>
			<div class="field">
	    		<label><h4>Release Date (YYYY-MM-DD)</h4></label>
			  	<div class="control">
				    <input name="movie_release_date" class="input is-primary is-fullwidth" type="text" placeholder="Release Date" value="{{ $movies->release_date }}">
				</div>
			</div>
			<div class="field">
	    		<label><h4>Country</h4></label>
			  	<div class="control has-icons-left">
				    <div class="select is-multiple is-primary is-fullwidth">
				    	<input id="movie_countries" name="movie_countries" type="text" value="" placeholder="Select Country.." >
				    </div>
				</div>
			</div>
	  	</div>
	  	<div class="column">
	  		<div class="field">
	    		<label><h4>Name</h4></label>
			  	<div class="control">
				    <input name="movie_name" class="input is-primary is-fullwidth" type="text" placeholder="Name" value="{{ $movies->name }}">
				</div>
			</div>
			<div class="field">
	    		<label><h4>Tagline</h4></label>
			  	<div class="control">
				    <input name="movie_tagline" class="input is-primary is-fullwidth" type="text" placeholder="tagline..." value="{{ $movies->tagline }}">
				</div>
			</div>
			<div class="field">
	    		<label><h4>Description</h4></label>
				<div class="control">
				    <textarea name="movie_description" class="textarea is-primary is-fullwidth" placeholder="Description">{{ $movies->description }}</textarea>
				</div>
			</div>
			<div class="field">
	    		<label><h4>Keywords</h4></label>
			  	<div class="control">
				    <input id="keywords" type="text" name="movie_keywords"  placeholder="Keywords.." >
				</div>
			</div>
			<div class="field">
	    		<label><h4>Actors</h4></label>
			  	<div class="control">
				    <input id="actors" type="text" name="movie_actors"  placeholder="Actors.." >
				</div>
			</div>
			<div class="field">
	    		<label><h4>Directors</h4></label>
			  	<div class="control">
				    <input id="directors" type="text" name="movie_directors"  value="" placeholder="Directors.." >
				</div>
			</div>
			<div class="field">
	    		<label><h4>Creators</h4></label>
			  	<div class="control">
				    <input id="creators" type="text" name="movie_creators"  value="" placeholder="Creators.." >
				</div>
			</div>
			<div class="field">
	    		<label><h4>Trailer</h4></label>
			  	<div class="control">
				    <input name="movie_trailer" class="input is-primary is-fullwidth" type="text" placeholder="Trailer Url.." value="{{ $movies->trailer }}">
				</div>
			</div>
			<div class="field" id="players">
	    		<label><h4>Players</h4></label>

				@if(isset($player))
				<?php $i = 1; ?>

                    @foreach($player['type'] as $key => $value)

					<div class="control player<?php echo $i; ?>" id="player<?php echo $i; ?>" >
						<div class="columns">
                            @if($value == 'direct')
                            <div class="column is-one-fifth">
                                <div class="select is-primary">
                                    <select name="movie_player_type[]">
                                        <option>Select Options</option>
                                        <option value="embeded">Embeded</option>
                                        <option selected value="direct">Direct Link</option>
                                        <option value="stream">Stream</option>
                                    </select>
                                </div>
                            </div>
                            @elseif($value == 'stream')
                            <div class="column is-one-fifth">
                                <div class="select is-primary">
                                    <select name="movie_player_type[]">
                                        <option>Select Options</option>
                                        <option value="embeded">Embeded</option>
                                        <option value="direct">Direct Link</option>
                                        <option selected value="stream">Stream</option>
                                    </select>
                                </div>
                            </div>
                            @elseif($value == 'embeded')
                            <div class="column is-one-fifth">
                                <div class="select is-primary">
                                    <select name="movie_player_type[]">
                                        <option>Select Options</option>
                                        <option selected value="embeded">Embeded</option>
                                        <option value="direct">Direct Link</option>
                                        <option value="stream">Stream</option>
                                    </select>
                                </div>
                            </div>
                            @else
                            <div class="column is-one-fifth">
                                <div class="select is-primary">
                                    <select name="movie_player_type[]">
                                        <option selected >Select Options</option>
                                        <option value="embeded">Embeded</option>
                                        <option value="direct">Direct Link</option>
                                        <option value="stream">Stream</option>
                                    </select>
                                </div>
                            </div>
                            @endif
							<div class="column is-one-fifth">
								<input name="movie_player_name[]" class="input is-primary is-one-quarter" type="text" placeholder="Player Name.." value="{{$player['name'][$key]}}">
							</div>
							<div class="column">
								<input name="movie_player_url[]" class="input is-primary" type="text" placeholder="Player Url.." value="{{$player['url'][$key]}}">
							</div>
						</div>
					</div>

					<?php $i++; ?>
					@endforeach

					<input id="playervalue" type="hidden" value="<?php echo $i; ?>">
				@else
				<div class="control player1">
					<div class="columns">
						<div class="column is-one-fifth">
                            <div class="select is-primary">
                                <select name="movie_player_type[]">
                                    <option>Select Options</option>
                                    <option value="embeded">Embeded</option>
                                    <option value="direct">Direct Link</option>
                                    <option value="stream">Stream</option>
                                </select>
                            </div>
                        </div>
                        <div class="column is-one-fifth">
                            <input name="movie_player_name[]" class="input is-primary is-one-quarter" type="text" placeholder="Player Name..">
                        </div>
                        <div class="column">
                            <input name="movie_player_url[]" class="input is-primary" type="text" placeholder="Player Url..">
                        </div>
					</div>
					<input id="playervalue" type="hidden" value="2">
				</div>
				@endif

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
			<div class="field" id="downloads">
	    		<label><h4>Download</h4></label>

				@if(isset($download))
				<?php $i = 1; ?>
					@foreach($download as $key => $value)
					<div class="control download<?php echo $i; ?>" id="download<?php echo $i; ?>">
					    <div class="columns">
							<div class="column is-one-quarter">
								<input name="movie_download_name[]" class="input is-primary is-one-quarter" type="text" placeholder="Download Name.." value="{{ $key }}">
							</div>
							<div class="column">
								<input name="movie_download_url[]" class="input is-primary" type="text" placeholder="Download Url.." value="{{ $value }}">
							</div>
						</div>
					</div>
					<?php $i++; ?>
					@endforeach
					<input id="downloadvalue" type="hidden" value="<?php echo $i; ?>">
				@else
					<div class="columns">
						<div class="column is-one-quarter">
							<input name="movie_download_name[]" class="input is-primary is-one-quarter" type="text" placeholder="Download Name..">
						</div>
						<div class="column">
							<input name="movie_download_url[]" class="input is-primary" type="text" placeholder="Download Url..">
						</div>
					</div>
					<input id="downloadvalue" type="hidden" value="2">
				@endif
			</div>
			<div class="columns">
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
	    	<button type="submit" class="button is-primary is-normal">Update</button>
	  	</div>
	  	<div class="control">
	    	<a href="/admin/movies" class="button is-danger is-normal" style="color:white;">Cancel</a>
	  	</div>
	</div>
{!! Form::close() !!}
</div>
@endsection

@section('js')
<script>
	var takengenres = {!! $movies->genres->pluck('id') !!};
	var takencountry = {!! $movies->countries->pluck('name') !!};
	var takenactor = {!! $movies->actors->pluck('name') !!};
	var takencreator = {!! $movies->creators->pluck('name') !!};
	var takendirector = {!! $movies->directors->pluck('name') !!};
	var takenkeyword = {!! $movies->keywords->pluck('name') !!};
	var takenquality = {!! $movies->qualities->pluck('name') !!};

</script>
<script type="text/javascript">

	//Fetch TMDB Movies
	$(document).ready(function(){
		// Search by movieID
	   	$('#tmdb button').click(function(){
	      var movieID = $('#tmdb input[name="movie_id"]').val();
		  	if(movieID > 0){
		    	fetchRecords(movieID);
	  		}else{
	  			alert('Movie id should not be null or invalid!');
	  		}
		});
		//quality
		var $qualitys = $('#quality').selectize({
		    delimiter: ',',
		    persist: false,
		    create: true
		});
		var quality = $qualitys[0].selectize;
		quality.setMaxItems(20);
		$.getJSON('/admin/data/get_quality', function(qualityData) {
			$.each(qualityData, function(val, key) {
				quality.addOption({ value: key.name, text: key.name });
			});
			$.each(takenquality, function(val, key) {
				quality.addItem(takenquality[val]);
			});
	    });
		//genres
		var $genres = $('#movie_genres').selectize({
		    delimiter: ',',
		    persist: false,
		    create: false
		});
	    var genre = $genres[0].selectize;
		$.getJSON('/admin/data/get_genres', function(genresData) {
			$.each(genresData, function(val, key) {
				genre.addOption({ value: key.id, text: key.name });
			});
			$.each(takengenres, function(val, key) {
				genre.addItem(takengenres[val]);
			});
	    });
		//countries
		var $countries = $('#movie_countries').selectize({
		    delimiter: ',',
		    persist: false,
		    create: false
		});
		var country = $countries[0].selectize;
		$.getJSON('/admin/data/get_countries', function(countriesData) {
			$.each(countriesData, function(val, key) {
				country.addOption({ value: key.name, text: key.name });
			});
			$.each(takencountry, function(val, key) {
				country.addItem(takencountry[val]);
			});
	    });
		//actors
		var $actors = $('#actors').selectize({
		    delimiter: ',',
		    persist: false,
		    create: true
		});
		var actor = $actors[0].selectize;
		actor.setMaxItems(20);
		$.getJSON('/admin/data/get_actors', function(actorsData) {
			$.each(actorsData, function(val, key) {
				actor.addOption({ value: key.name, text: key.name });
			});
			$.each(takenactor, function(val, key) {
				actor.addItem(takenactor[val]);
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
		$.getJSON('/admin/data/get_creators', function(creatorsData) {
			$.each(creatorsData, function(val, key) {
				creator.addOption({ value: key.name, text: key.name });
			});
			$.each(takencreator, function(val, key) {
				creator.addItem(takencreator[val]);
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
		$.getJSON('/admin/data/get_directors', function(directorsData) {
			$.each(directorsData, function(val, key) {
				director.addOption({ value: key.name, text: key.name });
			});
			$.each(takendirector, function(val, key) {
				director.addItem(takendirector[val]);
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
		$.getJSON('/admin/data/get_keywords', function(keywordsData) {
			$.each(keywordsData, function(val, key) {
				keyword.addOption({ value: key.name, text: key.name });
			});
			$.each(takenkeyword, function(val, key) {
				keyword.addItem(takenkeyword[val]);
			});
	    });

		//Fetch Function
	   	function fetchRecords(id){
	   		$('#tmdb button').addClass('is-loading');
	   		$.ajax({
		        url: '../get_movie_data/'+id,
		        type: 'get',
		        dataType: 'json',
		        success: function(data) {
		        	if(data['title'] === undefined){
						$('#tmdb button').removeClass('is-loading');
						//not valid movie id!
						alert(data['status_message']);
					}
					else{
					   	//Add to field
					   	$('input[name="movie_id"]').val(id);
					   	//Tagline
					   	$('input[name="movie_tagline"]').val(data['tagline']);
					   	//title
					   	$('input[name="movie_name"]').val(data['title']);
					   	//desc
					   	$('textarea[name="movie_description"]')
						.val(data['overview']);
						//movie rating
						$('input[name="movie_rating"]')
						.val(data['vote_average']);
						//movie release date
						$('input[name="movie_release_date"]')
						.val(data['release_date']);
						//movie duration
						$('input[name="movie_duration"]')
						.val(data['runtime']);
						//Poster Image
						if (data['poster_path'] == null) {
						    var movie_poster = '{{ URL::asset('public/backend/images/default_poster.jpg') }}';
						}else{
							var movie_poster = 'https://image.tmdb.org/t/p/w500'+data['poster_path'];
						}
						//Backdrop Image
						if (data['backdrop_path'] == null) {
						    var movie_image = '{{ URL::asset('public/backend/images/default_backdrop.jpg') }}';
						}else{
							var movie_image = 'https://image.tmdb.org/t/p/w1280'+data['backdrop_path'];
						}
						//Poster Image
						$('input[name="movie_poster_url"]')
						.val(movie_poster);
						//Backdrop Image
						$('input[name="movie_image_url"]')
						.val(movie_image);
						//Poster Image //Backdrop Image
						$('#movie_image')[0].src  = movie_image;
						$('#movie_poster')[0].src = movie_poster;
						//movie actors
						actor.clear();
						$.each(data.cast, function(val, key) {
				        	actor.addOption({ value: key.name, text: key.name });
				        	actor.addItem(key.name);
				        	if(val==19) return false;
						});
						//movie keywords
						keyword.clear();
						$.each(data.keywords, function(val, key) {
				        	keyword.addOption({ value: key.name, text: key.name });
				        	keyword.addItem(key.name);
				        	if(val==19) return false;
						});
						//Genres
						$.each(data.genres, function(val, key) {
				        	genre.addItem(key.id);
						});
						//Countries
						$.each(data.production_countries, function(val, key) {
				        	country.addItem(key.name);
						});
						//movie directors
						director.clear();
						$.each(data.crew, function(val, key) {
							if (key.department == 'Directing') {
				        		director.addOption({ value: key.name, text: key.name });
					        	director.addItem(key.name);
					        	if(val==19) return false;
				        	}
						});
						//movie creators
						creator.clear();
						$.each(data.crew, function(val, key) {
							if (key.department == 'Writing') {
				        		creator.addOption({ value: key.name, text: key.name });
					        	creator.addItem(key.name);
					        	if(val==19) return false;
				        	}
						});
						//Trailer
						var videoid;
						$.each(data.results, function(val, key) {
							if(key.site =='YouTube'){
								//video.push(key.key);
								videoid = key.key;
							}
						});
						if(videoid == undefined){
							$('input[name="movie_trailer"]')
							.val('');
						}else{
							$('input[name="movie_trailer"]')
							.val('https://www.youtube.com/embed/'+videoid);
						}
					   	//remove button loding class
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

	  	$('form.movie input[type="file"]').on('change', function() {
			var file    = $(this)[0].files[0];
			var reader  = new FileReader();
			var This 	= $(this);

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

			$('input[name="movie_poster_url"]')
				.val('');

			$('input[name="movie_image_url"]')
				.val('');
		});
	});

	//Players and Download
	$(document).ready(function(){
		//Player Adding
		var n1 = document.getElementById('playervalue').value;

		var player = n1;
		$("#addPlayer").click(function(){
			if(player>6){
	            alert("Only 6 players are allowed!");
	            return false;
	    	}
	    	var newPlayerDiv = $(document.createElement('div'))
	         .attr("class", 'control player'+player).attr("id", 'player'+player);

	        newPlayerDiv.after().html('<div class="columns"><div class="column is-one-fifth"><div class="select is-primary"><select name="movie_player_type[]"><option>Select Options</option><option value="embeded">Embeded</option><option value="direct">Direct Link</option><option value="stream">Stream</option></select></div></div><div class="column is-one-fifth"><input name="movie_player_name[]" class="input is-primary is-one-quarter" type="text" placeholder="Player Name.."></div><div class="column"><input name="movie_player_url[]" class="input is-primary" type="text" placeholder="Player Url.."></div></div>');

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
		//Player Adding
		var n2 = document.getElementById('downloadvalue').value;
		var download = n2;
		$("#addDownload").click(function(){
			if(download>6){
	            alert("Only 6 downloads are allowed!");
	            return false;
	    	}
	    	var newDownloadDiv = $(document.createElement('div'))
	         .attr("class", 'control download'+download).attr("id", 'download'+download);

	        newDownloadDiv.after().html('<div class="columns"><div class="column is-one-quarter"><input name="movie_download_name[]" class="input is-primary is-one-quarter" type="text" placeholder="Download Name.."></div><div class="column"><input name="movie_download_url[]" class="input is-primary" type="text" placeholder="Download Url.."></div></div>');

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
