<template>
  <div class="p-stepSingle-menu">
    <h4 class="p-stepSingle-menu-title">STEP学習一覧</h4>
    <ul>
      <li 
      v-for="flowitem in filterflowmenu"
      :class="{ active: flowitem.isDone }"
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
      completes: { type: Array, required: true }
    },
    computed:{
      // 完了済みのflowitemには、isDoneをtrueに、未完了はfalseにする
      filterflowmenu: function(){
        this.flowmenu.forEach((flowitem, i) => {
          if(this.completes.includes(flowitem.id)){
            this.$set(this.flowmenu[i], "isDone", true);
          }else{
            this.$set(this.flowmenu[i], "isDone", false);
          }
        });
        return this.flowmenu;
      }
    }
  }
</script>