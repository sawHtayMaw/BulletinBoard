import { mapActions, mapGetters } from "vuex";
import constants from "../../constants";
import router from "../../router";
import axios from "axios";

export default {
  data() {
    return {
      title: constants.APP_TITLE,
      active: "3",
      storageRole: "",
      localUser: "",
      user: "",
      email: ""
    };
  },

  created() {
    const role = localStorage.getItem("role");
    const $name = localStorage.getItem('name');
    const $email = localStorage.getItem('email');
    this.email = $email;
    this.user = $name;
    this.storageRole = role;
  },
  computed: {
    ...mapGetters("user", { currentUser: "currentUser" }),
    isLoggedIn() {
      return this.$store.state.user.isLoggedIn
    }
  },
  methods: {
    ...mapActions("user", ["LoggedIn", "LogoutUser"]),
    logIn() {
      router.push('/login');
    },
    logOut() {
      axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem("token")}`;
      axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
      axios.post(process.env.VUE_APP_SERVER + '/logout').then(response => {
        console.log(response);
      })
      this.LoggedIn(false);
      this.LogoutUser(null);
      router.push('/login')
    },
    AllUser() {
      router.push("/userlist");
    },
    AllPost() {
      router.push("/postlist");
    },
    UserDetail() {
      router.push("/user/profile");
    },

  },
};
