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
                    <li><span>Genres Lists</span></li>
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
		        	<div class="bg-light clearfix" style="margin-bottom: 20px;">
                        @can('genres_update')
					    <a class="button is-success" id="edit" disabled>Edit</a>
                        @endcan
                        @can('genres_delete')
					  	<a class="button is-danger" id="delete" disabled>Delete</a>
                        @endcan
                        @can('genres_add')
					    <a class="button is-success float-right" href="/admin/genres/add">Add Genre</a>
                        @endcan
					</div>

		            <div class="table-responsive">
		                <table class="table">
                            <thead class="bg-danger">
                                <tr>
		                        	<th>&nbsp;</th>
		                            <th scope="col">Name</th>
		                            <th scope="col" class="text-center">Total Movies/Series</th>
		                            <th scope="col" class="text-center">Created at</th>
		                            @can('genres_delete')<th scope="col" class="text-center">Action</th>@endcan
		                        </tr>
		                    </thead>
		                    <tbody>
			                    @if(!$data->isEmpty())
				                    @foreach($data as $genre)
			                    	<tr>
			                    		<td>
			                    			<div class="basic checkbox">
												<input type="checkbox" value="{{ $genre->id  }}" class="hidden" tabindex="0">
											</div>
										</td>
			                            <td>{{ $genre->name }}</td>
			                            <td class="text-center">

			                            	Movie - {{  $genre->items()->where('type','movie')->count() }} / Series - {{$genre->items()->where('type','series')->count() }}

			                            </td>
			                            <td class="text-center">{{ $genre->created_at }}</td>
			                            @can('genres_delete')<td class="text-center"><a class="deletebtn" href="/admin/genres/delete/[{{ $genre->id  }}]"><i class="ti-trash"></i></a></td>@endcan
			                        </tr>
									@endforeach
								@else
									<tr><td colspan="5">We can't find any genres!</td></tr>
								@endif

		                    </tbody>
		                    <tfoot>
		                    	<tr>
		                    		<td colspan="5">
		                    			<div class="d-flex justify-content-left" style="margin-top: 20px;">
								            {{ $data->links('admin.layouts.pagination')  }}
								        </div>
		                    		</td>
		                    	</tr>
		                    </tfoot>
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
	$(function() {
		$('.basic.checkbox input').on('change', function() {

			var checkedBox 		= $('.basic.checkbox input:checked');
			var editCondition   = checkedBox.length === 1;
			var deleteCondition = checkedBox.length > 0;

			var postId 		    = editCondition ? checkedBox.val() : '' ;
			var moviesIds 		= [];
	        var token = $('input[name="_token"]').val();

			document.getElementById('edit').toggleAttribute("disabled", !editCondition);
			document.getElementById('delete').toggleAttribute("disabled", !deleteCondition);


			$('#edit')[0].href =  '/admin/genres/edit/' + postId;


			checkedBox.each(function() {
				moviesIds.push(parseInt($(this).val()));
			})

			moviesIds = moviesIds.length ? JSON.stringify(moviesIds) : '';
			$('#delete')[0].href = '/admin/genres/delete/' + moviesIds;


			//triggered when modal is about to be shown
			$('#my_modal').on('show.bs.modal', function(e) {

			    //get data-id attribute of the clicked element
			    var genreId = $(e.relatedTarget).data('id');

			    //populate the textbox
			    $(e.currentTarget).find('input[name="genreId"]').val(genreId);
			});

		});
	})
</script>
@endsection
