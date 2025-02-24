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
                    <li><span>Lists Episodes</span></li>
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
                        @can('episodes_update')
                        <a class="button is-success" id="edit" disabled>Edit</a>
                        @endcan
                        @can('episodes_delete')
                        <a class="button is-danger" id="delete" disabled>Delete</a>
                        @endcan
                        @can('episodes_add')
                        <a class="button is-success float-right" href="/admin/episodes/add">Add Episode</a>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-danger">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th scope="col">Series</th>
                                    <th scope="col" class="text-center">Season</th>
                                    <th scope="col" class="text-center">Episode</th>
                                    <th scope="col">Episode Name</th>
                                    <th scope="col" class="text-center">View</th>
                                    <th scope="col" class="text-center">EP. Air Date</th>
                                    <th scope="col" class="text-center">Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$data->isEmpty())
                                    @foreach($data as $episodes)
                                    <tr>
                                        <td class="text-center">
                                            <div class="basic checkbox">
                                                <input type="checkbox" value="{{ $episodes->id  }}" class="hidden" tabindex="0">
                                            </div>
                                        </td>
                                        <td>{{ $episodes->series->name }}</td>
                                        <td class="text-center">{{ $episodes->season_id }}</td>
                                        <td class="text-center">{{ $episodes->episode_id }}</td>
                                        <td>{{ $episodes->name }}</td>
                                        <td class="text-center">{{ $episodes->views }}</td>
                                        <td class="text-center">{{ $episodes->air_date }}</td>
                                        <td class="text-center"><button class="button">Read All</button></td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="9" class="text-center">We can't find any epsiodes!</td></tr>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9">
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
            var checkedBox      = $('.basic.checkbox input:checked');
            var editCondition   = checkedBox.length === 1;
            var deleteCondition = checkedBox.length > 0;
            var postId          = editCondition ? checkedBox.val() : '' ;
            var seriesIds       = [];
            var token = $('input[name="_token"]').val();
            document.getElementById('edit').toggleAttribute("disabled", !editCondition);
            document.getElementById('delete').toggleAttribute("disabled", !deleteCondition);

            $('#edit')[0].href =  '/admin/episodes/edit/' + postId;

            checkedBox.each(function() {
                seriesIds.push(parseInt($(this).val()));
            })

            seriesIds = seriesIds.length ? JSON.stringify(seriesIds) : '';
            $('#delete')[0].href = '/admin/episodes/delete/' + seriesIds;
        });

    })
</script>
@endsection
