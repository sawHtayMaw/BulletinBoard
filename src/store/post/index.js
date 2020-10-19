import axios from "axios";
/**
 * Initial state of postList
 */
function initialState() {
  return {
    postlist: null,
  };
}
/**
 * Getters of postlist
 */
const getters = {
  postlist: state => state.postlist
};
/**
 * Actions of postlist
 */
const actions = {
  getAllPost({ commit }) {
    axios.get(process.env.VUE_APP_SERVER + '/postlist').then((response) => {
      const postlist = response.data;
      commit('PostListSuccess', postlist);
    });
  },
  searchPost({ commit }, post) {
    commit('PostSearchSuccess', post);
  },
  add({ commit }, post) {
    commit('SetPost', post);
  },
  update({ commit }, post) {
    commit('SetPostData', post);
  },
  confirmUpdate({ commit }, post) {
    commit('UpdateData', post);
  }
}
/**
 * Mutations of postlist
 */
const mutations = {
  PostListSuccess(state, postlist) {
    state.postlist = postlist;
  },
  PostSearchSuccess(state, post) {
    state.postlist = post;
  },
  SetPost(state, post) {
    state.postlist = post;
  },
  SetPostData(state, post) {
    state.postlist = post;
  },
  UpdateData(state, post) {
    state.postlist = post;
  }
};
export const post = {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
};
