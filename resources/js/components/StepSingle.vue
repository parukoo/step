<template>
  <div class="p-step-single">
    <!-- <step-header ></step-header> -->
  <div class="p-stepHeader-wrapper">
    <div class="p-stepHeader" style="background: url('img/update/post/post01.jpg');">
      <div class="p-stepHeader-container">
        <div class="p-stepHeader-title">
          <span class="p-stepHeader-title-category">{{ step.category.name}}</span>
          <h2 class="p-stepHeader-title-name">{{ step.title }}</h2>
          <ul class="p-stepHeader-title-icons">
            <li><span class="c-icon"><img src="img/common/ico_clock-wh.svg" alt=""></span>目安学習期間：{{ step.time }}</li>
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
              <input class="c-btn" type="submit" value="STEPを始める">
            </div>
          </div>
          <div class="p-stepHeader-info-score">
            <div class="p-stepHeader-info-score-graph"></div>
            <ul>
              <li>完了率　100%</li>
              <li>完了率　100%</li>
              <li>完了率　100%</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="p-wrapper--step">
      <div class="p-container">
        <div class="p-headingWrapper">
          <h3 class="p-flow__title p-heading"><span>S</span>tep Flow</h3>
          <span class="p-heading-sub">stepの流れ</span>
        </div>
        <step-flowlist
          :kosteps="kosteps"></step-flowlist>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
  // import StepHeader from './StepHeader.vue';
  import StepFlowlist from './StepFlowlist.vue';
  export default {
    name: 'StepSingle',
    props:['step'],
    data(){
      return{
        stepId: 1,
        kosteps:[]
      }
    },
    mounted() {
      axios.get('/ajax/stepsingle/' + this.stepId )
      .then(response => {
        this.kosteps = response.data;
        console.log(this.kosteps);
      })
      .catch(error => {
          console.log('データの取得に失敗しました。');
      });
    }
  }
</script>