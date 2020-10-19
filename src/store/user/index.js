import axios from "axios";
/**
 * Initial state of userlist
 */
const state = {
  isLoggedIn: false, userlist: null, currentUser: {},

}
/**
 * Getters of userlist
 */
const getters = {
  userlist: state => state.userlist,
  currentUser: state => state.currentUser
};
/**
 * Actions of userlist
 */
const actions = {
  LoggedIn({ commit }, login) {
    commit("isLoggedIn", login);
  },
  CurrentUser({ commit }, user) {
    commit("SetCurrentUser", user);
  },
  LogoutUser({ commit }, user) {
    commit("Logout", user);
  },
  getAllUser({ commit }) {
    axios.get(process.env.VUE_APP_SERVER + '/userlist').then((response) => {
      const userlist = response.data;
      commit('UserListSuccess', userlist);
    });
  },
  searchUser({ commit }, user) {
    commit('UserSearchSuccess', user);
  },
  loginDetail({ commit }, data) {
    commit('LoginUserDetail', data);
  },
  add({ commit }, user) {
    commit("SetUser", user);
  },
  confirm({ commit }, user) {
    commit("UpdateUser", user);
  }
};
/**
 * Mutations of userlist
 */
const mutations = {
  isLoggedIn(state, login) {
    state.isLoggedIn = login;
  },
  SetCurrentUser(state, user) {
    state.currentUser = user;
    if (state.currentUser.type == '0') {
      state.currentUser.type = "Admin";
    } else {
      state.currentUser.type = "User";
    }
  },
  Logout(state, user) {
    state.currentUser = user;
  },
  UserListSuccess(state, userlist) {
    state.userlist = userlist;
  },
  UserSearchSuccess(state, user) {
    state.userlist = user;
  },
  SetUser(state, user) {
    state.userlist = user;
  },
  LoginUserDetail(state, data) {
    state.userlist = data;
  },
  UpdateUser(state, user) {
    state.userlist = user;
  }
};
export const user = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
