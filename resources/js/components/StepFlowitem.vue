<template>
  <a :href="'/steps/' + kostep.step_id + '/' + kostep.flow_id">
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
      kostep: { type:Object, required: true }
    },
    data(){
      return{
      }
    }
  }
</script>