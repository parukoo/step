<template>
  <div class="p-stepSingle-menu">
    <h4 class="p-stepSingle-menu-title">STEP学習一覧</h4>
    <ul>
      <li 
      v-for="flowitem in flowmenu"
      :class="{ done : flowitem.user }"
      :key="flowitem.flow_id">
        <a :href="'/steps/' + flowitem.step_id + '/' + flowitem.flow_id">{{ flowitem.title }}</a>
      </li>
    </ul>
  </div>
</template>

<script>
  const axios = require('axios'); 
  export default {
    name: 'StepDetailmenu',
    props:{
      flowmenu: { type: Array, required: true },
    }
  }
</script>