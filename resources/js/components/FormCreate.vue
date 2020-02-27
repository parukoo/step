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
        @updateFile="updatedFile"
        @updateImage="updatedImage"
        v-if="stepNumber === 1" 
        v-model="form"
        :categories="categories"
        @nextStep="nextStep"></form-step>

      <form-kosteplist 
        v-if="stepNumber === 2"
        v-model="form.kosteps"
        @backStep="backStep" 
        @nextStep="nextStep" 
        ></form-kosteplist>

      <form-comfirm
        :form ="form"
        :previeFile="previeFile"
        :categories="categories"
        @backStep="backStep" 
        @nextStep="nextStep" 
        v-if="stepNumber === 3"></form-comfirm>
      <form-done v-if="stepNumber === 4"></form-done>
    </keep-alive>

  </div>
</template>

<script>

import FormStep from './FormStep.vue'
import FormKosteplist from './FormKosteplist.vue'
import FormComfirm from './FormComfirm.vue'
import FormDone from './FormDone.vue'

export default {
  name: 'FormCreate',
  components:{
    'form-step' : FormStep,
    'form-kosteplist' : FormKosteplist,
    'form-comfirm' : FormComfirm,
    'form-done' : FormDone,
  },
  props:{
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
        uploadedImage: [],
        kosteps: [
          {
            flow_id: 1,
            title: null,
            info: null,
            edit: true
          }
        ]
      },
      previeFile: null,
      isActive: 'is-active'
    }
  },
	methods:{
    updatedFile: function(files){
      this.form.uploadedImage = files;
    },
    updatedImage: function(image){
      this.previeFile = image;
    },
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
	}
}
</script>