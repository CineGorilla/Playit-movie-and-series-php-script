@extends('admin.layouts.master')
@section('content')

<!-- Comments Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Comments</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Lists Comments</span></li>
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
                        @can('comments_delete')
                        <a class="button is-danger" id="delete" disabled>Delete</a>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="bg-danger">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th scope="col">Movies/Series</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Comments</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col" class="text-center">Approve</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$data->isEmpty())
                                    @foreach($data as $comments)
                                        <tr>
                                            <td class="text-center">
                                                <div class="basic checkbox">
                                                    <input type="checkbox" value="{{ $comments->id  }}" class="hidden" tabindex="0">
                                                </div>
                                            </td>
                                            <td>
                                                @if($comments->type == 1)
                                                    Movie
                                                @elseif($comments->type == 0)
                                                    Series
                                                @else
                                                    Episode
                                                @endif
                                            </td>
                                            <td>{{ $comments->title }}</td>
                                            <td>{{ $comments->user_name }}</td>
                                            <td class="comments"><button class="button read" data-id="{{ $comments->id }}">Read</button></td>
                                            <td>{{ $comments->created_at }}</td>
                                            <td class="text-center">
                                                <label class="approve checkbox">
                                                    <input value="{{ $comments->id }}" type="checkbox" @if($comments->approve == 1) checked @endif>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="6" class="text-center">We can't find any comments!</td></tr>
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

<div id="comment-model" class="modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <div class="modal-card">
            <section class="modal-card-body">
              <!-- Content ... -->
            </section>
        </div>
    </div>
    <button id="modal-close" class="modal-close"></button>
</div>
@endsection

@section('js')
<script>
    var commentsTexts = {
        @foreach($data as $i=>$row)
            "{{$row->id}}" : "{{ $row->comment }}",
        @endforeach
    }
</script>
<script type="text/javascript">
    $(function() {
        //Edit Delete Checkbox
        $('.basic.checkbox input').on('change', function() {
            var checkedBox      = $('.basic.checkbox input:checked');
            var editCondition   = checkedBox.length === 1;
            var deleteCondition = checkedBox.length > 0;
            var postId          = editCondition ? checkedBox.val() : '' ;
            var commentsIds       = [];
            var token = $('input[name="_token"]').val();
            document.getElementById('delete').toggleAttribute("disabled", !deleteCondition);

            checkedBox.each(function() {
                commentsIds.push(parseInt($(this).val()));
            })

            commentsIds = commentsIds.length ? JSON.stringify(commentsIds) : '';
            $('#delete')[0].href = '/admin/comments/delete/' + commentsIds;
        });

        //Comments Approve
        $('.approve.checkbox input').on('change', function() {
            var approve     = $(this).prop('checked') ? 1 : 0;
            var id      = parseInt($(this).val());

            if(/^(0|1)$/.test(approve) && /^(\d+)$/.test(id))
            {
                var _token = $('input[name="_token"]').val();
                var data        = {'id': id, 'approve': approve, '_token' : _token};
                var ajaxReqUrl  = '/admin/comments/approve';

                $.post(ajaxReqUrl, data);
            }
        });

        //Comments
        $('.comments .read').on('click', function() {
            var commentText = commentsTexts[$(this).data('id')];
            $('#comment-model').toggleClass('is-active')
            $('.modal-card .modal-card-body').html(commentText).parent();
        });

        $('.modal-close').on('click', function() {
            $('#comment-model').removeClass('is-active');
        });

    })
</script>
@endsection
