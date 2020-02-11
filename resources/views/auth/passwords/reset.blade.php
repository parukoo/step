@extends('layouts.app')
@section('content')
  <main>
    <div class="p-formWrapper">
      <h1 class="p-form-title"><a href="/"><img src="./../../../img/common/ico_sitelogo.svg" alt=""></a></h1>
      <form class="p-form" action="{{ route('password.update') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <ul class="p-form-links">
          <li class="p-form-link --large">{{ __('Reset Password') }}</li>
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
              <input type="password" id="password" name="password" class="@error('password') is-error @enderror" placeholder="パスワード" required>
              @error('password')
                <span class="p-form__errorMsg" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </dd>
          </dl>

          <dl>
            <dt><label for="password_confirmation">パスワード（再入力）<span>必須</span></label></dt>
            <dd>
              <input type="password" id="password_confirmation" name="password_confirmation" class="@error('password') is-error @enderror" placeholder="パスワード（再入力）" required>
            </dd>
          </dl>
        </div>

        <div class="p-form-submit">
          <button type="submit" class="c-btn p-form__btn">{{ __('Reset Password') }}</button>
        </div>
      </form>
    </div>
  </main>
  @include('components/footer')
@endsection