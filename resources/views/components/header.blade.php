<header class="l-header">
  <div class="p-header">
    <div class="p-header-titleWrapper">
      <a href="/">
        <h1 class="p-header-title"><img src="{{ asset('img/common/sitelogo.svg') }}" alt=""></h1>
        <span class="p-header-subtitle">あなたの人生を共有しよう</span>
      </a>
    </div>
    <nav class="p-header-pcMenu u-display-pc">
      <ul>
        <li><a href="{{ route('steps')}}">STEP一覧</a></li>
        <li><a href="">カテゴリー検索</a></li>
      </ul>
    </nav>
    <div class="p-header-btns u-display-pc">
      <ul>
        @auth
          <li>
            <a href="http://153.126.167.249/dev-step.com/public/mypage.php">
              <figure class="p-avator --small"><img src="{{ asset('img/update/post/post01.jpg') }}" alt=""></figure>
              <span class="p-avator__name">{{  Auth::user()->name }}</span>
            </a>
          </li>
          <li class="c-btn p-header-btn --login">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
          </form>
        @endauth

        @guest
          <li class="c-btn p-header-btn --login">
            <a href="{{ route('login') }}">ログイン</a>
          </li>
          <li class="c-btn p-header-btn --signup">
            <a href="{{ route('register') }}">新規登録</a>
          </li>
        @endauth
      </ul>
    </div>
    <div class="p-header-humberger u-display-sp">
      <span></span>
      <span></span>
      <span>MENU</span>
    </div>
  </div>
</header>