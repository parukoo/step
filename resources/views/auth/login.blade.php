@extends('layouts.app')
@section('title', 'ログイン')
@section('content')
  <main>
    <div class="p-formWrapper">
      <h1 class="p-form-title"><a href="/"><img src="img/common/ico_sitelogo.svg" alt=""></a></h1>
      <form class="p-form" action="" method="post">
        @csrf
        <ul class="p-form-links">
          <li class="p-form-link"><a href="/register">新規登録</a></li>
          <li class="p-form-link is-active"><a href="/login">ログイン</a></li>
        </ul>
        <div class="p-form-inputs">
          <dl>
            <dt><label for="email">メールアドレス<span>必須</span></label></dt>
            <dd>
              <input class="@error('email') is-error @enderror" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="メールアドレス" required>
              @error('email')
                <span class="p-form__errorMsg" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </dd>
          </dl>
          <dl>
            <dt><label for="password">パスワード<span>必須</span></label></dt>
            <dd>
              <input type="password" id="password" class="@error('password') is-error @enderror" name="password" placeholder="パスワード" required>
              @error('password')
                <span class="p-form__errorMsg" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </dd>
          </dl>
        </div>
        
        @if (Route::has('password.request'))
          <p class="p-form-passReset">パスワードを忘れてしまった方は<a href="{{ route('password.request') }}">コチラ</a></p>
        @endif
        <div class="p-form-submit">
          <button type="submit" class="c-btn p-form__btn">ログイン</button>
        </div>
      </form>
    </div>
  </main>
  @include('components/footer')
@endsection