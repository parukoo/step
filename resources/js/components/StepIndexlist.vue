<template>
  <div class="p-postsWrapper">
    <h3 class="p-posts-title" v-if="steps[0]">「{{ steps[0].category.name }}」の人気STEP</h3>
    <div class="p-posts">
      <step-indexitem 
        :step="step"
        v-for="step in steps"
        :key="step.index"></step-indexitem>
    </div>
    <p class="p-posts-btnWrapper">
      <span class="c-btn p-posts-btn"><a :href="'/category/' + this.steps[0].category_id" v-if="steps[0]">{{ steps[0].category.name }}一覧</a></span>
    </p>
  </div>
</template>

<script>
import StepIndexitem from './StepIndexitem.vue';
export default {
  name: 'StepIndexlist',
  props:{
    steps:{ type: Array, required: true },
  }
}
</script>

