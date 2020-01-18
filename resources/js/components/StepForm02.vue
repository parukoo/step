<template>
  <form @input="submit">
    <div class="p-form-inputs-wrapper">
      <div class="p-form-inputs --register">
        <div 
          v-for="kostep in kosteps"
          :key="kostep.index">
          <kostep-item
            :kostep="kostep"
            @update="updateForm"></kostep-item>
        </div>
      </div>
      <div>
        <button @click="add">ステップを追加する</button>
      </div>
    </div>
    <div class="p-form-submit">
      <input 
        class="c-btn" 
        type="button" 
        value="Next">
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
      // console.log('aaa');
    }
	}
}
</script>