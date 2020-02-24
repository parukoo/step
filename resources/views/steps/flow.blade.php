@extends('layouts.app')
@section('content')
<div class="l-wrapper">
  @include('components/header')
  <main class="l-main" id="app">
    <!-- フラッシュメッセージ -->
    @if (session('flash_message'))
      <div class="c-flash-message js-flash-message" role="alert">
        {{ session('flash_message') }}
      </div>
    @endif
    <step-flow
      :complete="{{ $complete }}"
      :stepid="{{ $stepid }}"></step-flow>
    @include('components/footer')
  </main>
</div>
@endsection