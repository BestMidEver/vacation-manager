<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ Request::segment(1) === 'calendar' ? 'active' : null }}">
          <a class="nav-link" href="/calendar">Calendar</a>
        </li>
        @if (Auth::check())
        @if(Auth::user()->hierarchy > 2)
        <li class="nav-item {{ Request::segment(1) === 'browse-requests' ? 'active' : null }}">
          <a class="nav-link" href="/browse-requests/pending">Requests</a>
        </li>
        <li class="nav-item {{ Request::segment(1) === 'browse-users' ? 'active' : null }}">
          <a class="nav-link" href="/browse-users/pending-employee">Users</a>
        </li>
        @endif
        @if(Auth::user()->hierarchy > 0)
        <li class="nav-item {{ Request::segment(1) === 'new-leave' ? 'active' : null }}">
          <a class="nav-link" href="/new-leave">New Leave</a>
        </li>
        @endif
        @endif
      </ul>
      <ul class="navbar-nav ml-auto">
        @if (Auth::check())
        <li class="nav-item {{ Request::segment(1) === 'settings' || Request::segment(1) === 'profile' ? 'active' : null }}">
          <a class="nav-link" href="/profile">{{ Auth::user()->name }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout">Log out</a>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="/login">Log in</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>