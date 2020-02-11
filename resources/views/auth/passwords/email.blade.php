@extends('layouts.app')
@section('content')
  <main>
    <div class="p-formWrapper">
      <h1 class="p-form-title"><a href="/"><img src="./../../../img/common/ico_sitelogo.svg" alt=""></a></h1>
      <form class="p-form" action="{{ route('password.email') }}" method="post">
        @csrf
        <ul class="p-form-links">
          <li class="p-form-link --large">{{ __('Reset Password') }}</li>
        </ul>
        @if (session('status'))
          <span class="p-form__errorMsg" role="alert">
              {{ session('status') }}
          </span>
        @endif
        <div class="p-form-inputs">
          <dl>
            <dt><label for="email">メールアドレス</label></dt>
            <dd>
              <input class="@error('email') is-error @enderror" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="メールアドレス" required>
              @error('email')
                <span class="p-form__errorMsg" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </dd>
          </dl>
        </div>
      
        <div class="p-form-submit">
          <button type="submit" class="c-btn p-form__btn">パスワードリセットリンク送信</button>
        </div>
      </form>
    </div>
  </main>
  @include('components/footer')
@endsection