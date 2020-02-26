<template>
  <div class="p-post">
    <a :href="'steps/' + step.id">
      <figure class="p-post__image">
        <img class="js-objectfit" v-if="step.photo" :src="'../../img/update/step/' + step.photo + '.jpg'">
        <img class="js-objectfit" v-else :src="'../../img/common/img_noimage.jpg'">
      </figure>
      <h4 class="p-post__title">{{ step.title }}</h4>
      <p class="p-post__txt">{{ step.info }}</p>
    </a>
  </div>
</template>

<script>
import StepIndexitem from './StepIndexitem.vue';
export default {
  name: 'StepIndexlist',
  props:{
    step:{ type: Object, required: true }
  }
}
</script>