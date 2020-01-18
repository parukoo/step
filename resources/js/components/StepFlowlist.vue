<template>
  <ul class="p-flow-list">
    <li v-for="kostep in kosteps"
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
      kosteps: Array,
      step: Object
    },
    data(){
      return{
      }
    },

  }
</script>