@extends('layouts.app')
@section('content')
<div class="l-wrapper">
  @include('components/header')
  <main class="l-main">
    <section class="p-wrapper--list">
      <div class="p-headingWrapper --list">
        <h2 class="p-heading"><span>R</span>anking Step</h2>
        <span class="p-heading-sub">人気のSTEPです。</span>
      </div>
      <div class="p-postsWrapper" id="app">
        <step-list></step-list>
      </div>
    </section>
    @include('components/footer')
  </main>
</div>
@endsection