<template>
  <a 
  :href="'/steps/' + kostep.step_id + '/' + kostep.flow_id" :class="{ active: kostep.isDone }">
    <div class="p-flow-item-txtWrapper">
      <h4>{{ kostep.title }}</h4>
      <p>{{ kostep.info }}</p>
    </div>
    <span class="p-flow-item__btn" :class="{ active: kostep.isDone }">
      <i class="p-flow-item__btn-icon fas fa-check" :class="{ active: kostep.isDone }"></i>
    </span>
  </a>
</template>

<script>
  export default {
    name: 'StepFlowitem',
    props:{
      kostep: { type: Object, required: true }
    }
  }
</script>