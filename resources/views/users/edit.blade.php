@extends('layouts.app')
@section('content')
<div class="l-wrapper">
  @include('components/header')
  <main class="l-main">
    <div class="p-wrapper">
      <div class="p-container">
        <div class="p-headingWrapper--register">
          <h2 class="p-flow__title p-heading"><span>P</span>trofile Edit</h2>
          <span class="p-heading-sub--register">プロフィール編集画面</span>
        </div>
        <form class="p-form --register" action="/users/update" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
          <input name="utf8" type="hidden" value="✓" />
          <input type="hidden" name="id" value="{{ $user->id }}" />
          @csrf
          <div class="p-form-inputs --register">
            <dl>
              <div class="p-profileEdit-form__pic-wrapper">
                <label class="p-profileEdit-form__pic js-form-pic">
                  <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
                  <input type="file" class="p-profileEdit-form__pic-input js-form-picFile" name="user_profile_photo" value="{{ old('user_profile_photo', $user->photo) }}.jpg" accept="image/jpeg,image/gif,image/png" />
                  @if ($user->photo)
                    <img class="js-form-preview" src="{{ asset('storage/img/' .$user->photo) }}.jpg" alt="avatar" />
                  @else
                    <img class="js-form-preview" src={{ asset('image/dammy.jpg') }} alt="">
                  @endif
                  <i class="fas fa-plus profile-icon"></i>
                </label>
              </div>
            </dl>
            <dl>
              <dt><label for="name">ユーザー名<span>必須</span></label></dt>
              <dd>
                <input type="text" name="name" id="name" class="@error('name') is-error @enderror" value="{{ old('name', $user->name) }}" placeholder="50文字以内で入力してください">
                @error('name')
                  <span class="p-form__errorMsg" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </dd>
            </dl>
            <dl>
              <dt><label for="profile">自己紹介</label></dt>
              <dd>
                <textarea name="profile" id="profile" cols="30" rows="10" class="@error('profile') is-error @enderror" placeholder="150文字以内で入力してください">{{ old('profile', $user->profile) }}</textarea>
                @error('profile')
                  <span class="p-form__errorMsg" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </dd>
            </dl>
          </div>
          <div class="p-form-submit">
            <input class="c-btn" type="submit" value="登録">
          </div>
        </form>        
      </div>
    </div>
    @include('components/footer')
  </main>
</div>
@endsection