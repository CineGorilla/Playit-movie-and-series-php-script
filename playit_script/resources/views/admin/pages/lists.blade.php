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
                    <li><span>Lists Pages</span></li>
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
                        @can('pages_update')
                        <a class="button is-success" id="edit" disabled>Edit</a>
                        @endcan
                        @can('pages_delete')
                        <a class="button is-danger" id="delete" disabled>Delete</a>
                        @endcan
                        @can('pages_add')
                        <a class="button is-success float-right" href="/admin/pages/add">Add Pages</a>
                        @endcan
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-danger">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th scope="col">Title</th>
                                    <th scope="col" class="text-center">Views</th>
                                    <th scope="col" class="text-center">Show in</th>
                                    <th scope="col">Created at</th>
                                    @can('pages_update')<th scope="col" class="text-center">Visible</th>@endcan
                                </tr>
                            </thead>
                            <tbody>
                            	@if(!$data->isEmpty())
                                    @foreach($data as $pages)
                                    	<tr>
                                    		<td class="text-center">
	                                            <div class="basic checkbox">
	                                                <input type="checkbox" value="{{ $pages->id  }}" class="hidden" tabindex="0">
	                                            </div>
	                                        </td>
	                                        <td>{{ $pages->title }}</td>
	                                        <td class="text-center">{{ $pages->views }}</td>
							                <td class="text-center">
							                <?php $sho = explode(",",$pages->show_in);  ?>
											@foreach ($sho as $shw)
												@if($shw == 1)
													<span class="tag is-primary is-light">Header</span>
												@elseif($shw == 0)
													<span class="tag is-primary is-light">Footer</span>
												@endif
							                @endforeach
							            	</td>
							            	<td>{{ $pages->created_at }}</td>
                                            @can('pages_update')
							            	<td class="text-center">
	                                            <label class="visible checkbox">
	                                                <input value="{{ $pages->id  }}" type="checkbox" @if($pages->visible == 1) checked @endif>
	                                            </label>
	                                        </td>
                                            @endcan
                                    	</tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="9" class="text-center">We can't find any pages!</td></tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
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
		//Edit Delete Checkbox
		$('.basic.checkbox input').on('change', function() {
            var checkedBox      = $('.basic.checkbox input:checked');
            var editCondition   = checkedBox.length === 1;
            var deleteCondition = checkedBox.length > 0;
            var postId          = editCondition ? checkedBox.val() : '' ;
            var pagesIds       = [];
            var token = $('input[name="_token"]').val();
            document.getElementById('edit').toggleAttribute("disabled", !editCondition);
            document.getElementById('delete').toggleAttribute("disabled", !deleteCondition);

            $('#edit')[0].href =  '/admin/pages/edit/' + postId;

            checkedBox.each(function() {
                pagesIds.push(parseInt($(this).val()));
            })

            pagesIds = pagesIds.length ? JSON.stringify(pagesIds) : '';
            $('#delete')[0].href = '/admin/pages/delete/' + pagesIds;
        });

		//Page Visible
		$('.visible.checkbox input').on('change', function() {
            var visible     = $(this).prop('checked') ? 1 : 0;
            var id      = parseInt($(this).val());

            if(/^(0|1)$/.test(visible) && /^(\d+)$/.test(id))
            {
                var _token = $('input[name="_token"]').val();
                var data        = {'id': id, 'visible': visible, '_token' : _token};
                var ajaxReqUrl  = '/admin/pages/visible';

                $.post(ajaxReqUrl, data);
            }
        });
	})
</script>

@endsection
