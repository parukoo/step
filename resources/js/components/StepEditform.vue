<template>
  <div class="p-form --register">
    <ul class="p-form-flow">
      <li class="p-form-flow__item is-active"><a href="/"><span>STEP1</span>STEPの入力①</a></li>
      <li class="p-form-flow__item"><a href="/"><span>STEP2</span>STEPの入力②</a></li>
      <li class="p-form-flow__item"><a href="/"><span>STEP3</span>STEPの内容確認</a></li>
      <li class="p-form-flow__item"><a href="/"><span>STEP4</span>STEPの入力完了</a></li>
    </ul>

    <keep-alive>
      <step-form01 
        v-if="stepNumber === 1"
        v-model="form"
        :categories="categories"
        @nextStep="nextStep"></step-form01>

      <step-form02 
        v-if="stepNumber === 2"
        v-model="form.kosteps"
        @backStep="backStep" 
        @nextStep="nextStep" 
        ></step-form02>

      <step-form03
        :form ="form"
        @backStep="backStep" 
        @nextStep="nextStep" 
        v-if="stepNumber === 3"></step-form03>
      <step-form04 v-if="stepNumber === 4"></step-form04>
    </keep-alive>

  </div>
</template>

<script>

import StepForm01 from './StepForm01.vue'
import StepForm02 from './StepForm02.vue'
import StepForm03 from './StepForm03.vue'
import StepForm04 from './StepForm04.vue'
const axios = require('axios'); 
export default {
  name: 'StepEditform',
  components:{
    'step-form01' : StepForm01,
    'step-form02' : StepForm02,
    'step-form03' : StepForm03,
    'step-form04' : StepForm04,
  },
  props:{
    stepid: { type:Number, required: true },
    categories: { type:Array, required: true }
  },
  data(){
    return{
      stepNumber: 1,
      form: {
        title: null,
        category_id: null,
        info: null,
        time: null,
        kosteps: null
      }
    }
  },
	methods:{
		// updateForm(formData){
		// 	Object.assign(this.form, formData);
    // },
    backStep(){
      this.stepNumber--;
    },			
    nextStep(){
      this.stepNumber++;
    }
  },
  mounted(){
    axios.get('/ajax/stepEditflow', {
      params:{
        stepid: this.stepid,
      }
    }).then(response => {
      this.form = response.data[0];
      console.log(this.form);
    })
    .catch(error => {
        console.log('データの取得に失敗しました。');
    });
  }
}
</script>