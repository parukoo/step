<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'STEP') | {{ config('app.name', 'step') }}</title>

  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@step" />
  <meta property="og:url" content="{{ config('app.url') }}" />
  <meta property="og:title" content="step" />
  <meta property="og:description" content="人生のSTEPを共有できるサイトです。" />
  <meta property="og:image" content="https://filmbiyori.paruko.net/image/twitter.jpg" />
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
  <link rel="apple-touch-icon-precomposed" href="/image/twitter.jpg">
  <script src="https://kit.fontawesome.com/7f19bc1ee0.js" crossorigin="anonymous"></script>

  <!-- Styles -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <!-- Fonts -->
</head>
<body>
  @yield('content')
</body>
</html>
