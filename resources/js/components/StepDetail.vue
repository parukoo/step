<template>
<div class="p-stepSingle">
  <div class="p-stepSingle-title">
    <p><a :href="url">{{ title.title }}</a></p>
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
        <p class="p-modal-text">おめでとうございます！<br>◯◯◯が完了しました！</p>
        <div class="p-modal-share">
          <p class="p-modal-share-text">twitterでシェアする</p>
          <div class="p-modal-share-btn"><i class="p-modal-share-btn__icon fab fa-twitter"></i></div>
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
      title: { type: Object, required: true },
      stepid: { type: Number, required: true },
      flowid: { type: Number, required: true }
    },
    data(){
      return{
        kostep:{},
        flowmenu: [],
        completes: {},
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
              this.showModal = true
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
      }
    },
    mounted() {
      axios.get('/ajax/kostepDetail', {
        params:{
          stepid: this.stepid,
          flowid: this.flowid
        }
      }).then(response => {
        this.kostep = response.data[0];
        console.log(this.kostep);
        this.completes = response.data[1];
        console.log(this.completes);
        this.flowmenu = response.data[2];
        console.log(this.flowmenu);
      })
      .catch(error => {
          console.log('データの取得に失敗しました。');
      });
    }
  }
</script>