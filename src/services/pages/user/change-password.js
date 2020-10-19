import { mapGetters } from "vuex";
import axios from "axios";
import router from "../../../router";
export default {
  data() {
    return {
      submitted: false,
      user: {
        id: '',
        oldPassword: '',
        newPassword: '',
        confirmPassword: ''

      },
    }
  },
  computed: {
    ...mapGetters("user", { userlist: "userlist" })
  },
  methods: {
    change() {
      this.user.id = this.userlist.id;
      axios.post(process.env.VUE_APP_SERVER + '/user/changepassword', this.user)
      .then(
        router.push('/user/profile')
      )
    }
  }
}