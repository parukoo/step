<template>
  <div class="p-stepSingle-content">
    <span class="p-stepSingle-content__count">FLOW {{ kostep.flow_id }}</span>
    <h3 class="p-stepSingle-content__title">{{ kostep.title }}</h3>
    <p>{{ kostep.info }}</p>
    <div class="p-stepSingle-content-share">
      <span 
        class="p-stepSingle-content-share-btn"
        @click="normalShare">ツイートする         
        <i class="p-stepSingle-content-share-btn__icon fab fa-twitter"></i>
      </span>
    </div>
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
      isCompleted: { type: Boolean, required: true }
    },
    methods:{
      // STEP完了
      done: function(){
        this.$emit('completed', this.kostep)
      },
      // twitterシェア
      normalShare: function(){
        this.$emit('normalShare', this.kostep)
      }
    }
  }
</script>
