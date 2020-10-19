import { mapActions } from "vuex";
//import axios from "axios";
import router from "../../../router";
export default {
  data() {
    return {
      submitted: false,
      user: {
        name: null,
        email: null,
        password: null,
        confirmpassword: null,
        type: null,
        dob: null,
        phone: null,
        address: null,
        profile: null,
        image: null
      },
    }
  },
  methods: {
    ...mapActions("user", ["add"]),
    handleImage(e) {
      const selectedImage = e.target;
      if (selectedImage.files && selectedImage.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.user.profile = e.target.result;
        }
        reader.readAsDataURL(selectedImage.files[0]);
      }
    },
    createUser() {
      this.submitted = true;
      this.$validator.validateAll().then(result => {
        if (result) {
          this.add(this.user);
          router.push('/user/confirm');
        }
      })
    },
  }
}