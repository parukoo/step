<template>
  <div class="p-stepSingle-content">
    <span class="p-stepSingle-content-count">FLOW {{ kostep.flow_id }}</span>
    <h3 class="p-stepSingle-content-title">{{ kostep.title }}</h3>
    <p>{{ kostep.info }}</p>
    <div class="p-stepSingle-btns">
      <span
        class="c-btn p-stepSingle-btn" 
        :class="{ done : kostep.completed}"
        @click="done()">完了<span>済</span></span>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'StepDetailcontent',
    props:{
      kostep: Object,
      stepId: Object
    },
    data(){
      return{
        nextId: ''
      }
    },
    computed:{
      nextId(){
        return this.kostep.flow_id;
      }
    },
    methods:{
      done(){
        this.$emit('done', this.kostep, !this.kostep.completed);
      }
    }
  }
</script>
<style scoped>
.c-btn span{
  display: none;
}
.c-btn.done{
  background-color: #fabe00
}
.c-btn.done span{
  display: inline;
}
</style>
