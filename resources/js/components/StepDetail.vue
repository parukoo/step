<template>
<div class="p-stepSingle">
  <step-detailcontent
    :kostep="kostep"
    :stepId="stepId"
    @done="done"></step-detailcontent>
  <step-detailmenu
    :kosteps="kosteps"
    :stepId="stepId"></step-detailmenu>
</div>
</template>
<script>
  import StepDetailmenu from './StepDetailmenu';
  const axios = require('axios'); 
  export default {
    name: 'StepDetail',
    props:{
      stepid: Number,
      flowid: Number
    },
    data(){
      return{
        stepId: this.stepid,
        flowId: this.flowid,
        keyId: this.flowid - 1,
        kosteps:[],
        kostep:''
      }
    },
    methods:{
      done(kostep, completed){
        axios.post('/ajax/complete',{
          id: kostep.id,
          completed: completed
        }).then((response) => {
          this.kostep = response.data;
          console.log(this.flowId);
          this.flowId++;
          console.log(this.flowId);
          stepid = this.stepId;
          flowid = this.flowId;
          setTimeout(function(){
            var url = 'http://localhost:8000/steps/1/'+ this.flowId++;
            console.log(url)
            window.location.href = url;
          }, 1000);
        })
        .catch(error => {
            console.log('データの取得に失敗しました。: ' + response.data);
        });
      },
    },
    mounted() {
      var keyId = this.keyId;
      axios.get('/ajax/kosteps/' + this.stepId)
      .then(response => {
        this.kosteps = response.data;
        this.kostep = response.data[keyId];
        console.log(this.kostep);
      })
      .catch(error => {
          console.log('データの取得に失敗しました。');
      });
      
    }
  }
</script>