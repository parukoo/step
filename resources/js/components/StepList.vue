<template>
  <div class="p-rowposts">
    <div 
      v-for="step in getSteps"
      class="p-rowpost"
      :key="step.id">
      <step-item
        :step="step"></step-item>
    </div>
    <paginate
      :page-count="getPageCount"
      :page-range="3" 
      :margin-pages="2"
      :click-handler="clickCallback"
      :prev-text="'＜'"
      :next-text="'＞'"
      :container-class="'p-pagination'"
      :page-class="'page-item'">
  </paginate>
  </div>
</template>

<script>
  import axios from 'axios';
  import StepItem from './StepItem.vue';
  import paginate from './paginate.vue';
  export default {
    name: 'StepList',
    data(){
      return{
        steps: [],
        parPage: 5,
        currentPage: 1,
      }
    },
    //ページネーション
    methods: {
      clickCallback: function (pageNum) {
        this.currentPage = Number(pageNum);
      }
    },
    computed: {
      getSteps: function() {
        let current = this.currentPage * this.parPage;
        let start = current - this.parPage;
        return this.steps.slice(start, current);
      },
      getPageCount: function() {
        return Math.ceil(this.steps.length / this.parPage);
      }
    },
    
    //STEPデータをAJAXで取得
    mounted() {
      axios.get('/ajax/steps')
      .then(response => {
        this.steps = response.data;
        console.log(this.steps);
      })
      .catch(error => {
          console.log('データの取得に失敗しました。');
      });
    }
  }
</script>