@extends('admin.layouts.master')
@section('content')

<!-- Page Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Genres</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Add Genres</span></li>
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
                <h4 class="header-title">Add Genres</h4>
                {!! Form::open(['route' => 'save_genre','method'=>'post']) !!}
                    <div class="form-row align-items-center">
                        <div class="col-sm-3 my-1">
                            <label class="sr-only" for="inlineFormInputName">Name</label>
                            <input type="text" name="name" class="form-control" id="inlineFormInputName" placeholder="add genre..">
                        </div>
                        <div class="col-auto my-1">
                            <button class="button is-success">Add Genre</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>


@endsection

@section('js')

</script>


@endsection