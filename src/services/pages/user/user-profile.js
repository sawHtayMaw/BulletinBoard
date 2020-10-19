import { mapGetters, mapActions } from "vuex";
import router from "../../../router";
export default {
  data() {
    return {
      submitted: null,
      name: null,
      email: null,
      password: null,
      confirmpassword: null,
      type: null,
      dob: null,
      phone: null,
      address: null,
      profile: null,
    }
  },
  computed: {
    ...mapGetters("user", { currentUser: "currentUser" })
  },
  methods: {
    ...mapActions("user", ["loginDetail"]),
    editUser() {
      router.push("/user/editprofile");
    }
  }
}