<template>
  <div class="p-rowposts">
    <div 
      v-for="step in steps"
      class="p-rowpost"
      :key="step.id">
      <step-item
        :step="step"></step-item>
    </div>
  </div>
</template>

<script>
  import StepItem from './StepItem.vue';
  const axios = require('axios'); 
  export default {
    name: 'StepList',
    data(){
      return{
        steps:[]
      }
    },
    mounted() {
      var self = this;
      axios.get('/ajax/steps').then(response => {
        self.steps = response.data;
      });
    }
  }
</script>
