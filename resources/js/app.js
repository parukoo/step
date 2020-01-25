import $ from "jquery";
import "../sass/style.scss";
import Vue from 'vue'

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);
Vue.component('step-index', require('./components/StepIndex.vue').default);
Vue.component('step-indexlist', require('./components/StepIndexlist.vue').default);
Vue.component('step-indexitem', require('./components/StepIndexitem.vue').default);
Vue.component('step-list', require('./components/StepList.vue').default);
Vue.component('step-item', require('./components/StepItem.vue').default);
Vue.component('step-flow', require('./components/StepFlow.vue').default);
Vue.component('step-flowheader', require('./components/StepFlowheader.vue').default);
Vue.component('step-flowlist', require('./components/StepFlowlist.vue').default);
Vue.component('step-flowitem', require('./components/StepFlowitem.vue').default);
Vue.component('step-detail', require('./components/StepDetail.vue').default);
Vue.component('step-detailmenu', require('./components/StepDetailmenu.vue').default);
Vue.component('step-detailcontent', require('./components/StepDetailcontent.vue').default);
Vue.component('step-form', require('./components/StepForm.vue').default);
Vue.component('step-form01', require('./components/StepForm01.vue').default);
Vue.component('step-form02', require('./components/StepForm02.vue').default);
Vue.component('step-form03', require('./components/StepForm03.vue').default);
Vue.component('step-form04', require('./components/StepForm04.vue').default);
Vue.component('kostep-item', require('./components/KostepItem.vue').default);

const app = new Vue({
    el: '#app'
});
