<template>
  <ul class="p-flow-list">
    <li v-for="kostep in filterkosteps"
      :key="kostep.id">
      <step-flowitem
        :kostep="kostep"></step-flowitem>
    </li>
  </ul>
</template>
<script>
  import StepFlowitem from './StepFlowitem.vue';
  export default {
    name: 'StepFlowlist',
    props:{
      kosteps: { type: Array, required: true },
      completes: { type: Array, required: true }
    },
    data(){
      return{
        kostep:{}
      }
    },
    computed:{
      filterkosteps(){
        // return this.kosteps

      // // this.kosteps.forEach((kostep) =>
      // //   { console.log(this.completes.includes(kostep.id))});

        return this.kosteps.forEach((kostep, i) => {
          if(this.completes.includes(kostep.id)){
            // kostep['isDone'] = true
            // this.$set(array, key, val);
            // this.$set(this.kostep,'isDone', true);
            this.$set(this.kosteps[i], "isDone", true);
          }else{
            kostep['isDone'] = false
            this.$set(this.kosteps[i], "isDone", false);
          }
          
        });
        console.log(this.kosteps)

      }
    }
  }
</script>