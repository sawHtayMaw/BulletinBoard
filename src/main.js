import Vue from "vue";
import Vuex from 'vuex';
import App from "./App.vue";
import "./registerServiceWorker";
import router from "./router";
import {store} from "./store/index";
import axios from "axios";
import moment from "moment";
import vuetify from "./plugins/vuetify";
import { BootstrapVue } from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import VeeValidate from 'vee-validate';

Vue.use(Vuex);
Vue.use(BootstrapVue);
Vue.use(VeeValidate, { fieldsBagName: 'veeFields' });
Vue.config.productionTip = false;
Vue.prototype.$axios = axios;
Vue.prototype.$store = store;
Vue.prototype.moment = moment;
new Vue({
    router,
    store,
    vuetify,
    render: (h) => h(App),
    /**
     * This is to set token to any request to server side.
     * @returns Resquest with configurations
     */
}).$mount("#app");
