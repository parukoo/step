<template>
  <div>
    <dl>
      <dt><label for="title">{{ kostep.id }}:子STEPのタイトル<span>必須</span></label></dt>
      <dd>
        <input 
          id="title" 
          type="text" 
          v-model="kostep.title"
          @input="update" 
          placeholder="50文字以内で入力してください">
        <span v-if="!$v.kostep.title.required" class="p-form__errorMsg" role="alert">
          <strong>タイトルが入力されていません</strong>
        </span>
        <span v-if="!$v.kostep.title.maxLength" class="p-form__errorMsg" role="alert">
          <strong>50文字以内で入力をしてください</strong>
        </span>
      </dd>
    </dl>
    <dl>
      <dt><label for="info">STEPの紹介文<span>必須</span></label></dt>
      <dd>
        <textarea 
          id="info" 
          v-model="kostep.info"
          @input="update" 
          cols="30" rows="10"></textarea>
        <span v-if="!$v.kostep.info.required" class="p-form__errorMsg" role="alert">
          <strong>紹介文が入力されていません</strong>
        </span>
        <span v-if="!$v.kostep.info.maxLength" class="p-form__errorMsg" role="alert">
          <strong>500文字以内で入力をしてください</strong>
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
    kostep: Object
  },
  validations:{
    kostep: {
      title:{
        required,
        maxLength: maxLength(50)
      },
      info: {
        required,
        maxLength: maxLength(500)
      }
    }
  },
  methods:{
		update(){
			this.$emit('updateForm',{
        id: this.id,
				title: this.title,
        info: this.info
			});
    }
  }
}
</script>