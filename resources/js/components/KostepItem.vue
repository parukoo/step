<template>
  <div>
    <dl>
      <dt><label for="title">{{ value.flow_id }}:子STEPのタイトル<span>必須</span></label></dt>
      <dd>
        <input 
          id="title" 
          type="text" 
          v-model="title"
          placeholder="50文字以内で入力してください">
        <span v-if="!$v.value.title.required" class="p-form__errorMsg" role="alert">
          <strong>タイトルが入力されていません</strong>
        </span>
        <span v-if="!$v.value.title.maxLength" class="p-form__errorMsg" role="alert">
          <strong>50文字以内で入力をしてください</strong>
        </span>
      </dd>
    </dl>
    <dl>
      <dt><label for="info">STEPの紹介文<span>必須</span></label></dt>
      <dd>
        <textarea 
          id="info" 
          v-model="info" 
          cols="30" rows="10"></textarea>
        <span v-if="!$v.value.info.required" class="p-form__errorMsg" role="alert">
          <strong>紹介文が入力されていません</strong>
        </span>
        <span v-if="!$v.value.info.maxLength" class="p-form__errorMsg" role="alert">
          <strong>1000文字以内で入力をしてください</strong>
        </span>
      </dd>
    </dl>
  </div>
</template>
<script>
import { required, maxLength } from 'vuelidate/lib/validators'
export default {
  name: 'KostepItem',
  props: {
    value: { type: Object, required: true },
  },
  // バリデーションチェック
  validations:{
    value:{
      title:{
        required,
        maxLength: maxLength(50)
      },
      info: {
        required,
        maxLength: maxLength(1000)
      }
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
    info: {
      get() {
        return this.value.info
      },
      set(info) {
        this.updateValue({ info })
      }
    }
  },
  watch:{
    '$v.$invalid': function(newVal, oldVal) {
      this.value.edit = newVal
      this.updateValue(this.value.edit)
    }
  },
  methods:{
    updateValue(diff) {
      this.$emit('input', { ...this.value, ...diff })
    }
  }
}
</script>