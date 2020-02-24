<template>
  <div class="p-form as_register">
    <ul class="p-form-flow">
      <li class="p-form-flow__item" :class="bgColor(1)"><span>STEP1</span>STEPの入力①</li>
      <li class="p-form-flow__item" :class="bgColor(2)"><span>STEP2</span>STEPの入力②</li>
      <li class="p-form-flow__item" :class="bgColor(3)"><span>STEP3</span>STEPの内容確認</li>
      <li class="p-form-flow__item" :class="bgColor(4)"><span>STEP4</span>STEPの入力完了</li>
    </ul>

    <keep-alive>
      <form-step 
        v-if="stepNumber === 1"
        v-model="form"
        :categories="categories"
        @nextStep="nextStep"></form-step>

      <formedit-kosteplist 
        v-if="stepNumber === 2"
        v-model="form.kosteps"
        @backStep="backStep" 
        @nextStep="nextStep" 
        ></formedit-kosteplist>

      <formedit-comfirm
        :form ="form"
        :categories="categories"
        @backStep="backStep" 
        @nextStep="nextStep" 
        v-if="stepNumber === 3"></formedit-comfirm>
      <form-done v-if="stepNumber === 4"></form-done>
    </keep-alive>

  </div>
</template>

<script>

import FormStep from './FormStep.vue'
import FormeditKosteplist from './FormeditKosteplist.vue'
import FormeditComfirm from './FormeditComfirm.vue'
import FormDone from './FormDone.vue'
const axios = require('axios'); 
export default {
  name: 'FormEdit',
  components:{
    'form-step' : FormStep,
    'formedit-kosteplist' : FormeditKosteplist,
    'formedit-comfirm' : FormeditComfirm,
    'form-done' : FormDone,
  },
  props:{
    stepid: { type: Number, required: true },
    categories: { type: Array, required: true }
  },
  data: function () {
    return{
      stepNumber: 1,
      form: {
        title: null,
        category_id: null,
        info: null,
        time: null,
        kosteps: [
          {
            flow_id: null,
            title: null,
            info: null,
            edit: false
          }
        ]
      },
      isActive: 'is-active'
    }
  },
	methods:{
    // マルチフォームのメニュースタイル（現在地をアクティブにする）
    bgColor: function(number){
      if(number === this.stepNumber){
        return this.isActive;
      }else{
        return !this.isActive;
      }
    },
    //前に戻る
    backStep: function(){
      this.stepNumber--;
    },		
    //次に進む	
    nextStep: function(){
      this.stepNumber++;
    }
  },
  //STEPデータをAJAXで取得
  mounted: function(){
    axios.get('/ajax/stepEditflow', {
      params:{
        stepid: this.stepid,
      }
    }).then(response => {
      this.form = response.data[0];
      this.form.kosteps = response.data[0].kosteps;
      for(let i = 0; i < this.form.kosteps.length; i++) {
        this.$set(this.form.kosteps[i], "edit", false);
      }  
    })
    .catch(error => {
        console.log('データの取得に失敗しました。');
    });
  }
}
</script>