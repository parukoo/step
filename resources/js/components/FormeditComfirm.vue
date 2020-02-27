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
          <dd>
            <img v-if="!url" class="js-objectfit" :src="'../../img/common/img_noimage.jpg'"/>
            <img v-else class="js-objectfit" :src="url"/>
          </dd>
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
  name: 'FormeditComfirm',
  props:{
    form: { type: Object, equired: true},
    categories: { type: Array, required: true},
    previeFile: { type: String, required: true},
  },
  computed: {
    url: function(){
      if(this.previeFile){
        return this.previeFile;
      }else{
        return null;
      }
    },
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
      //送信データはFormDataを使うよ！
      let data = new FormData;
      let kosteps = this.form.kosteps;
      data.append('id', this.form.id);
      data.append('title', this.form.title);
      data.append('category_id', this.form.category_id);
      data.append('info', this.form.info);
      data.append('time', this.form.time);
      if(this.url){
        data.append('uploadedImage', this.form.uploadedImage[0]);
      }
      kosteps.forEach((kostep, i) => {
        Object.keys(kostep).forEach(function (key) {
          data.append('kosteps'+ '[' + i + ']' + '[' + key +']', kostep[key]);
        });
      });
      let config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      };
      axios.post('/ajax/stepUpdate', data, config)
      .then( (response) => {
        this.$emit('nextStep')
      })
      .catch((error) => {
        console.log(e.response.data.errors)
      });
    }
  }
}
</script>