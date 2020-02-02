<template>
<div class="p-stepSingle">
  <div class="p-stepSingle-title">
    <span><a :href="url">{{ title }}</a></span>
  </div>
  <div class="p-stepSingle-inner">
    <step-detailcontent
      :kostep="kostep"
      :isCompleted="isCompleted"
      @completed="done"></step-detailcontent>
    
    <step-detailmenu
      :flowmenu="flowmenu"></step-detailmenu>
  </div>
  <transition name="modal">
    <div v-if="showModal" class="js-modal-wrapper p-modal-wrapper">
      <div class="p-modal-container fn_jidoukansModal-container">
      <span class="js-close-modal p-modal-nextLink"><a href="/all">一覧へ戻る <i class="fas fa-arrow-right"></i></a></span>
        <h2 class="p-modal-title">CONGRATULATIONS</h2>
        <img class="p-modal-bgRight" src="/img/common/ico_twitter-bg01.png">
        <img class="p-modal-bgLeft" src="/img/common/ico_twitter-bg01.png">
        <p class="p-modal-text">おめでとうございます！<br>{{ title.title }}が完了しました！</p>
        <div class="p-modal-share">
          <p class="p-modal-share-text">twitterでシェアする</p>
          <div 
            class="p-modal-share-btn"
            @click="twitterShare"><i class="p-modal-share-btn__icon fab fa-twitter"></i></div>
        </div>
      </div>
    </div>
  </transition>
</div>
</template>
<script>
  import StepDetailcontent from './StepDetailcontent';
  import StepDetailmenu from './StepDetailmenu';
  const axios = require('axios'); 
  export default {
    name: 'StepDetail',
    props:{
      step: { type: Object, required: true },
      stepid: { type: Number, required: true },
      flowid: { type: Number, required: true }
    },
    data(){
      return{
        title: this.step.title,
        kostep:{},
        flowmenu: [],
        completes: {},
        completesAll: null,
        url: '/steps/' + this.stepid,
        showModal: false
      }
    },
    computed: {
      isCompleted(){
        if(this.completes === 0){
          return false 
        }
        return true
      }
    },
    methods:{
      //子STEPの完了ボタン発火
      done(kostep){
        axios.post('/ajax/completed',{
          id: kostep.id,
          step_id: this.stepid
        }).then((response) => {
          console.log(response);
          this.completes = 1;
          if(response.data === 1){
            this.completes = 0;
            console.log(this.completes)
          }
          if(this.completes){
            if(this.kostep.flow_id === this.flowmenu.length){
              if(this.completesAll === this.flowmenu.length ){
                this.showModal = true
              }else{
                setTimeout( () => {
                  
                }, 1000)
              }
            }else{
              setTimeout( () => {
                var url = '/steps/' + this.stepid + '/' + (this.flowid + 1);
                console.log(url);
                window.location.href = url;
              }, 1000)
            }
          }
        }).catch(error => {
          console.log('データの取得に失敗しました。: ' + response.data);
        });
      },
      // twitterシェアボタン
      twitterShare(){
        //シェアする画面を設定
        var shareURL = 'https://twitter.com/intent/tweet?text=' + this.title + "を完了しました！" + "%20%23STEPで学び方を共有しよう" + '&url=' + "https://code.ameneko.com/twitter-share";  
        //シェア用の画面へ移行
        location.href = shareURL
      }
    },
    mounted() {
      axios.get('/ajax/kostepDetail', {
        params:{
          stepid: this.stepid,
          flowid: this.flowid
        }
      }).then(response => {
        // 表示するSTEPデータを取得
        this.kostep = response.data[0];
        // 表示する完了有無データを取得
        this.completes = response.data[1];
        // STEPの子STEPの完了数を取得
        this.completesAll = response.data[2];
        // サイドメニューデータを取得
        this.flowmenu = response.data[3];
      })
      .catch(error => {
          var url = '/steps/' + this.stepid;
          window.location.href = url;
      });
    }
  }
</script>