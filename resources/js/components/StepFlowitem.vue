<template>
  <a :href="`/steps/${stepId}/${kostep.flow_id}`">
    <div class="p-flow-item-txtWrapper">
      <h4>{{ kostep.title }}</h4>
      <p>{{ kostep.info }}</p>
    </div>
    <span class="p-flow-item-btn">
      <img style="width: 24px" :src="'/img/common/ico_check.svg'" alt="">
    </span>
  </a>
</template>

<script>
  export default {
    name: 'StepFlowitem',
    props:{
      kostep: Object,
      step: Object
    },
    data(){
      return{
        stepId: 1,
      }
    }
  }
</script>