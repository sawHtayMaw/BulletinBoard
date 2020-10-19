import Vue from "vue";
import Vuex from "vuex";
import { post } from "./post/index";
import { user } from "./user/index";
Vue.use(Vuex);

export const store = new Vuex.Store({
  modules: {
    post,
    user,
    namespace: true
  }
});
