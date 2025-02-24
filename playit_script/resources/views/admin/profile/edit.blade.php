@extends('admin.layouts.master')
@section('content')

<!-- Page Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Profile</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Edit Profile</span></li>
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
	{!! Form::model($user, ['route' => ['save_profile',$user->id],'method'=>'put','enctype' => 'multipart/form-data', 'class' => 'form profile']) !!}
		<div class="columns profile-header" style="margin-top : 5px;">
			<div class="column" style="display: flex; align-items: center; justify-content: center;">
				<figure class="image is-128x128">
				  	<img class="is-rounded" name="user_image" src="{{ asset('/profile_img') }}{{'/'.$user->profile_img}}" style="object-fit: cover;height: 128px;">
				</figure>	
				<input type="file" name="user_image" class="is-hidden" accept="image/*">
				<input type="text" name="user_image" class="is-hidden" value="1" spellcheck="false">
				<input type="hidden" name="user_image_changed">

			</div>
		</div>
		<div class="columns" style="margin-top : 5px;">
			<div class="column">
				<div class="field">
		    		<label><h4>Full Name</h4></label>
				  	<div class="control">
					    <input name="user_name" class="input is-primary is-fullwidth" type="text" placeholder="Full Name.." value="{{ $user->name }}">
					</div>
				</div>
				<div class="field">
		    		<label><h4>Email</h4></label>
				  	<div class="control">
					    <input name="user_email" class="input is-primary is-fullwidth" type="text" placeholder="Email.." value="{{ $user->email }}">
					</div>
				</div>
				<div class="field">
		    		<label><h4>Password</h4></label>
				  	<div class="control">
					    <input name="user_password" class="input is-primary is-fullwidth" type="password" placeholder="Change password.." value="">
					</div>
				</div>
				<div class="field">
		    		<label><h4>Country</h4></label>
				  	<div class="control" id="countryvalue">
                        <select id="user_country" type="text" name="user_country"  placeholder="Select Country.." ></select>
                        <input type="hidden" name="select_country" value="{{ $user->country}}">
					</div>
				</div>
			</div>
			<div class="column">
				<div class="field">
		    		<label><h4>Facebook</h4></label>
				  	<div class="control">
					    <input name="user_facebook" class="input is-primary is-fullwidth" type="text" placeholder="Facebook.." value="{{ $user->facebook }}">
					</div>
				</div>
				<div class="field">
		    		<label><h4>Pinterest</h4></label>
				  	<div class="control">
					    <input name="user_pinterest" class="input is-primary is-fullwidth" type="text" placeholder="Pinterest.." value="{{ $user->pinterest }}">
					</div>
				</div>
				<div class="field">
		    		<label><h4>Linkedin</h4></label>
				  	<div class="control">
					    <input name="user_linkedin" class="input is-primary is-fullwidth" type="text" placeholder="Linkedin.." value="{{ $user->linkedin }}">
					</div>
				</div>
				<div class="field">
		    		<label><h4>Twitter</h4></label>
				  	<div class="control">
					    <input name="user_twitter" class="input is-primary is-fullwidth" type="text" placeholder="Twitter.." value="{{ $user->twitter }}">
					</div>
				</div>
				<div class="field">
		    		<label><h4>Youtube</h4></label>
				  	<div class="control">
					    <input name="user_youtube" class="input is-primary is-fullwidth" type="text" placeholder="Youtube.." value="{{ $user->youtube }}">
					</div>
				</div>
			</div>
		</div>
		<div class="field is-grouped is-pulled-right">
		  	<div class="control">
		    	<button type="submit" class="button is-primary is-normal">Save Profile</button>
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


	$(function() {
		$('.profile-header img, .profile-header .placeholder').on('click', function() {
			$('input[type="file"][name="user_image"]').click()
		});

		$('input[type="file"][name="user_image"]').on('change', function() {
			var file    = $(this)[0].files[0];
			var reader  = new FileReader();

			if(/^image\/(jpeg|jpg|ico|png|svg)$/.test(file.type))
			{				
				reader.addEventListener("load", function() {
					$('.profile-header img').attr('src', reader.result);
				}, false);

				if(file)
				{
					reader.readAsDataURL(file);
					$('.profile-header .image').show()
										       .siblings('.placeholder').hide();
				
					$('input[name="user_image_changed"]').val('1');
				}
			}
			else{
				$(this).val('');
			}
		});

		$('input[type="file"][name="user_image"]').on('change', function() {
			$('input[type="text"][name="user_image"]').val('');
		});


		//countries
		var selectCountry = $('#countryvalue input[name="select_country"]').val();
		var $countries = $('#user_country').selectize({
            create: false,
        });
        var country = $countries[0].selectize;
        $.getJSON('/admin/data/get_countries', function(countriesData) {
            $.each(countriesData, function(val, key) {
                country.addOption({ value: key.name, text: key.name });
                country.addItem(selectCountry);
            }); 
            
        });
	})
</script>
@endsection