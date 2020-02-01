@extends('layouts.app')
@section('content')
  <main>
    <div class="p-formWrapper">
            <h1 class="p-form-title"><a href="/"><img src="img/common/sitelogo.svg" alt=""></a></h1>
            <form action="{{ route('password.email') }}" method="post" class="p-form">
                @if (session('status'))
                  <span class="p-form__errorMsg" role="alert">
                      {{ session('status') }}
                  </span>
                @endif
                @csrf
                <dl>
                  <dt><label for="email">メールアドレス</label></dt>
                  <dd>
                    <input type="email" name="email" class="p-form__input @error('email') is-error @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email') }}">
                    @error('email')
                      <span class="p-form__errorMsg" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </dd>
                </dl>

                <button type="submit" class="p-form-submit">
                    {{ __('Send Password Reset Link') }}
                </button>

            </form>
          </div>
        </main>
        @include('components/footer')
      @endsection