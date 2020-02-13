<template>
  <div class="p-form-inputs-wrapper">
    <div class="p-form-inputs --register --confirm">
        <dl>
          <dt>STEPのタイトル</dt>
          <dd>{{ form.title }}</dd>
        </dl>

        <dl>
          <dt>カテゴリー</dt>
          <dd>{{ form.category_id }}</dd>
        </dl>

        <dl>
          <dt>STEPの内容</dt>
          <dd>{{ form.info }}</dd>
        </dl>

        <dl>
          <dt>達成目安時間</dt>
          <dd>{{ form.time }}時間</dd>
        </dl>

        <div v-for="kostep in form.kosteps"
          :key="kostep.id">
          <dl>
            <dt>STEPのFLOW({{ kostep.flow_id }})のタイトル</dt>
            <dd>{{ kostep.title }}</dd>
          </dl>
          <dl>
            <dt>STEPのFLOW({{ kostep.flow_id }})の内容</dt>
            <dd>{{ kostep.info }}</dd>
          </dl>
        </div>
    </div>

    <div class="p-form-submit --stepform">
      <button
        class="c-btn" 
        type="button" 
        @click="backStep">戻る</button>
      <button
        class="c-btn" 
        type="button" 
        @click="submit">登録する</button>
    </div>

  </div>
</template>

<script>
const axios = require('axios'); 
export default {
  name: 'StepForm03',
  props:{
    form: { type: Object, equired: true},
    categories: { type: Array, required: true},
  },
  methods:{
    //戻る
    backStep(){
      this.$emit('backStep');
    },    
    //AJAXでSTEPを新規登録し、次に進む
    submit(){
      console.log(this.form);
      axios.post('/ajax/stepNew', this.form)
      .then( (response) => {
        this.$emit('nextStep');
      })
      .catch(e => {
        console.log(e.response.data.errors)
      })
    }
  }
}
</script>