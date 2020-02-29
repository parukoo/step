<header class="l-header">
    <div class="p-header">
      <div class="p-header-top">
        <div class="p-header-titleWrapper">
          <a href="/">
            <h1 class="p-header-title"><img src="{{ asset('img/common/ico_sitelogo.svg') }}" alt=""></h1>
            <span class="p-header-subtitle">あなたの人生のSTEPを<br>共有しよう</span>
          </a>
        </div>
        {{-- pc menu --}}
        <nav class="p-header-pcMenu u-display-pc js-index-menu">
          <ul>
            <li><a href="#step01">STEPとは</a></li>
            <li><a href="#step02">機能と特徴</a></li>
            <li><a href="#step03">人気のSTEP</a></li>
          </ul>
        </nav>
      </div>

      <div class="p-header-bottom">
        <div class="p-header-btns u-display-pc">
          <ul>
            @guest
              <li class="c-btn p-header-btn as_login">
                <a href="{{ route('login') }}">ログイン</a>
              </li>
              <li class="c-btn p-header-btn as_signup">
                <a href="{{ route('register') }}">新規登録</a>
              </li>
            @endauth
          </ul>
        </div>
      </div>
  
      {{-- sp menu --}}
      <div class="p-header-humberger u-display-sp js-header-btn">
        <span></span>
        <span></span>
        <span>MENU</span>
      </div>
      <div class="p-header-spMenu js-header-menu">
        <p class="p-header-spMenu__logo">
          <a href="/"><img src="{{ asset('img/common/ico_sitelogo.svg') }}" alt="STEP"></a>
        </p>
        <nav>
          <ul class="p-header-spMenu-list js-index-menu">
            <li class="p-header-spMenu__item"><a href="#step01">STEPとは</a></li>
            <li class="p-header-spMenu__item"><a href="#step02">機能と特徴</a></li>
            <li class="p-header-spMenu__item"><a href="#step03">人気のSTEP</a></li>
          </ul>
        </nav>
  
        <ul class="p-header-spMenu__btns">
          <li class="c-btn p-header-spMenu__btn as_login">
            <a href="{{ route('login') }}">ログイン</a>
          </li>
          <li class="c-btn p-header-spMenu__btn as_signup">
            <a href="{{ route('register') }}">新規登録</a>
          </li>
        </ul>
        
      </div>
  
    </div>
  </header>