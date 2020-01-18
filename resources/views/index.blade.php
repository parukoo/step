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
          <step-component></step-component>
        </div>
        <div class="p-round">
          <div class="p-postsWrapper">
            <h3 class="p-posts-title">「ダイエット」の人気STEP</h3>
            <div class="p-posts">
              <div class="p-post">
                <a href="step.php">
                  <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
                  <h4 class="p-post-title">私のプログラミング学習方法</h4>
                  <p class="p-post-txt">学習方法の説明文が入ります。学習方法の説明文が入ります。学習方法の説明文が入ります。</p>
                </a>
              </div>
              <div class="p-post">
                <a href="step.php">
                  <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
                  <h4 class="p-post-title">私のプログラミング学習方法</h4>
                  <p class="p-post-txt">学習方法の説明文が入ります。学習方法の説明文が入ります。学習方法の説明文が入ります。</p>
                </a>
              </div>
              <div class="p-post">
                <a href="step.php">
                  <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
                  <h4 class="p-post-title">私のプログラミング学習方法</h4>
                  <p class="p-post-txt">学習方法の説明文が入ります。学習方法の説明文が入ります。学習方法の説明文が入ります。</p>
                </a>
              </div>
            </div>
            <p class="p-posts-btnWrapper">
              <span class="c-btn p-posts-btn"><a href="archive.php">もっと見る</a></span>
            </p>
          </div>
        
          <div class="p-postsWrapper">
            <h3 class="p-posts-title">「ダイエット」の人気STEP</h3>
            <div class="p-posts">
              <div class="p-post">
                <a href="step.php">
                  <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
                  <h4 class="p-post-title">私のプログラミング学習方法</h4>
                  <p class="p-post-txt">学習方法の説明文が入ります。学習方法の説明文が入ります。学習方法の説明文が入ります。</p>
                </a>
              </div>
              <div class="p-post">
                <a href="step.php">
                  <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
                  <h4 class="p-post-title">私のプログラミング学習方法</h4>
                  <p class="p-post-txt">学習方法の説明文が入ります。学習方法の説明文が入ります。学習方法の説明文が入ります。</p>
                </a>
              </div>
              <div class="p-post">
                <a href="step.php">
                  <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
                  <h4 class="p-post-title">私のプログラミング学習方法</h4>
                  <p class="p-post-txt">学習方法の説明文が入ります。学習方法の説明文が入ります。学習方法の説明文が入ります。</p>
                </a>
              </div>
            </div>
            <p class="p-posts-btnWrapper">
              <span class="c-btn p-posts-btn"><a href="archive.php">もっと見る</a></span>
            </p>
          </div>
        </div>
      </div>
    </section>
    @include('components/footer')
  </main>
</div>
@endsection