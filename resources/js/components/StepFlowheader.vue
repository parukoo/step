<template>
  <div class="p-stepHeader-wrapper">
    <div class="p-stepHeader" style="background: url('img/update/post/post01.jpg');">
      <div class="p-stepHeader-container">
        <div class="p-stepHeader-title">
          <span class="p-stepHeader-title-category">{{ step.category.name }}</span>
          <h2 class="p-stepHeader-title-name">{{ step.title }}</h2>
          <ul class="p-stepHeader-title-icons">
            <li><span class="c-icon"><img src="img/common/ico_clock-wh.svg" alt=""></span>目安学習期間：{{ step.time }}時間</li>
            <li><span class="c-icon"><img src="img/common/ico_author-wh.svg" alt=""></span>作成者:{{ step.user.name }}</li>
          </ul>
        </div>
        <div class="p-stepHeader-info">
          <div class="p-stepHeader-info-txtWrapper">
            <p>{{ step.info }}</p>
            <ul>
              <li><span class="c-icon"><img src="img/common/ico_clock.svg" alt=""></span>目安学習期間：{{ step.time }}</li>
              <li><span class="c-icon"><img src="img/common/ico_author.svg" alt=""></span>作成者：{{ step.user.name }}</li>
            </ul>
            <div class="u-flex-center">
              <input 
                class="c-btn" 
                type="submit" 
                @click="start" 
                value="STEPを始める">
            </div>
          </div>
          <div class="p-stepHeader-info-score">
            <div class="p-stepHeader-info-score-graph"></div>
            <ul>
              <li>完了率　{{ complete }}%</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'StepFlowheader',
    props:{
      step: { type:Object, required: true },
      complete: { type:Number, required: true }
    },
    data(){
      return{
      }
    },
    methods:{
      start(){
        var url = '/steps/' + this.step.id + '/' + 1;
        window.location.href = url;
      }
    }
  }
</script>
<style>
.p-stepHeader{
  z-index: 1;
}
.p-stepHeader-info-txtWrapper input[type="submit"]{
  cursor: pointer;
}
</style>