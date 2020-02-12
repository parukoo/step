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
          <dd>{{ form.time }}</dd>
        </dl>

        <div v-for="kostep in form.kosteps"
          :key="kostep.id">
          <dl>
            <dt>STEPのFLOW{{ kostep.flow_id }}のタイトル</dt>
            <dd>{{ kostep.title }}</dd>
          </dl>
          <dl>
            <dt>内容</dt>
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
        @click="submit">編集する</button>
    </div>

  </div>
</template>

<script>
const axios = require('axios'); 
export default {
  name: 'StepEditform03',
  props:{
    form: Object
  },
  methods:{
    // 前に戻る
    backStep(){
      this.$emit('backStep');
    },    
    // 編集データをAJAXでPOST送信
    submit(){
      axios.post('/ajax/stepUpdate', this.form)
      .then( (response) => {
      })
      .catch((error) => {
        console.log(error);
      });
      this.$emit('nextStep')
    }
  }
}
</script>