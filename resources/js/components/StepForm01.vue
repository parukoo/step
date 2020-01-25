<template>
  <form @input="submit">
    <div class="p-form-inputs-wrapper">
      <div class="p-form-inputs --register">

        <dl>
          <dt><label for="title">STEPのタイトル<span>必須</span></label></dt>
          <dd>
            <input 
              type="text" 
              id="title" 
              v-model="title" 
              placeholder="STEPのタイトルを入力してください"
              @blur="$v.title.$touch()">
              <span v-if="!$v.title.required" class="p-form__errorMsg" role="alert">
                <strong>タイトルが入力されていません</strong>
              </span>
              <span v-if="!$v.title.maxLength" class="p-form__errorMsg" role="alert">
                <strong>50文字以内で入力をしてください</strong>
              </span>
          </dd>
        </dl>

        <dl>
          <dt><label for="category">カテゴリー<span>必須</span></label></dt>
          <dd>
            <select id="category" v-model="category_id">
              <option 
                v-for="option in options"
                :key="option.index" 
                :value="option.value">
                {{ option.text }}
              </option>
            </select>

            <span class="p-form__errorMsg" role="alert">
              <strong></strong>
            </span>
          </dd>
        </dl>

        <dl>
          <dt><label for="info">STEPの紹介文<span>必須</span></label></dt>
          <dd>
            <textarea 
              id="info" 
              v-model="info" 
              cols="30" rows="10"
              @blur="$v.info.$touch()"></textarea>
              <span v-if="!$v.info.required" class="p-form__errorMsg" role="alert">
                <strong>紹介文が入力されていません</strong>
              </span>
              <span v-if="!$v.info.maxLength" class="p-form__errorMsg" role="alert">
                <strong>500文字以内で入力をしてください</strong>
              </span>
          </dd>
        </dl>

        <dl>
          <dt><label for="time">達成目安時間<span>必須</span></label></dt>
          <dd>
            <input 
              id="time" 
              class="p-form-input__time" 
              v-model="time" 
              type="number" 
              placeholder="選択してください"
              @blur="$v.time.$touch()">時間
              <span v-if="!$v.time.required" class="p-form__errorMsg" role="alert">
                <strong>入力されていません</strong>
              </span>
          </dd>
        </dl>
      </div>

      <div class="p-form-submit">
        <input 
          class="c-btn" 
          type="button" 
          @click="nextStep" 
          value="Next"
          :disabled="$v.$invalid">
      </div>
    </div>
  </form>
</template>

<script>
import { required, maxLength } from 'vuelidate/lib/validators'

export default {
  name: 'StepForm01',
  data(){
    return{
      stepNumber: 2,
      title: null,
      info: null,
      time: null,
      category_id: '1',
      options: [
        { text: '動画編集', value: '1' },
        { text: 'プログラミング', value: '2' },
        { text: 'ダイエット', value: '3' },
        { text: 'フランス語', value: '4' }
      ]
    }
  },
  validations:{
    title: {
      required,
      maxLength: maxLength(50)
    },
    info: {
      required,
      maxLength: maxLength(500)
    },
    time: {
      required
    }
  },
	methods: {
		submit(){
			this.$emit('update',{
				title: this.title,
        category_id: this.category_id,
        info: this.info,
        time: this.time
			});
    },
    nextStep(){
      if(this.$v.$invalid){
        console.log('バリデーションエラー');
      }else{
        this.$emit('nextStep');
      }
    }
	}
}
</script>