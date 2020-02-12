<template>
  <div class="p-round">
    <step-indexlist 
      :steps="steps"
      v-for="steps in stepslist"
      :key="steps.key"></step-indexlist>
  </div>
</template>
<script>
import axios from 'axios';
import StepIndexlist from './StepIndexlist.vue';
export default {
  name: 'StepIndex',
  props: {
  },
  data(){
    return{
      stepslist:[]
    }
  },

  //STEPデータをAJAXで取得
  mounted() {
    axios.get('/ajax/all')
    .then(response => {
      this.stepslist = response.data;
    })
    .catch(error => {
        console.log('データの取得に失敗しました。');
    });
  }
}
</script>