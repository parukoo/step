<template>
  <div class="p-form as_register">
    <ul class="p-form-flow">
      <li class="p-form-flow__item" :class="bgColor(1)"><span>STEP1</span>STEPの入力①</li>
      <li class="p-form-flow__item" :class="bgColor(2)"><span>STEP2</span>STEPの入力②</li>
      <li class="p-form-flow__item" :class="bgColor(3)"><span>STEP3</span>STEPの内容確認</li>
      <li class="p-form-flow__item" :class="bgColor(4)"><span>STEP4</span>STEPの入力完了</li>
    </ul>

    <keep-alive>
      <step-form01 
        v-if="stepNumber === 1"
        v-model="form"
        :categories="categories"
        @nextStep="nextStep"></step-form01>

      <step-editform02 
        v-if="stepNumber === 2"
        v-model="form.kosteps"
        @backStep="backStep" 
        @nextStep="nextStep" 
        ></step-editform02>

      <step-editform03
        :form ="form"
        @backStep="backStep" 
        @nextStep="nextStep" 
        v-if="stepNumber === 3"></step-editform03>
      <step-form04 v-if="stepNumber === 4"></step-form04>
    </keep-alive>

  </div>
</template>

<script>

import StepForm01 from './StepForm01.vue'
import StepEditform02 from './StepEditform02.vue'
import StepEditform03 from './StepEditform03.vue'
import StepForm04 from './StepForm04.vue'
const axios = require('axios'); 
export default {
  name: 'StepEditform',
  components:{
    'step-form01' : StepForm01,
    'step-editform02' : StepEditform02,
    'step-editform03' : StepEditform03,
    'step-form04' : StepForm04,
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