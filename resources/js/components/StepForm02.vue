<template>
  <form @input="submit">
    <div class="p-form-inputs-wrapper">
      <div class="p-form-inputs --register">
        <div 
          v-for="kostep in kosteps"
          :key="kostep.index">
          <kostep-item
            :kostep="kostep"
            :nextBtn="nextBtn"
            @next="next"
            @updateForm="updateForm"></kostep-item>
        </div>
      </div>
    </div>
    <button
      type="button" 
      @click="add">STEPを追加する</button>
      
    <div class="p-form-submit">
      <button
        class="c-btn" 
        type="button" 
        @click="backStep">Back</button>
      <button
        class="c-btn" 
        type="button" 
        :disabled="!nextBtn"
        @click="nextStep">Next</button>
    </div>
  </form>
</template>

<script>
import KostepItem from './KostepItem.vue'
export default {
  components:{
    'kostep-item' : KostepItem
  },
  name: 'StepForm02',
  data(){
    return{
      nextBtn: false,
      kosteps:[
        {
        id: 1,
        title: null,
        info: null
        }
      ]
    }
  },

	methods: {
		submit(){
			this.$emit('update',{
			  kosteps: this.kosteps
			});
    },
		updateForm(formData){
			Object.assign(this.kosteps, formData);
    },
    add(){
      this.kosteps.push({
        id: this.kosteps.length + 1,
        title: null,
        info: null
      })
      this.nextBtn = false
    },
    next(val){
      this.nextBtn = val
    },
    backStep(){
      this.$emit('backStep');
    },    
    nextStep(){
      if(this.nextBtn == false){
        console.log('バリデーションエラー');
      }else{
        this.$emit('nextStep');
      }
    }
	}
}
</script>