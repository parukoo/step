<template>
  <form>
    <div class="p-form-inputs-wrapper">
      <div class="p-form-inputs --register">
        <kostep-item
          v-for="(item, index) in value"
          :key="index"
          :value="value[index]"
          @input="value => updateItem(value, index)"></kostep-item>
      </div>
    </div>
    
    <div class="p-form-add">
      <button
        type="button" 
        @click="add">STEPを追加する</button>
    </div>

    <div class="p-form-submit --stepform">
      <button
        class="c-btn" 
        type="button" 
        @click="backStep">戻る</button>
      <button
        class="c-btn" 
        type="button" 
        :disabled="editFlag"
        @click="nextStep">次へ</button>
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
    value: { type: Array, required: true }
  },
  data(){
    return{
      editFlag: true
    }
  },
  watch:{
    value: {
      deep: true,
      handler(newVal, oldVal) {
        if(newVal.every(item => item.edit === false)){
          this.editFlag = false
        }else{
          this.editFlag = true
        }
      },
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
    },
    add(){
      this.value.push({
        flow_id: this.value.length + 1,
        title: null,
        info: null,
        edit: true
      })
      this.nextBtn = false
    },
    backStep(){
      this.$emit('backStep');
    },    
    nextStep(){
      this.$emit('nextStep');
    }
	}
}
</script>