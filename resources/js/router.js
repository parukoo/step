import Vue from 'vue'
import Router from 'vue-router'
import StepList from './components/StepList.vue'
import StepSingle from './components/StepSingle.vue'

Vue.use(Router)
export default new Router({
  routes:[
    { path: '/', component: StepList },
    { path: '/single', component: StepSingle },
  ]
})