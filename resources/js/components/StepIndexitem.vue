<template>
  <div class="p-post">
    <a :href="'steps/' + step.id">
      <figure class="p-post-image"><img src="img/update/post/post01.jpg" alt=""></figure>
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
  },
  data(){
    return{
    }
  },
	methods:{
	}
}
</script>