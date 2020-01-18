<template>
  <div class="p-form-inputs-wrapper">
    <div class="p-form-inputs --register">
      <dl>
        <dt>STEPのタイトル4<span>必須</span></dt>
        <dd>
          <input type="text" class="" name="title" id="title" value="" placeholder="50文字以内で入力してください" required>
            <span class="p-form__errorMsg" role="alert">
              <strong>{{ $message }}</strong>
            </span>
        </dd>
      </dl>

      <dl>
        <dt>カテゴリー<span>必須</span></dt>
        <dd>
          <select name="category_id">
            <option selected>選択してください</option>
            <option value=""></option>
          </select>
          <span class="p-form__errorMsg" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        </dd>
      </dl>

      <dl>
        <dt>STEPの紹介文<span>必須</span></dt>
        <dd>
          <textarea name="info" id="" cols="30" rows="10"></textarea>
            <span class="p-form__errorMsg" role="alert">
              <strong>{{ $message }}</strong>
            </span>
        </dd>
      </dl>

      <dl>
        <dt>達成目安時間<span>必須</span></dt>
        <dd>
          <input class="p-form-input__time" name="time" type="number" placeholder="選択してください" value="">時間
            <span class="p-form__errorMsg" role="alert">
              <strong>{{ $message }}</strong>
            </span>
        </dd>
      </dl>

    </div>
    <div class="p-form-submit">
      <input class="c-btn" type="submit" value="送信">
    </div>
  </div>
</template>

<script>
export default {
  name: 'StepForm01',
  data(){
    return{
      stepNumber: 1,
      form: {
        firstName: null,
        lastName: null,
        Email: null,
        tel: null,
        birthday: null
      }
    }
  },
	methods: {
		submit: function(){
			this.$emit('update',{
				firstName: this.firstName,
				lastName: this.lastName
			});
		}
	}
}
</script>