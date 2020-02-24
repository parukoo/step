<template>
  <form>
    <div class="p-form-inputs-wrapper">
      <div class="p-form-inputs as_register">
        <form-kostepitem
          v-for="(item, index) in value"
          :key="index"
          :value="value[index]"
          @input="value => updateItem(value, index)"></form-kostepitem>
      </div>
    </div>
    <div class="p-form-add">
    <button
      type="button" 
      @click="add">STEPを追加する</button>
    </div>
      
    <div class="p-form-submit as_stepform">
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
import FormKostepitem from './FormKostepitem.vue'
export default {
  components:{
    'form-kostepitem' : FormKostepitem
  },
  name: 'FormeditKostep',
  props:{
    value: { type: Array, required: true }
  },
  data: function () {
    return{
      editFlag: false
    }
  },
  //タイトルと内容両方とも入力済みか判断
  watch:{
    value: {
      deep: true,
      handler: function(newVal, oldVal) {
        if(newVal.every(item => item.edit === false)){
          this.editFlag = false
        }else{
          this.editFlag = true
        }
      }
    }
  },
	methods: {
    //入力値をアップデート
    updateItem: function(item, index) {
      const newValue = [
        ...this.value.slice(0, index),
        item,
        ...this.value.slice(index + 1)
      ]
      this.$emit('input', newValue)
    },
    //子STEPを追加する
    add: function(){
      this.value.push({
        flow_id: this.value.length + 1,
        title: null,
        info: null,
        edit: true
      })
      this.nextBtn = false
    },
    //前に戻る
    backStep: function(){
      this.$emit('backStep');
    },    
    //次に進む
    nextStep: function(){
      this.$emit('nextStep');
    }
	}
}
</script>