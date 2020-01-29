@extends('layouts.app')
@section('content')
<div class="l-wrapper">
  @include('components/header')
  <main class="l-main" id="app">
    <step-flow
      :complete="{{ $complete }}"
      :stepid="{{ $stepid }}"></step-flow>
    @include('components/footer')
  </main>
</div>
@endsection