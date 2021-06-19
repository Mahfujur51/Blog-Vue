require('./bootstrap');
window.Vue = require('vue');
import Form from 'vform'
window.Form =Form


import VueRouter from 'vue-router'
Vue.use(VueRouter)
Vue.component('public-master', require('./components/fontend/PublicMaster').default);
Vue.component('admin-master',require('./components/admin/AdminMaster').default)
import {routes} from  './route/routes'
const router = new VueRouter({

    mode:'hash',
    routes

})
import toastr from 'toastr/toastr'
window.toastr =toastr
import Swal from 'sweetalert2'
window.Swal=Swal
import Vuex from 'vuex'
Vue.use(Vuex)
import storeData from "./store/index"
const store = new Vuex.Store(
    storeData
)
import axios from 'axios'
window.axios=axios

import {moment} from "./filter/filter"
import  "./helpers/mixin"
import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use( CKEditor );

const app = new Vue({

    el: '#app',
    router,
    store,
});
