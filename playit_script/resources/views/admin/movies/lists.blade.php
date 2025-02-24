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
                    <li><span>Movies Lists</span></li>
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
                        @can('movie_update')
                        <a class="button is-success" id="edit" disabled>Edit</a>
                        @endcan
                        @can('movie_delete')
                        <a class="button is-danger" id="delete" disabled>Delete</a>
                        @endcan
                        @can('movie_add')
                        <a class="button is-success float-right" href="/admin/movies/add">Add Movie</a>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-danger">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th colspan="2" scope="col">Name</th>
                                    <th scope="col">Genres</th>
                                    <th scope="col">Views</th>
                                    @can('movie_update')<th scope="col">Visible</th>@endcan
                                    @can('movie_update')<th scope="col">Feature</th>@endcan
                                    @can('movie_update')<th scope="col">Recommend</th>@endcan
                                    @can('comments_index')<th scope="col" class="text-center">Comments</th>@endcan
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$data->isEmpty())
                                    @foreach($data as $movie)
                                    <tr>
                                        <td class="text-center">
                                            <div class="basic checkbox">
                                                <input type="checkbox" value="{{ $movie->id  }}" class="hidden" tabindex="0">
                                            </div>
                                        </td>
                                        <td class="p-1" >
                                            <figure class="image" style="width: 50px;">
                                                <img src="{{ $movie->poster }}" >
                                            </figure>
                                        </td>
                                        <td>{{ $movie->name }}</td>
                                        <td >
                                            @foreach ($movie->genres as $singleGenre)
                                                <span class="tag is-primary is-light">{{ $singleGenre->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-center">{{ $movie->views }}</td>
                                        @can('movie_update')
                                        <td class="text-center">
                                            <label class="visible checkbox">
                                                <input value="{{ $movie->id  }}" type="checkbox" @if($movie->visible == 1) checked @endif>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="feature checkbox">
                                                <input value="{{ $movie->id  }}" type="checkbox" @if($movie->feature == 1) checked @endif>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="recommended checkbox">
                                                <input value="{{ $movie->id  }}" type="checkbox" @if($movie->recommended == 1) checked @endif>
                                            </label>
                                        </td>
                                        @endcan
                                        @can('comments_index')
                                        <td class="text-center">
                                            <a href="{{ url('/admin/comments/'.$movie->id) }}" class="button ui inverted blue button">Read All</a>
                                        </td>
                                        @endcan
                                    </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="9" class="text-center">We can't find any movies!</td></tr>
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
            var moviesIds       = [];
            var token = $('input[name="_token"]').val();

            document.getElementById('edit').toggleAttribute("disabled", !editCondition);
            document.getElementById('delete').toggleAttribute("disabled", !deleteCondition);

            $('#edit')[0].href =  '/admin/movies/edit/' + postId;

            checkedBox.each(function() {
                moviesIds.push(parseInt($(this).val()));
            })

            moviesIds = moviesIds.length ? JSON.stringify(moviesIds) : '';
            $('#delete')[0].href = '/admin/movies/delete/' + moviesIds;
        });


        $('.visible.checkbox input').on('change', function() {
            var visible     = $(this).prop('checked') ? 1 : 0;
            var id      = parseInt($(this).val());

            if(/^(0|1)$/.test(visible) && /^(\d+)$/.test(id))
            {
                var _token = $('input[name="_token"]').val();
                var data        = {'id': id, 'visible': visible, '_token' : _token};
                var ajaxReqUrl  = '/admin/movies/visible';

                $.post(ajaxReqUrl, data);
            }
        });

        $('.feature.checkbox input').on('change', function() {
            var feature     = $(this).prop('checked') ? 1 : 0;
            var id      = parseInt($(this).val());

            if(/^(0|1)$/.test(feature) && /^(\d+)$/.test(id))
            {
                var _token = $('input[name="_token"]').val();
                var data        = {'id': id, 'feature': feature, '_token' : _token};
                var ajaxReqUrl  = '/admin/movies/feature';

                $.post(ajaxReqUrl, data);
            }
        });

        $('.recommended.checkbox input').on('change', function() {
            var recommended     = $(this).prop('checked') ? 1 : 0;
            var id      = parseInt($(this).val());

            if(/^(0|1)$/.test(recommended) && /^(\d+)$/.test(id))
            {
                var _token = $('input[name="_token"]').val();
                var data        = {'id': id, 'recommended': recommended, '_token' : _token};
                var ajaxReqUrl  = '/admin/movies/recommended';

                $.post(ajaxReqUrl, data);
            }
        });

    })
</script>
@endsection
