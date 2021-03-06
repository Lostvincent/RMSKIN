<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' type='text/css' href='//fonts.lug.ustc.edu.cn/css?family=Open+Sans:300,400,600,700'>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/skin/default_skin/css/theme.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin-tools/admin-forms/css/admin-forms.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/fancytree/skin-win8/ui.fancytree.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/nestable/nestable.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">
  <!--[if lt IE 9]>
    <script src="//cdn.jsdelivr.net/g/html5shiv@3.7.3,respond@1.4.2"></script>
  <![endif]-->
  @yield('css')
</head>

<body class="admin-panels-page @yield('body_class')">
  <div id="main">
    @include('layout.header')
    @include('layout.menu')
    <section id="content_wrapper">
      <header id="topbar" class="alt">
        <div class="topbar-left">
          <ol class="breadcrumb">
            <li class="crumb-icon">
              <a href="#">
                <span class="glyphicon glyphicon-home"></span>
              </a>
            </li>
          </ol>
        </div>
        <div class="topbar-right">
          <div class="ml15 ib va-m" id="toggle_sidemenu_r">
            <a href="#" class="pl5">
              <i class="fa fa-sign-in fs22 text-primary"></i>
            </a>
          </div>
        </div>
      </header>
      @yield('content')
      <script>
      var csrf_token = '{!! csrf_token() !!}';
      @if (count($errors) > 0)
          @foreach ($errors->all() as $error)
              toastr.error('{{ $error }}');
          @endforeach
      @elseif (session('status'))
        toastr.success('{{ session('status') }}');
      @endif
      </script>
    </section>
    @include('layout.sidebar')
  </div>
</body>
<script src="//cdn.jsdelivr.net/g/jquery@1.12.1,jquery.ui@1.11.4,jquery.pjax@1.9.5,nprogress@0.1.6"></script>
<script src="{{ asset('assets/js/utility/utility.js') }}"></script>
<script src="{{ asset('assets/admin-tools/admin-forms/js/jquery-ui-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
@yield('script')
<script type="text/javascript">
jQuery(document).ready(function() {
  "use strict";
  Core.init();
  Custom.init();
});
</script>
</html>