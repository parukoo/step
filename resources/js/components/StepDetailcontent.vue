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
        ><span v-if="!isCompleted">未</span>完了<span v-if="isCompleted">済</span></span>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'StepDetailcontent',
    props:{
      kostep: { type: Object, required: true },
      isCompleted: { tyep: Boolean, required: true }
    },
    methods:{
      done(){
        this.$emit('completed', this.kostep)
      }
    }
  }
</script>
