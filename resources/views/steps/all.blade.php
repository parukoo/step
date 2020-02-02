@extends('layouts.app')
@section('content')
<div class="l-wrapper">
  @include('components/header')
  <main class="l-main">
    <section class="p-wrapper">
      <div class="p-container">
        <div class="p-headingWrapper">
          <h2 class="p-heading"><span>R</span>anking Step</h2>
          <span class="p-heading-sub">人気のSTEPです。</span>
        </div>
        <div id="app">
          <step-index></step-index>
        </div>
      </div>
    </section>
    @include('components/footer')
  </main>
</div>
@endsection