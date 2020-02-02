<template>
  <div class="p-step-single">
    <step-flowheader
      :complete="complete"
      :step="step"></step-flowheader>
    <div class="p-wrapper--step">
      <div class="p-container">
        <div class="p-headingWrapper">
          <h3 class="p-flow__title p-heading"><span>S</span>tep Flow</h3>
          <span class="p-heading-sub">stepの流れ</span>
        </div>
        <step-flowlist
          :kosteps="kosteps"></step-flowlist>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import StepFlowheader from './StepFlowheader.vue';
  import StepFlowlist from './StepFlowlist.vue';
  export default {
    name: 'StepFlow',
    props:{
      stepid: { type: Number, required: true },
      complete: { type: Number, required: true }
    },
    data(){
      return{
        step: {
          id: null,
          title: null,
          category:{
            name: null
          },
          user:{
            name: null
          },
          time: null
        },
        kosteps: []
      }
    },
    mounted() {
      axios.get('/ajax/stepFlow', {
        params:{
          stepid: this.stepid,
        }
      }).then(response => {
        console.log(response);
        this.step = response.data[0];
        console.log(this.step);
        this.kosteps = response.data[1];
        console.log(this.kosteps);
      })
      .catch(error => {
          console.log('データの取得に失敗しました。');
      });
    }
  }
</script>