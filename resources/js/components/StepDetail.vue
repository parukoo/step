<template>
<div class="p-stepSingle">
  <div class="p-stepSingle-title">
    <span><a :href="url">{{ title }}</a></span>
  </div>
  <div class="p-stepSingle-inner">
    <step-detailcontent
      :kostep="kostep"
      :isCompleted="isCompleted"
      @normalShare="normalShare"
      @completed="done"></step-detailcontent>
    
    <step-detailmenu
      :flowmenu="flowmenu"></step-detailmenu>
  </div>

  <transition name="modal">
    <div v-if="showModal" class="js-modal-wrapper p-modal-wrapper">
      <div class="p-modal-container fn_jidoukansModal-container">
      <span class="js-close-modal p-modal-nextLink"><a href="/all">STEP一覧へ戻る <i class="fas fa-arrow-right"></i></a></span>
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
        completes: [],
        url: '/steps/' + this.stepid,
        showModal: false
      }
    },
    computed: {
      isCompleted:{
        // getter 関数
        get: function () {
          if(this.completes.includes(this.kostep.id)){
            return true
          }
          return false
        },
        // setter 関数
        set: function (newValue) {
          return newValue 
        }
      }
    },

    methods:{
      //子STEPの完了ボタン発火
      done(kostep){
        axios.post('/ajax/completed',{
          id: kostep.id,
          step_id: this.stepid
        }).then((response) => {
          
          //（未完了にする場合）complete配列から該当のkostep_idを削除する
          if(response.data === 1){
            this.kostepId = this.completes.indexOf(kostep.id);
            this.completes.splice(this.kostepId,1);
          }else{    
          //（完了にする場合）complete配列に該当のkostep_idを追加する  
            this.completes.push(kostep.id);   
            console.log(this.completes)  
            if(this.isCompleted){
              //最後のflow_idかつ、全てクリアした場合、twitterシェアモーダルを表示
              if(this.kostep.flow_id === this.flowmenu.length){
                if(this.completes.length === this.flowmenu.length ){
                  this.showModal = true
                }
              }else{
                //最後のflow_id以外は、次のflowに進む
                setTimeout( () => {
                  var url = '/steps/' + this.stepid + '/' + (this.flowid + 1);
                  console.log(url);
                  window.location.href = url;
                }, 1000)
              }
            }
          }
        }).catch(error => {
          console.log('データの取得に失敗しました。: ' + response.data);
        });
      },

      // twitterシェアボタン（通常のシェア）
      normalShare(kostep){
        //シェアする画面を設定
        var shareURL = 'https://twitter.com/intent/tweet?text=' + "STEP「" + this.title + "」：FLOW-1" + kostep.title + "%20%23STEPで学び方を共有しよう" + '&url=' + "https://step.chew.jp/steps/" + this.stepid;  
        //シェア用の画面へ移行
        location.href = shareURL
      },
      // twitterシェアボタン（100%完了時のみのシェア）
      twitterShare(){
        //シェアする画面を設定
        var shareURL = 'https://twitter.com/intent/tweet?text=' + this.title + "を完了しました！" + "%20%23STEPで学び方を共有しよう" + '&url=' + "https://step.chew.jp/steps/" + this.stepid;  
        //シェア用の画面へ移行
        location.href = shareURL
      }
    },

    // STEPデータをAJAXで取得
    mounted() {
      axios.get('/ajax/kostepDetail', {
        params:{
          stepid: this.stepid,
          flowid: this.flowid
        }
      }).then(response => {
        // 表示するSTEPデータを取得
        this.kostep = response.data[0];
        // STEPの子STEPの完了数を取得
        this.completes = response.data[1];
        // サイドメニューデータを取得
        this.flowmenu = response.data[2];
      })
      .catch(error => {
          var url = '/steps/' + this.stepid;
          window.location.href = url;
      });
    }
  }
</script>