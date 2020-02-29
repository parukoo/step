<template>
  <div>
    <dl>
      <dt><label for="title">学習FLOW（{{ value.flow_id }}）：タイトル<span>必須</span></label></dt>
      <dd>
        <input 
          id="title" 
          type="text" 
          v-model="title"
          placeholder="50文字以内で入力してください"
          @blur="$v.value.title.$touch()">
        <div v-if="$v.value.title.$error">
          <span v-if="!$v.value.title.required" class="p-form__errorMsg" role="alert">
            <strong>タイトルが入力されていません</strong>
          </span>
          <span v-if="!$v.value.title.maxLength" class="p-form__errorMsg" role="alert">
            <strong>50文字以内で入力をしてください</strong>
          </span>
        </diV>
      </dd>
    </dl>
    <dl>
      <dt><label for="info">学習FLOW（{{ value.flow_id }}）：内容<span>必須</span></label></dt>
      <dd>
        <textarea 
          id="info" 
          v-model="info" 
          cols="30" rows="10"
          placeholder="1000文字以内で入力をしてください"
          @blur="$v.value.info.$touch()"></textarea>
        <div v-if="$v.value.info.$error">
          <span v-if="!$v.value.info.required" class="p-form__errorMsg" role="alert">
            <strong>学習内容が入力されていません</strong>
          </span>
          <span v-if="!$v.value.info.maxLength" class="p-form__errorMsg" role="alert">
            <strong>1000文字以内で入力をしてください</strong>
          </span>
        </diV>
      </dd>
    </dl>
  </div>
</template>
<script>
import { required, maxLength } from 'vuelidate/lib/validators'
export default {
  name: 'FormKostepitem',
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
      get: function() {
        return this.value.title
      },
      set: function(title) {
        this.updateValue({ title })
      }
    },
    info: {
      get: function() {
        return this.value.info
      },
      set: function(info) {
        this.updateValue({ info })
      }
    }
  },
  // 入力を監視し、親コンポーネントへアップデート
  watch:{
    '$v.$invalid': function(newVal, oldVal) {
      this.value.edit = newVal
      this.updateValue(this.value.edit)
    }
  },
  methods:{
    updateValue: function(diff) {
      this.$emit('input', { ...this.value, ...diff })
    }
  }
}
</script>