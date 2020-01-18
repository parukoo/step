<template>
  <div class="p-stepSingle-menu">
    <h4 class="p-stepSingle-menu-title">STEP学習一覧</h4>
    <ul>
      <li 
      v-for="kostep in kosteps"
      :class="{ done : kostep.completed}"
      :key="kostep.id">
      <a :href="`/steps/${stepId}/${kostep.flow_id}`">{{ kostep.title }}</a></li>
    </ul>
  </div>
</template>

<script>
  export default {
    name: 'StepDetailmenu',
    props:{
      kosteps: Array,
      stepId: Number
    },
    data(){
      return{

      }
    }
  }
</script>
<style scoped>
li.done{
  background-color: #f1f1f1;
}
</style>