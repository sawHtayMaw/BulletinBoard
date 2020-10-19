import { mapGetters, mapActions } from "vuex";
import axios from "axios";
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
    ...mapGetters("user", { userlist: "userlist" })
  },
  methods: {
    ...mapActions("user", ["confirm"]),
    updated() {
      axios.post(process.env.VUE_APP_SERVER + '/user/update', this.userlist)
        .then(
          router.push('/user/profile')
        );
    },
    back() {
      router.push('/user/editprofile');
    }
  }
}