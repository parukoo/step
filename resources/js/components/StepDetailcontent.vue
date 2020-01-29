<template>
  <div class="p-stepSingle-content">
    <span class="p-stepSingle-content-count">FLOW {{ kostep.flow_id }}</span>
    <h3 class="p-stepSingle-content-title">{{ kostep.title }}</h3>
    <p>{{ kostep.info }}</p>
    <div class="p-stepSingle-btns">
      <span
        class="c-btn p-stepSingle-btn" 
        :class="{ done : isCompleted }"
        @click="done"
        >完了<span>済</span></span>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'StepDetailcontent',
    props:{
      kostep: { type:Object, required: true },
      isCompleted: { tyep:Boolean, required: true }
    },
    methods:{
      done(){
        this.$emit('completed', this.kostep)
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
