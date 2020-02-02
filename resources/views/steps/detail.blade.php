@extends('layouts.app')
@section('content')
<div class="l-wrapper">
  @include('components/header')
  <main class="l-main">
    <div class="p-wrapper">
      <div class="p-container">
        <div class="p-headingWrapper">
          <h2 class="p-flow__title p-heading"><span>S</span>tep Flow</h2>
          <span class="p-heading-sub">stepの流れ</span>
        </div>
        <div id="app">
          <step-detail
            :title="{{$title}}" 
            :stepid="{{$stepid}}"
            :flowid="{{$flowid}}"></step-detail>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection