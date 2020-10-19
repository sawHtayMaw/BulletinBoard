import { mapGetters, mapActions } from "vuex";
import router from "../../../router";
export default {
  data() {
    return {
      submitted: false,
      id: '',
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
    ...mapActions("user", ["loginDetail", "confirm"]),
    handleImage(e) {
      const selectedImage = e.target;
      if (selectedImage.files && selectedImage.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.currentUser.profile = e.target.result;
        }
        reader.readAsDataURL(selectedImage.files[0]);
      }
    },
    confirmUpdate() {
      this.submitted = true;
      this.$validator.validateAll().then(result => {
        if (result) {
          this.confirm(this.currentUser);
          router.push('/user/confirmeditprofile');
        }
      })
    },
    passwordChange() {
      router.push('/user/changepassword');
    }
  }
}