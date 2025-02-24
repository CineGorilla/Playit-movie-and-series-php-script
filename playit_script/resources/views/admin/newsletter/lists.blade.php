@extends('admin.layouts.master')
@section('content')

<!-- Newsletter Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Newsletter</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>List Subscribers</span></li>
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
                        @can('newsletters_send')
                        <a class="button is-success float-right" href="/admin/newsletter/send">Send</a>
                        @endcan
                    </div>
                	<div class="table-responsive">
                        <table class="table">
                            <thead class="bg-danger">
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-center">Country</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@if(!$data->isEmpty())
                                    @foreach($data as $subscribers)
                                    	<tr>
                                    		<td>{{ $subscribers->email }}</td>
                                    		<td>{{ $subscribers->country }}</td>
                                    		<td>{{ $subscribers->created_at }}</td>
                                    	</tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="9" class="text-center">We can't find any subscribers!</td></tr>
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
<script>

</script>
<script type="text/javascript">

</script>
@endsection
