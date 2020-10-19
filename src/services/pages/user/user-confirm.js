import { mapGetters, mapActions } from "vuex";
import axios from "axios";
import router from "../../../router";
//import router from "../../../router";
export default {
  data() {
    return {
      submitted: false,
      name: null,
      email: null,
      password: null,
      type: null,
      dob: null,
      phone: null,
      address: null,
      profile: '',
      image: null,

    }
  },
  computed: {
    ...mapGetters("user", { userlist: "userlist" })
  },
  methods: {
    ...mapActions("user", ["add", "getAllUser"]),
    confirmCreate() {
      axios.post(process.env.VUE_APP_SERVER + '/user/create', this.userlist)
        .then(response => {
          if (response.data.message) {
            router.push("/user/create");
          } else {
            this.getAllUser(),
              router.push("/userlist")
          }
        }
        );
    },
    back() {
      router.push('/user/create');
    }
  }
}