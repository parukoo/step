<template>
<div class="p-stepSingle">
  <step-detailcontent
    :kostep="kostep"
    @completed="done"></step-detailcontent>
  <step-detailmenu
    :flowmenu="flowmenu"></step-detailmenu>
</div>
</template>
<script>
  import StepDetailcontent from './StepDetailcontent';
  import StepDetailmenu from './StepDetailmenu';
  const axios = require('axios'); 
  export default {
    name: 'StepDetail',
    props:{
      stepid: { type:Number, required: true },
      flowid: { type:Number, required: true }
    },
    data(){
      return{
        kostep:{},
        flowmenu: []
      }
    },
    methods:{
      done(kostep){
        axios.post('/ajax/completed',{
          id: kostep.id,
          flow_id: kostep.flow_id,
          completed: !kostep.completed
        }).then((response) => {
          console.log(response);
          this.$set(this.kostep, "completed", response.data.completed);
          console.log(this.kostep.completed);
          if(this.kostep.completed){
            if(this.kostep.flow_id === this.flowmenu.length){
              console.log('最後のページです');
            }else{
              setTimeout( () => {
                var url = '/steps/' + this.stepid + '/' + (this.flowid + 1);
                console.log(url);
                window.location.href = url;
              }, 1000)
            }
          }
        }).catch(error => {
          console.log('データの取得に失敗しました。: ' + res.data);
        });
      }
    },
    mounted() {
      axios.get('/ajax/kostepDetail', {
        params:{
          stepid: this.stepid,
          flowid: this.flowid
        }
      }).then(response => {
        this.kostep = response.data[0];
        console.log(this.kostep);
        this.flowmenu = response.data[1];
        console.log(this.flowmenu);
      })
      .catch(error => {
          console.log('データの取得に失敗しました。');
      });
    }
  }
</script>