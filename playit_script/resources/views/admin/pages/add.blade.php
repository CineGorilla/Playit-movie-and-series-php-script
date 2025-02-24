@extends('admin.layouts.master')
@section('content')

<!-- Page Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Pages</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Add Pages</span></li>
                </ul>
            </div>
        </div>
        <!-- Account -->
        @include('admin.layouts.account')
    </div>
</div>

<script src="{{ asset('public/backend/js/html5_entities.js') }}"></script>
<!-- QUILL PLUGIN -->
<link rel="stylesheet" href="{{ asset('public/backend/css/quill.snow.css') }}">
<script src="{{ asset('public/backend/js/quill.js') }}"></script>
<script src="{{ asset('public/backend/js/image-resize.min.js') }}"></script>

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
	{!! Form::open(['route' => 'save_pages','method'=>'post','enctype' => 'multipart/form-data', 'class' => 'form pages']) !!}
		<div class="columns" style="margin-top : 5px;">
			<div class="column">
				<div class="field">
		    		<label><h4>Title</h4></label>
				  	<div class="control">
					    <input name="page_title" class="input is-primary is-fullwidth" type="text" placeholder="Title.." value="">
					</div>
				</div>
				<div class="field">
		    		<label><h4>Summary</h4></label>
				  	<div class="control">
				  		<textarea name="page_summary" cols="30" rows="3" class="textarea is-primary is-fullwidth" placeholder="Summary.. (~160 chars)"></textarea>
					</div>
				</div>
				<div class="field">
		    		<label><h4>Show in</h4></label>
				  	<div class="control">
                        <input id="showin" type="text" name="page_showin"  placeholder="Show in.." >
					</div>
				</div>
				<div class="field">
		    		<label><h4>Content</h4></label>
				  	<div class="control">
				  		<textarea name="page_body" id="item_body" cols="30" class="is-hidden" rows="10" placeholder="page content..."></textarea>
				  		<!-- QUILL EDITOR -->
						<div id="quill_editor" class="is-primary"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="field is-grouped is-pulled-right">
		  	<div class="control">
		    	<button type="submit" class="button is-primary is-normal">Publish</button>
		  	</div>
		  	<div class="control">
		    	<a href="/admin/pages" class="button is-danger is-normal" style="color:white;">Cancel</a>
		  	</div>
		</div>
	{!! Form::close() !!}
</div>
@endsection

@section('js')
<script type="text/javascript">
	function b64EncodeUnicode(str) {
	    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
	        function toSolidBytes(match, p1) {
	            return String.fromCharCode('0x' + p1);
	        }));
	}

	var toolbarOptions = [
	    ['bold', 'italic', 'underline', 'strike'],
	    ['blockquote', 'code-block'],
	    ['link', 'image', 'video'],
	    [{'list': 'ordered'}, {'list': 'bullet'}],
	    [{'script': 'sub'}, {'script': 'super'}],
	    [{'indent': '-1'}, {'indent': '+1'}],
	    [{'direction': 'rtl'}],
	    [{'size': ['small', false, 'large', 'huge']}],
	    [{'header': [1, 2, 3, 4, 5, 6, false]}],
	    [{'color': []}, {'background': []}],
	    [{'font': []}, {'align': []}],
	    ['clean'],
	    ['fullscreen']
	];
	var quill = new Quill('#quill_editor', {
		modules: {
			toolbar: toolbarOptions,
			imageResize: {
	        	displaySize: true
	        }
		},
		theme: 'snow'
	});

	//Show In
    $(document).ready(function(){
    	//show In
        var $showins = $('#showin').selectize({
            delimiter: ',',
            persist: false,
            create: true
        });
        var showin = $showins[0].selectize;
        showin.addOption({ value: 1, text: 'Header' });
        showin.addOption({ value: 0, text: 'Footer' });
    });

    $('.form.pages').on('submit', function(event){
		if(quill.root.innerHTML.trim().length){
			$('#item_body').val(b64EncodeUnicode(Html5Entities.decode(quill.root.innerHTML)));
		}
	});
    	
</script>
@endsection