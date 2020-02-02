<template>
  <div class="p-post">
    <a :href="'steps/' + step.id">
      <figure class="p-post-image"><img :src="'img/category/eyecatch0' + step.category.id + '.jpg'"/></figure>
      <h4 class="p-post-title">{{ step.title }}</h4>
      <p class="p-post-txt">{{ step.info }}</p>
    </a>
  </div>
</template>

<script>
import StepIndexitem from './StepIndexitem.vue';
export default {
  name: 'StepIndexlist',
  props:{
    step:{ type:Object, required: true }
  }
}
</script>