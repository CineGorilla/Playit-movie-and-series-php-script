<!doctype html>
<title>@if(isset($general->site_name)) {{$general->site_name}} @endif - Site Maintenance</title>
<style>
  body { text-align: center; padding: 150px; }
  h1 { font-size: 50px; }
  body { font: 20px Helvetica, sans-serif; color: #333; }
  article { display: block; text-align: left; width: 650px; margin: 0 auto; }
  a { color: #dc8100; text-decoration: none; }
  a:hover { color: #333; text-decoration: none; }
</style>

<article>
    <h1>We&rsquo;ll be back soon!</h1>
    <div>
      <p>
        @if(isset($general->site_maintenance_description))
          {{$general->site_maintenance_description}}
        @else
          Sorry for the inconvenience but we’re performing some maintenance at the moment. If you need to you can always contact us, otherwise we’ll be back online shortly!
        @endif
      </p>
      <p>
        @if(isset($general->site_author))
        &mdash; {{$general->site_author}}
        @else
        &mdash; The Team
        @endif
      </p>
      <p>
        @guest
            You can <a href="{{ route('login') }}" rel="nofollow" class="siteHeader__topLevelLink">Sign in</a> or
            <a href="{{ route('register') }}" rel="nofollow" class="siteHeader__topLevelLink">Sign Up</a> while in maintenance mode!
        @else
            You are login! You can <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="siteHeader__subNavLink u-topGrayBorder" data-method="POST">Sign Out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
        @endguest
      </p>
    </div>
</article>
