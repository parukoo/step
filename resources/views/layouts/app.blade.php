<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'step') }} | @yield('title', 'Home')</title>

  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@step" />
  <meta property="og:url" content="{{ config('app.url') }}" />
  <meta property="og:title" content="step" />
  <meta property="og:description" content="人生のSTEPを共有できるサイトです。" />
  <meta property="og:image" content="https://filmbiyori.paruko.net/image/twitter.jpg" />
  <link rel="shortcut icon" href="//filmbiyori.paruko.net/favicon.ico">
  <link rel="apple-touch-icon-precomposed" href="/image/twitter.jpg">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->

  <!-- Styles -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
  @yield('content')
</body>
</html>
