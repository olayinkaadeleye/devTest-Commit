import Vue from 'vue';
import routes from './router/index.js'
require('./bootstrap');

import CxltToastr from 'cxlt-vue2-toastr'
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css'
Vue.use(CxltToastr)
var toastrConfigs = {
    position: 'top right',
    showDuration: 1000,
    timeOut: 5000,
    closeButton: true,
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut',
}
Vue.use(CxltToastr, toastrConfigs)
Vue.component('app-header', require('./components/Header.vue').default);
  
const app = new Vue({
    el: '#app',
    router: routes,
})

export default routes;