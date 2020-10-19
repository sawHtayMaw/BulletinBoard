import { mapActions } from "vuex";
import axios from "axios";
import router from "../../../router";

export default {
  data: () => ({
    submitted: false,
    email: "",
    password: "",
    // validation rules for user email.
    emailRules: [
      value => !!value || "The email field is required.",
      value => /.+@.+\..+/.test(value) || "E-mail must be valid."
  ],

  // validation rules for password.
  pwdRules: [value => !!value || "The password field is required."]
  }),
  methods: {
    ...mapActions("user", ["loginDetail", "LoggedIn", "role", "CurrentUser"]),
    /**
     * This to submit login form.
     * @returns void
     */
    loginData() {
      var data = {
        email: this.email,
        password: this.password
      }
      axios.post(process.env.VUE_APP_SERVER + '/login', data)
        .then(response => {
          this.LoggedIn(true);
          const $userData = response.data;
          var user = $userData.user;
          this.CurrentUser(user);
          if ($userData.token && $userData.user) {
            const $userRole = $userData.user.type === "0" ? "Admin" : "User";
            localStorage.setItem("token", $userData.token);
            localStorage.setItem("role", $userRole);
          }
          var token = localStorage.getItem("token");
          axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
          router.push("/postlist");
        });
    },
  }
};
