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
      </div>
      <div class="p-postsWrapper">
        <div class="p-rowposts">
          @foreach($steps as $step)
          <div class="p-rowpost">
            <a href="step.php">
              <figure class="p-rowpost-image"><img src="img/update/post/post01.jpg" alt=""></figure>
              <div class="p-rowpost-txtWrapper">
                <span class="p-rowpost-category">プログラミング</span>
                <h4 class="p-rowpost-title">{{ $step->title }}</h4>
                <div class="p-rowpost-info">
                  <span class="p-rowpost-info__time"><span class="c-icon"><img src="img/common/ico_clock.svg" alt=""></span>目安学習期間：{{ $step->time }}</span>
                  <span class="p-rowpost-info__author"><span class="c-icon"><img src="img/common/ico_author.svg" alt=""></span>作成者：{{ $step->user->name}}</span>
                </div>
                <p class="p-rowpost-txt">{{ $step->info }}</p>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @include('components/footer')
  </main>
</div>
@endsection