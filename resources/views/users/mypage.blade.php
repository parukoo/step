@extends('layouts.app')
@section('content')
<div class="l-wrapper">
  @include('components/header')
  <main class="l-main">
    <section class="p-wrapper">
      <div class="p-container">
        <div class="p-headingWrapper">
          <h2 class="p-flow__title p-heading"><span>M</span>y Page</h2>
          <span class="p-heading-sub">マイページ</span>
        </div>
      
        <div class="p-profile">
          <figure class="p-profile-image">
            <img src="{{ asset('storage/img/'.$user->photo) }}.jpg" alt="">
          </figure>
          <div class="p-profile-txtWrapper">
          <h3 class="p-profile-name">{{ $user->name }}<a href="/users/edit">編集</a></h3>
            <p class="p-profile-txt">{{ $user->profile }}</p>
          </div>
        </div>
        <div class="p-mystep">
          <ul class="p-mystep-menu">
            <li class="js-tabLink">学習中のSTEP</li>
            {{-- <li class="js-tabLink">学習済みのSTEP</li> --}}
            <li class="js-tabLink is-active">登録したSTEP</li>
          </ul>

          <div class="p-mystep-content">
            <div class="p-posts--mypage js-tabPanel">
              @foreach ($joinsteps as $joinstep)
                <div class="p-post--mypage">
                  <a href="/steps/{{ $joinstep->id }}">
                    <figure class="p-post-image"><img src="img/category/eyecatch0{{ $joinstep->id }}.jpg" alt=""></figure>
                    <h4 class="p-post-title">{{ $joinstep->title }}</h4>
                    <p class="p-post-txt">{{ $joinstep->info }}</p>
                  </a>
                </div>                  
              @endforeach
            </div>

            {{-- <div class="p-posts--mypage js-tabPanel">
              <div class="p-post--mypage">
                <a href="post-single.html">
                  <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
                  <h4 class="p-post-title">学習済STEP</h4>
                  <p class="p-post-txt">学習方法の説明文が入ります。学習方法の説明文が入ります。学習方法の説明文が入ります。</p>
                </a>
              </div>
              <div class="p-post--mypage">
                <a href="post-single.html">
                  <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
                  <h4 class="p-post-title">学習済STEP</h4>
                  <p class="p-post-txt">学習方法の説明文が入ります。学習方法の説明文が入ります。学習方法の説明文が入ります。</p>
                </a>
              </div>
              <div class="p-post--mypage">
                <a href="post-single.html">
                  <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
                  <h4 class="p-post-title">学習済STEP</h4>
                  <p class="p-post-txt">学習方法の説明文が入ります。学習方法の説明文が入ります。学習方法の説明文が入ります。</p>
                </a>
              </div>
            </div> --}}

            <div class="p-posts--mypage js-tabPanel is-active">
              @foreach ($registersteps as $registerstep)
              <a href="/steps/{{ $registerstep->id }}/edit">編集</a>
                <div class="p-post--mypage">
                  <a href="/steps/{{ $registerstep->id }}">
                    <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
                    <h4 class="p-post-title">{{ $registerstep->title }}</h4>
                    <p class="p-post-txt">{{ $registerstep->info }}</p>
                  </a>
                </div>                  
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </section>
    @include('components/footer')
  </main>
</div>
@endsection