<template>
  <section class="p-author">
    <h4 class="p-author__title">このSTEPを作った人</h4>
    <figure><img :src="'../../img/update/user/' + user.photo + '.jpg'" alt=""></figure>
    <p class="p-author__author">{{ user.name }}</p>
    <p class="p-author__info">{{ user.profile }}</p>
  </section>
</template>

<script>
  export default {
    name: 'StepAuthor',
    props:{
      user: { type: Object, required: true },
    }
  }
</script>