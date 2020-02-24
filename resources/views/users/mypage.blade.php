@extends('layouts.app')
@section('title', 'マイページ')
@section('content')
<div class="l-wrapper">
  @include('components/header')
  <!-- フラッシュメッセージ -->
  <main class="l-main">
  @if (session('flash_message'))
    <div class="c-flash-message js-flash-message" role="alert">
      {{ session('flash_message') }}
    </div>
  @endif
    <section class="p-wrapper">
      <div class="p-container">
        <div class="p-headingWrapper">
          <h2 class="p-flow__title p-heading"><span>M</span>y Page</h2>
          <span class="p-heading-sub">マイページ</span>
        </div>
      
        <div class="p-profile">
          <figure class="p-profile__image">
            @if($user->photo)
              <img src="{{ asset('img/update/user/'.$user->photo) }}.jpg">
            @else
              <img src="img/common/img_noimage.jpg">
            @endif
          </figure>
          <div class="p-profile-txtWrapper">
          <h3 class="p-profile__name">{{ $user->name }}<a href="/users/edit"><img class="p-profile__edit" src="img/common/ico_useredit.svg"></a></h3>
            <p class="p-profile__txt">{{ $user->profile }}</p>
          </div>
        </div>
        <div class="p-mystep">
          <ul class="p-mystep-menu">
            <li class="js-tabLink is-active">学習中のSTEP</li>
            <li class="js-tabLink">学習済みのSTEP</li>
            <li class="js-tabLink">登録したSTEP</li>
          </ul>

          <div class="p-mystep-content">

            <div class="p-posts--mypage js-tabPanel is-active">
              @foreach ($joinsteps as $joinstep)
              <div class="p-post--mypage">
                <a href="/steps/{{ $joinstep['step']['id'] }}">
                  <div class="p-post__imageWrapper">
                    <span class="p-post__image-label">{{ $joinstep['step']['category']['name']  }}</span>
                    <figure class="p-post__image">
											@if($joinstep['step']['photo'])
												<img src="img/update/step/{{ $joinstep['step']['photo'] }}.jpg" alt="*">
											@else
												<img src="img/common/img_noimage.jpg">
											@endif
										</figure>
                  </div>
                  <h4 class="p-post__title">{{ $joinstep['step']['title'] }}</h4>
                  <p class="p-post__txt">{{ $joinstep['step']['info'] }}</p>
                  <div class="p-post-score">
                    <div class="p-post-score__graph">
                      <span style="width: {{ $joinstep['complete'] }}%"></span>
                    </div>
                    <p class="p-post-score__text">完了率　{{ $joinstep['complete'] }}%</p>
                  </div>
                </a>
              </div>   
              @endforeach
              @if(!$joinsteps)
                <p>学習中のSTEPはありません。</p>
              @endif
            </div>

            <div class="p-posts--mypage js-tabPanel">
              @foreach ($completesteps as $completestep)
              <div class="p-post--mypage">
                <a href="/steps/{{ $completestep['step']['id'] }}">
                  <div class="p-post__imageWrapper">
                    <span class="p-post__image-label">{{ $completestep['step']['category']['name'] }}</span>
                    <figure class="p-post__image">
											@if($completestep['step']['photo'])
                      <img src="img/update/step/{{ $completestep['step']['photo'] }}.jpg" alt="*">
											@else
												<img src="img/common/img_noimage.jpg">
											@endif
                    </figure>
                  </div>
                  <h4 class="p-post__title">{{ $completestep['step']['title'] }}</h4>
                  <p class="p-post__txt">{{ $completestep['step']['info'] }}</p>
                  <div class="p-post-score">
                    <div class="p-post-score__graph">
                      <span style="width: {{ $completestep['complete'] }}%"></span>
                    </div>
                    <p class="p-post-score__text">完了率　{{ $completestep['complete'] }}%</p>
                  </div>
                </a>
              </div>   
              @endforeach
              @if(!$completesteps)
                <p>学習済みのSTEPはありません。</p>
              @endif
            </div>

            <div class="p-posts--mypage js-tabPanel">
              @foreach ($registersteps as $registerstep)
                <div class="p-post--mypage">
                  <a href="/steps/{{ $registerstep->id }}/edit" class="p-post-edit"><img src="img/common/ico_edit.svg" class="p-post-edit__link"></a>
                  <a href="/steps/{{ $registerstep->id }}">
                    <div class="p-post__imageWrapper">
                      <span class="p-post__image-label">{{ $registerstep->category->name }}</span>
                      <figure class="p-post__image">
												@if($registerstep->photo)
													<img src="img/update/step/{{ $registerstep->photo }}.jpg" alt="*">
												@else
													<img src="img/common/img_noimage.jpg">
												@endif
											</figure>
                    </div>
                    <h4 class="p-post__title">{{ $registerstep->title }}</h4>
                    <p class="p-post__txt">{{ $registerstep->info }}</p>
                  </a>
                </div>            
              @endforeach
              @if (!isset( $registersteps[0] ))
                <p>登録したSTEPはありません。</p>
              @endif
            </div>

          </div>
        </div>
      </div>
    </section>
    @include('components/footer')
  </main>
</div>
@endsection