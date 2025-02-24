@extends('admin.layouts.master')
@section('content')

<!-- Users Title -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Users</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/admin">Admin</a></li>
                    <li><span>Lists Users</span></li>
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
                        @can('users_update')
                        <a class="button is-success" id="edit" disabled>Edit</a>
                        @endcan
                        @can('users_delete')
                        <a class="button is-danger" id="delete" disabled>Delete</a>
                        @endcan
                        @can('users_add')
                        <a class="button is-success float-right" href="/admin/users/add">Add User</a>
                        @endcan
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created at</th>
                                    @can('users_update')
                                    <th scope="col" class="text-center">Blocked</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$data->isEmpty())
                                    @foreach($data as $users)
                                        <tr>
                                            <td class="text-center">
                                                <div class="basic checkbox">
                                                    <input type="checkbox" value="{{ $users->id  }}" class="hidden" @if($users->id == 1) disabled @endif tabindex="0">
                                                </div>
                                            </td>
                                            <td>{{ $users->name }}</td>
                                            <td>{{ $users->email }}</td>
                                            <td >
                                                @if($users->role == 'administrators')
                                                    <span class="tag is-primary is-light">Admin</span>
                                                @elseif($users->role == 'moderators')
                                                    <span class="tag is-primary is-light">Moderator</span>
                                                @elseif($users->role == 'authors')
                                                    <span class="tag is-primary is-light">Author</span>
                                                @else
                                                    <span class="tag is-primary is-light">Member</span>
                                                @endif
                                            </td>
                                            <td>{{ $users->created_at }}</td>
                                            @can('users_update')
                                            <td class="text-center">
                                                <label class="block checkbox">
                                                    <input value="{{ $users->id  }}" type="checkbox" @if($users->blocked == 1) checked @endif @if($users->id == 1) disabled @endif>
                                                </label>
                                            </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="6" class="text-center">We can't find any users!</td></tr>
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

            $('#edit')[0].href =  '/admin/users/edit/' + postId;

            checkedBox.each(function() {
                pagesIds.push(parseInt($(this).val()));
            })

            pagesIds = pagesIds.length ? JSON.stringify(pagesIds) : '';
            $('#delete')[0].href = '/admin/users/delete/' + pagesIds;
        });

        //User Block
        $('.block.checkbox input').on('change', function() {
            var block     = $(this).prop('checked') ? 1 : 0;
            var id      = parseInt($(this).val());

            if(/^(0|1)$/.test(block) && /^(\d+)$/.test(id))
            {
                var _token = $('input[name="_token"]').val();
                var data        = {'id': id, 'block': block, '_token' : _token};
                var ajaxReqUrl  = '/admin/users/block';

                $.post(ajaxReqUrl, data);
            }
        });
    })
</script>
@endsection
