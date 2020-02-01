@extends('layouts.app')
@section('content')
<div class="l-wrapper">
  @include('components/header')
  <main class="l-main">
    <div class="p-wrapper">
      <div class="p-container">
        <div class="p-headingWrapper--register">
          <h2 class="p-flow__title p-heading"><span>S</span>tep Register</h2>
          <span class="p-heading-sub--register">stepの編集画面</span>
        </div>
        <div id="app">
          <step-editform 
            :stepid="{{$stepid}}"
            :categories="{{$categories}}"></step-editform>
        </div>
      </div>
    </div>
    @include('components/footer')
  </main>
</div>
@endsection