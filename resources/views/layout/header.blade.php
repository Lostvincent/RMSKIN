<!-- Start: Header -->
<header class="navbar navbar-fixed-top navbar-shadow">
  <div class="navbar-branding">
    <a class="navbar-brand" href="{{ url('/') }}">
      <b>RMSKIN</b>Portal
    </a>
    <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
  </div>
  <form class="navbar-form navbar-left navbar-search alt" role="search" action="#" method="GET">
    <div class="form-group">
      <input name="subject" type="text" class="form-control" value="">
    </div>
  </form>
  <ul class="nav navbar-nav navbar-right">
    <li class="dropdown menu-merge">
      <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown">
        {{-- <img src="#" alt="avatar" class="mw30 br64"> --}}
        <span class="hidden-xs pl15"> {{ !empty(Auth::user()) ? Auth::user()->name : '' }} </span>
        <span class="caret caret-tp hidden-xs"></span>
      </a>
      <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
        <li class="list-group-item">
          <a href="{{ url('admin/my') }}" class="animated animated-short fadeInUp">
            <span class="w20 fa fa-bell"></span> 修改个人资料</a>
        </li>
        <li class="dropdown-footer">
          <a href="{{ url('admin/my/logout') }}" class="">
          <span class="fa fa-power-off pr5"></span> 登出 </a>
        </li>
      </ul>
    </li>
  </ul>
</header>
<!-- End: Header -->