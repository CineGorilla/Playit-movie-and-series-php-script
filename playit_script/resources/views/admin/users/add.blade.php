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
                    <li><span>Add Users</span></li>
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
    {!! Form::open(['route' => 'save_users','method'=>'post','class' => 'form users']) !!}
        <div class="columns" style="margin-top : 5px;">
            <div class="column">
                <div class="field">
                    <label><h4>Full Name</h4></label>
                    <div class="control">
                        <input name="user_fullname" class="input is-primary is-fullwidth" type="text" placeholder="Full Name.." value="">
                    </div>
                </div>
                <div class="field">
                    <label><h4>Password</h4></label>
                    <div class="control">
                        <input name="user_password" class="input is-primary is-fullwidth" type="password" placeholder="Password.." value="">
                    </div>
                </div>
                <div class="field">
                    <label><h4>Email</h4></label>
                    <div class="control">
                        <input name="user_email" class="input is-primary is-fullwidth" type="email" placeholder="Email.." value="">
                    </div>
                </div>
                <div class="field">
                    <label><h4>Role</h4></label>
                    <div class="control">
                        <select id="role" type="text" name="user_role"  placeholder="Role.." ></select>
                    </div>
                </div>
            </div>
        </div>
        <div class="field is-grouped is-pulled-right">
            <div class="control">
                <button type="submit" class="button is-primary is-normal">Add User</button>
            </div>
            <div class="control">
                <a href="/admin/users" class="button is-danger is-normal" style="color:white;">Cancel</a>
            </div>
        </div>
    {!! Form::close() !!}

</div>
@endsection

@section('js')
<script type="text/javascript">
    //Roles
    $(document).ready(function(){
        //Role
        var $roles = $('#role').selectize({
            create: false
        });
        var role = $roles[0].selectize;
        role.addOption({ value: 'administrators', text: 'Administrator' });
        role.addOption({ value: 'moderators', text: 'Moderator' });
        role.addOption({ value: 'authors', text: 'Author' });
        role.addOption({ value: 'members', text: 'Member' });
        role.addItem(0);

    });

</script>
@endsection
