<template>
  <a :href="`/steps/${step.id}`">
    <figure class="p-rowpost-image"><img :src="'../../img/category/eyecatch0' + step.category.id + '.jpg'"></figure>
    <div class="p-rowpost-txtWrapper">
      <span class="p-rowpost-category">{{ step.category.name }}</span>
      <h4 class="p-rowpost-title">{{ step.title }}時間</h4>
      <div class="p-rowpost-info">
        <span class="p-rowpost-info__time"><span class="c-icon"><img src="/img/common/ico_clock.svg" alt=""></span>目安学習期間：{{ step.time }}時間</span>
        <span class="p-rowpost-info__author"><span class="c-icon"><img src="/img/common/ico_author.svg" alt=""></span>作成者：{{ step.user.name }}</span>
      </div>
      <p class="p-rowpost-txt">{{ step.info }}</p>
    </div>
  </a>
</template>

<script>
  export default {
    name: 'StepItem',
    props: ['step']
  }
</script>
