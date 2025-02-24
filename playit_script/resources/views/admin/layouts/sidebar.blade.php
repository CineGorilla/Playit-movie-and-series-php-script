<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ url('/admin') }}"><img src="{{ asset('public/setting_img') }}/{{ $general->site_logo }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    {{-- Dashboard --}}
                    <li class="{{ request()->is('admin') ? 'active' : '' }}">
                        <a href="{{ url('/admin') }}"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                    </li>
                    {{-- Movies --}}
                    @can('movie_index')
                    <li class="{{ request()->is('admin/movies*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-video-camera"></i><span>Movies</span></a>
                        <ul class="collapse">
                            <li class="{{ request()->is('admin/movies') ? 'active' : '' }}"><a href="{{ url('/admin/movies') }}"><i class="ti-video-camera"></i><span>Movies List</span></a></li>
                            @can('movie_add')
                            <li class="{{ request()->is('admin/movies/add') ? 'active' : '' }}"><a href="{{ url('/admin/movies/add') }}"><i class="ti-plus"></i><span>Add Movie</span></a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    {{-- Series / Tv Shows --}}
                    @can('series_index')
                    <li class="{{ request()->is('admin/series*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-desktop"></i><span>Series / Tv Shows</span></a>
                        <ul class="collapse">
                            <li class="{{ request()->is('admin/series') ? 'active' : '' }}"><a href="{{ url('/admin/series') }}"><i class="ti-desktop"></i><span>Series List</span></a></li>
                            @can('series_add')
                            <li class="{{ request()->is('admin/series/add') ? 'active' : '' }}"><a href="{{ url('/admin/series/add') }}"><i class="ti-plus"></i><span>Add Series</span></a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    {{-- Episodes --}}
                    @can('episodes_index')
                    <li class="{{ request()->is('admin/episodes*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-desktop"></i><span>Episodes</span></a>
                        <ul class="collapse">
                            <li class="{{ request()->is('admin/episodes') ? 'active' : '' }}"><a href="{{ url('/admin/episodes') }}"><i class="ti-desktop"></i><span>Episodes List</span></a></li>
                            @can('episodes_add')
                            <li class="{{ request()->is('admin/episodes/add') ? 'active' : '' }}"><a href="{{ url('/admin/episodes/add') }}"><i class="ti-plus"></i><span>Add Episodes</span></a></li>
                            @endcan('series_add')
                        </ul>
                    </li>
                    @endcan
                    {{-- Genres --}}
                    @can('genres_index')
                    <li class="{{ request()->is('admin/genres*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-receipt"></i><span>Genres</span></a>
                        <ul class="collapse">
                            <li class="{{ request()->is('admin/genres') ? 'active' : '' }}"><a href="{{ url('/admin/genres') }}"><i class="ti-receipt"></i><span>Genres List</span></a></li>
                            @can('genres_add')
                            <li class="{{ request()->is('admin/genres/add') ? 'active' : '' }}"><a href="{{ url('/admin/genres/add') }}"><i class="ti-plus"></i><span>Add Genres</span></a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    {{-- Pages --}}
                    @can('pages_index')
                    <li class="{{ request()->is('admin/pages*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-notepad"></i><span>Pages</span></a>
                        <ul class="collapse">
                            <li class="{{ request()->is('admin/pages') ? 'active' : '' }}"><a href="{{ url('/admin/pages') }}"><i class="ti-notepad"></i><span>Pages List</span></a></li>
                            @can('pages_add')
                            <li class="{{ request()->is('admin/pages/add') ? 'active' : '' }}"><a href="{{ url('/admin/pages/add') }}"><i class="ti-plus"></i><span>Add Pages</span></a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    {{-- Users --}}
                    @can('users_index')
                    <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Users</span></a>
                        <ul class="collapse">
                            <li class="{{ request()->is('admin/users') ? 'active' : '' }}"><a href="{{ url('/admin/users') }}"><i class="ti-user"></i><span>Users List</span></a></li>
                            @can('users_add')
                            <li class="{{ request()->is('admin/users/add') ? 'active' : '' }}"><a href="{{ url('/admin/users/add') }}"><i class="ti-plus"></i><span>Add Users</span></a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    {{-- Comments --}}
                    @can('comments_index')
                    <li class="{{ request()->is('admin/comments*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/comments') }}" aria-expanded="true"><i class="ti-comment-alt"></i><span>Comments</span></a>
                    </li>
                    @endcan
                    {{-- Stats --}}
                    @can('stats_index')
                    <li class="{{ request()->is('admin/stats*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fas fa-chart-bar"></i><span>Analytics Stats</span></a>
                        <ul class="collapse">
                            <li class="{{ request()->is('admin/stats') ? 'active' : '' }}"><a href="{{ url('/admin/stats') }}"><i class="fas fa-globe"></i><span>Realtime</span></a></li>
                            <li class="{{ request()->is('admin/stats/pageviews') ? 'active' : '' }}"><a href="{{ url('/admin/stats/pageviews') }}"><i class="fas fa-chart-line"></i><span>Pageviews</span></a></li>
                            <li class="{{ request()->is('admin/stats/seo-stats') ? 'active' : '' }}"><a href="{{ url('/admin/stats/seo-stats') }}"><i class="fas fa-chart-pie"></i><span>SEO Stats</span></a></li>
                        </ul>
                    </li>
                    @endcan
                    {{-- Newsletter --}}
                    @can('newsletters_index')
                    <li class="{{ request()->is('admin/newsletter*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-email"></i><span>Newsletter</span></a>
                        <ul class="collapse">
                            <li class="{{ request()->is('admin/newsletter') ? 'active' : '' }}"><a href="{{ url('/admin/newsletter') }}"><i class="ti-user"></i><span>Subscribers</span></a></li>
                            @can('newsletters_send')
                            <li class="{{ request()->is('admin/newsletter/send') ? 'active' : '' }}"><a href="{{ url('/admin/newsletter/send') }}"><i class="ti-location-arrow"></i><span>Send</span></a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    {{-- Settings --}}
                    @can('settings_index')
                    <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i><span>Settings</span></a>
                        <ul class="collapse">
                            <li class="{{ request()->is('admin/settings/general') ? 'active' : '' }}"><a href="{{ url('/admin/settings/general') }}"><i class="ti-paint-roller"></i><span>General</span></a></li>
                            <li class="{{ request()->is('admin/settings/search_engines') ? 'active' : '' }}"><a href="{{ url('/admin/settings/search_engines') }}"><i class="ti-blackboard"></i><span>Search Engines</span></a></li>
                            <li class="{{ request()->is('admin/settings/advertisement') ? 'active' : '' }}"><a href="{{ url('/admin/settings/advertisement') }}"><i class="ti-announcement"></i><span>Advertisement</span></a></li>
                            @role('administrators')<li class="{{ request()->is('admin/settings/permissions') ? 'active' : '' }}"><a href="{{ url('/admin/settings/permissions') }}"><i class="fas fa-user-shield"></i><span>Permissions</span></a></li>@endrole
                        </ul>
                    </li>
                    @endcan
                    {{-- Sitemaps --}}
                    <li class="{{ request()->is('admin/sitemaps*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/sitemaps') }}"><i class="ti-rss"></i><span>Sitemaps</span></a>
                    </li>
                    {{-- Profile --}}
                    @can('profile_index')
                    <li class="{{ request()->is('admin/profile*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/profile') }}"><i class="ti-user"></i><span>Profile</span></a>
                    </li>
                    @endcan
                    {{-- Logout --}}
                    <li class="{{ request()->is('admin/logout*') ? 'active' : '' }}">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti-power-off"></i><span>Logout</span></a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </nav>
        </div>
    </div>
</div>
