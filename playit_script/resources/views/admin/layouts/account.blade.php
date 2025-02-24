<div class="col-sm-6 clearfix">
    <div class="user-profile pull-right">
        <img class="avatar user-thumb" src="/profile_img/{{ Auth::user()->profile_img }}" alt="avatar">
        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></h4>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('/admin/settings/general') }}">Settings</a>
            <a class="dropdown-item" href="{{ url('/admin/profile') }}">Edit Profile</a>
            {{-- Logout --}}
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>





