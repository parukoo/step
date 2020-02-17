<template>
  <div class="p-form-inputs-wrapper">
    <div class="p-form-inputs as_register as_confirm">
        <dl>
          <dt>STEPのタイトル</dt>
          <dd>{{ form.title }}</dd>
        </dl>

        <dl>
          <dt>カテゴリー</dt>
          <dd>{{ category[0].name }}</dd>
        </dl>

        <dl>
          <dt>STEPの内容</dt>
          <dd>{{ form.info }}</dd>
        </dl>

        <dl>
          <dt>達成目安時間</dt>
          <dd>{{ form.time }}時間</dd>
        </dl>

        <dl>
          <dt>アイキャッチ画像</dt>
          <dd><img :src="url"
              /></dd>
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

    <div class="p-form-submit as_stepform">
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
    form: { type: Object, equired: true},
    categories: { type: Array, required: true},
  },
  data: function(){
    return{
      url: this.form.uploadedImage[0].name
    }
  },
  computed: {
    category: function(){
      return this.categories.filter( x => x.id === this.form.category_id);
    }
  },
  methods:{
    // 前に戻る
    backStep: function(){
      this.$emit('backStep');
    },    
    // 編集データをAJAXでPOST送信
    submit: function(){
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