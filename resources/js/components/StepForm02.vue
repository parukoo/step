<template>
  <form>
    <div class="p-form-inputs-wrapper">
      <div class="p-form-inputs --register">
        <kostep-item
          v-for="(item, index) in value"
          :key="index"
          :value="value[index]"
          @input="value => updateItem(value, index)"
          :nextBtn="nextBtn"
          @next="next"></kostep-item>
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
  props:{
    value: { type:Array, required: true }
  },
  data(){
    return{
      nextBtn: false
    }
  },

	methods: {
    updateItem(item, index) {
      const newValue = [
        ...this.value.slice(0, index),
        item,
        ...this.value.slice(index + 1)
      ]
      this.$emit('input', newValue)
      console.log('親')
    },
    add(){
      this.value.push({
        flow_id: this.value.length + 1,
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