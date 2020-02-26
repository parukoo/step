<template>
  <div class="p-stepHeader-wrapper">
    <div class="p-stepHeader" :style="{ backgroundImage: 'url(' + url + ')' }">
      <div class="p-stepHeader-container">
        <div class="p-stepHeader-title">
          <span class="p-stepHeader-title__category">{{ step.category.name }}</span>
          <h2 class="p-stepHeader-title__name">{{ step.title }}</h2>
          <ul class="p-stepHeader-title__icons">
            <li><span class="c-icon"><img src="/img/common/ico_clock-wh.svg" alt=""></span>目安学習期間：{{ step.time }}時間</li>
            <li><span class="c-icon"><img src="/img/common/ico_author-wh.svg" alt=""></span>作成者:{{ step.user.name }}</li>
          </ul>
        </div>
        <div class="p-stepHeader-info">
          <div class="p-stepHeader-info-txtWrapper">
            <p>{{ step.info }}</p>
            <ul>
              <li><span class="c-icon"><img src="/img/common/ico_clock.svg" alt=""></span>目安学習期間：{{ step.time }}</li>
              <li><span class="c-icon"><img src="/img/common/ico_author.svg" alt=""></span>作成者：{{ step.user.name }}</li>
            </ul>

          </div>
          <div class="p-stepHeader-info-score">
            <div class="p-stepHeader-info-score__graph">
              <span :style="{ width:complete+ '%'}"></span>
            </div>
            <p>完了率　{{ complete }}%</p>
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
      step: { type: Object, required: true },
      complete: { type: Number, required: true }
    },
    computed:{
      url: function(){
        if(this.step.photo != null){
          return '../../img/update/step/' + this.step.photo + '.jpg';
        }else{
          return '../../img/common/img_noimage.jpg';
        }
      }
    }
  }
</script>