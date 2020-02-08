<template>
  <div class="p-form --register">
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

export default {
  name: 'StepForm',
  components:{
    'step-form01' : StepForm01,
    'step-form02' : StepForm02,
    'step-form03' : StepForm03,
    'step-form04' : StepForm04,
  },
  props:{
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
        // uploadedImage: null,
        kosteps: [
          {
            flow_id: 1,
            title: null,
            info: null,
            edit: true
          }
        ]
      },
      isActive: 'is-active'
    }
  },
	methods:{
    bgColor(number){
      if(number === this.stepNumber){
        return this.isActive;
      }else{
        return !this.isActive;
      }
    },
    backStep(){
      this.stepNumber--;
    },			
    nextStep(){
      this.stepNumber++;
    },
    // fileupload(file){
    //   const formData = new FormData()
    //   formData.append('file', file);
    //   // this.form.uploadedImage = file;
    //   console.log(formData.entries());
    // }
	}
}
</script>