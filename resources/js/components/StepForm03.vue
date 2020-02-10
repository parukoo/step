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
          <dt>STEPの紹介文</dt>
          <dd>{{ form.info }}</dd>
        </dl>

        <dl>
          <dt>達成目安時間</dt>
          <dd>{{ form.time }}</dd>
        </dl>

        <div v-for="kostep in form.kosteps"
          :key="kostep.id">
          <dl>
            <dt>子STEP</dt>
            <dd>{{ kostep.flow_id }}</dd>
          </dl>
          <dl>
            <dt>タイトル</dt>
            <dd>{{ kostep.title }}</dd>
          </dl>
          <dl>
            <dt>説明</dt>
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
    form: Object
  },
  methods:{
    backStep(){
      this.$emit('backStep');
    },    
    submit(){
      console.log(this.form);
      axios.post('/ajax/stepNew', this.form)
      .then( (response) => {
        console.log(response);
        this.$emit('nextStep');
      })
      .catch(e => {
        console.log(e.response.data.errors)
      })
    }
  }
}
</script>