@extends('layouts.app')
@section('content')
<div class="l-wrapper">
  @include('components/header-index')
  <main class="l-main --index">
    
    
    <section class="s-index-kv">
      <ul class="s-index-kv-btns">
        <li class="c-btn s-index-kv__btn --login">
          <a href="{{ route('login') }}">ログイン</a>
        </li>
        <li class="c-btn s-index-kv__btn --signup">
          <a href="{{ route('register') }}">新規登録</a>
        </li>
      </ul>
      <div class="s-index-kv-inner">
        <div class="s-index-kv-titleWrapper">
          <h1 class="s-index-kv-title">あなたの人生を<br>STEPを共有しよう</h1>
          <p class="s-index-kv-text">あなたが「良かった」と思う学習方法を、みんなに共有しましょう。<br>みんなが「良かった」と思う学習方法に、あなたも挑戦してみましょう。</p>
          <div class="s-index-btn-wrapper --left">
            <span class="c-btn s-index-btn"><a href="{{ route('register') }}">新規登録</a></span>
          </div>
        </div>
        <p class="s-index-kv-img"><img src="./img/index/ico_kv.jpg" alt=""></p>
      </div>
    </section>

    <section id="step01" class="s-index-about">
      <h2 class="p-heading s-index-heading"><span>S</span>tepとは?</h2>
      <p class="s-index-about-text">プログラミングや英語などを学ぶのにも人それぞれ「これが良かった」という「順番」と「内容」があります。<br>
      STEPでは、人それぞれの「この順番でこういったものを学んでいったのが良かった」という「STEP」を投稿し、他の人はそれを見ながら、その「STEP」を元に学習を進めていくことができます。</p>
      <div class="s-index-about-points">
        <div class="s-index-about-point">
          <h3 class="s-index-about-point__title">良かった学び方を<br class="u-display-sp">共有できる</h3>
          <figure><img src="./img/index/ico_about01.jpg" alt=""></figure>
        </div>
        <div class="s-index-about-point">
          <h3 class="s-index-about-point__title">良かった学び方に<br class="u-display-sp">挑戦できる</h3>
          <figure><img src="./img/index/ico_about02.jpg" alt=""></figure>
        </div>
      </div>
      <div class="s-index-btn-wrapper">
        <span class="c-btn s-index-btn"><a href="{{ route('register') }}">新規登録</a></span>
      </div>
    </section>

    <section id="step02" class="s-index-feature-wrapper">
      <h2 class="p-heading s-index-heading"><span>機</span>能と特徴</h2>
      <p class="s-index-text">STEPは、楽しく始められる機能が揃っています。</p>
      <div class="s-index-feature">
        <div class="s-index-feature-textWrapper">
          <span class="s-index-feature__number">STEP①</span>
          <h3 class="s-index-feature__title">順番に沿って学ぶことができる</h3>
          <p class="s-index-feature__text">順番に沿って学習を行うことができるので、効率的な学習を行うことができます。</p>
        </div>
        <figure>
          <img src="./img/index/img_feature01.jpg" alt="">
        </figure>
      </div>
      <div class="s-index-feature">
        <figure>
          <img src="./img/index/img_feature02.jpg" alt="">
        </figure>
        <div class="s-index-feature-textWrapper">
          <span class="s-index-feature__number">STEP②</span>
          <h3 class="s-index-feature__title">進捗状況を確認することができる</h3>
          <p class="s-index-feature__text">マイページで随時あなたの各STEPの進捗状況を確認することができます。</p>
        </div>
      </div>
      <div class="s-index-feature">
        <div class="s-index-feature-textWrapper">
          <span class="s-index-feature__number">STEP③</span>
          <h3 class="s-index-feature__title">学習方法を共有することができる</h3>
          <p class="s-index-feature__text">あなたの今までの良かったと思う学習方法や内容をSTEPに登録することができます。Twitterシェアをすることで、登録したSTEPを拡散することも可能です。</p>
        </div>
        <figure>
          <img src="./img/index/img_feature03.jpg" alt="">
        </figure>
      </div>
    </section>

    <section id="step03" class="s-index-ranking">
      <div class="s-index-ranking-heading-wrapper">
        <h2 class="p-heading s-index-heading"><span>人</span>気のSTEP</h2>
      </div>        
      <ul class="p-posts --index">
        @foreach ($steps as $step)
        <li class="p-post --index">
          <a href="steps/{{ $step->id }}">
            <div class="p-post__imageWrapper">
              <span class="p-post__image-label">{{ $step->category->name }}</span>
              <figure class="p-post__image"><img src="img/category/eyecatch0{{ $step->category_id }}.jpg" alt=""></figure>
            </div>
            <h3 class="p-post__title">{{ $step->title }}</h3>
            <p class="p-post__txt">{{ $step->info }}</p>
          </a>
        </li>
        @endforeach
      </ul>

    </section>

    <div class="s-index-start">
      <p class="s-index-start__text">さっそく始めよう。<br>自分に合った学習方法を見つけましょう。</p>
      <div class="s-index-btn-wrapper">
        <span class="c-btn s-index-btn"><a href="{{ route('register') }}">STEPを始める</a></span>
      </div>
    </div>
    @include('components/footer')
  </main>
</div>
@endsection

