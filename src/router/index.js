import Vue from "vue";
import VueRouter from "vue-router";
import Login from "../pages/user/Login.vue";
import PostList from "../pages/post/PostList.vue";
import CreatePost from "../pages/post/CreatePost.vue";
import ConfirmCreatePost from "../pages/post/ConfirmCreate.vue";
import PostUpdate from "../pages/post/EditPost.vue";
import ConfirmUpdate from "../pages/post/ConfirmEdit.vue";
import PostUpload from "../pages/post/CSVUpload.vue";
import UserList from "../pages/user/UserList.vue";
import CreateUser from "../pages/user/CreateUser.vue";
import ConfirmCreateUser from "../pages/user/ConfirmCreateUser.vue";
import UserProfile from "../pages/user/UserProfile.vue";
import UpdateProfile from "../pages/user/EditUserProfile.vue";
import ConfirmEditProfile from "../pages/user/ConfirmEditProfile.vue";
import ChangePassword from "../pages/user/ChangePassword.vue";

Vue.use(VueRouter);

const routes =
  [
    {
      path: '/',
      redirect: { name: 'post-list' }
    },
    {
      path: "/login",
      name: "login",
      component: Login,
      meta: { requiresAuth: false }
    },
    {
      path: "/postlist",
      name: "post-list",
      component: PostList,
    },
    {
      path: "/post/create",
      name: "create-post",
      component: CreatePost,
    },
    {
      path: "/post/confirmcreate",
      name: "confirm-create",
      component: ConfirmCreatePost
    },
    {
      path: "/post/update",
      name: "post-update",
      component: PostUpdate
    },
    {
      path: "/post/confirmupdate",
      name: "post-confirmupdate",
      component: ConfirmUpdate
    },
    {
      path: "/post/upload",
      name: "post-upload",
      component: PostUpload
    },
    {
      path: "/userlist",
      name: "user-list",
      component: UserList,
    },
    {
      path: "/user/create",
      name: "create-user",
      component: CreateUser
    },
    {
      path: "/user/confirm",
      name: "confirm-createuser",
      component: ConfirmCreateUser
    },
    {
      path: "/user/profile",
      name: "user-profile",
      component: UserProfile
    },
    {
      path: "/user/editprofile",
      name: "edit-profile",
      component: UpdateProfile
    },
    {
      path: "/user/confirmeditprofile",
      name: "confirm-edit",
      component: ConfirmEditProfile
    },
    {
      path: "/user/changepassword",
      name: "change-password",
      component: ChangePassword
    }
  ]

const router = new VueRouter({
  routes
})

export default router;