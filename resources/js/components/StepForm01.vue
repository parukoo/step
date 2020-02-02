<template>
  <form>
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
          <dt><label for="category-form">カテゴリー<span>必須</span></label></dt>
          <dd>
            <select id="category-form" v-model="category_id">
              <option 
                v-for="category in categories"
                :key="category.id" 
                :value="category.id">
                {{ category.name }}
              </option>
            </select>
            <span v-if="!$v.category_id.required" class="p-form__errorMsg" role="alert">
              <strong>選択されていません</strong>
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
          :disabled="$v.$invalid" 
          value="Next">
      </div>
    </div>
  </form>
</template>

<script>
import { required, maxLength } from 'vuelidate/lib/validators'

export default {
  name: 'StepForm01',
  props:{
    value: { type: Object, required: true},
    categories: { type: Array, equired: true}
  },
  data(){
    return{
      stepNumber: 2
    }
  },
  validations:{
    title: {
      required,
      maxLength: maxLength(50)
    },
    category_id: {
      required
    },
    info: {
      required,
      maxLength: maxLength(500)
    },
    time: {
      required
    }  
  },
  computed:{
    title: {
      get() {
        return this.value.title
      },
      set(title) {
        this.updateValue({ title })
      }
    },
    category_id: {
      get() {
        return this.value.category_id
      },
      set(category_id) {
        this.updateValue({ category_id })
      }
    },
    info: {
      get() {
        return this.value.info
      },
      set(info) {
        this.updateValue({ info })
      }
    },
    time: {
      get() {
        return this.value.time
      },
      set(time) {
        this.updateValue({ time })
      }
    }
  },
	methods: {
    nextStep(){
      if(this.$v.$invalid){
        console.log('バリデーションエラー');
      }else{
        this.$emit('nextStep');
      }
    },
    updateValue(diff) {
      this.$emit('input', { ...this.value, ...diff })
    }
	}
}
</script>