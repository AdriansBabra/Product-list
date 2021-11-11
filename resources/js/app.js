require('./bootstrap');

import Vue from 'vue'
import App from './vue/app'
import Routes from './routes'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare, faTrash, faEdit, faCartPlus, faShoppingCart, faInfoCircle} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import VueRouter from 'vue-router'
Vue.use(VueRouter)
const router = new VueRouter({
    routes: Routes,
    mode: "history",
    // linkActiveClass: "active",
    linkExactActiveClass: "active"
});

import VueSimpleAlert from "vue-simple-alert";
Vue.use(VueSimpleAlert);

import moment from 'moment-timezone'
moment.tz.setDefault('Europe/Riga')
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY HH:mm')
    }
});

import VueNumericInput from 'vue-numeric-input';
Vue.use(VueNumericInput)

import BootstrapVue from "bootstrap-vue"
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap-vue/dist/bootstrap-vue.css"
Vue.use(BootstrapVue)

import LaravelVueValidator from 'laravel-vue-validator'
Vue.use(LaravelVueValidator)

library.add(faPlusSquare, faTrash, faEdit, faCartPlus, faShoppingCart, faInfoCircle)
Vue.component('font-awesome-icon', FontAwesomeIcon)
const app = new Vue({
    el: '#app',
    components: {App},
    router: router
});

