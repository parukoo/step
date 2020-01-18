@extends('layouts.app')
@section('content')
<div class="l-wrapper">
  @include('components/header')
  <main class="l-main" id="app">
    <step-single
      :step="{{$step}}"></step-single>
    @include('components/footer')
  </main>
</div>
@endsection
