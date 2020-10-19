import { mapActions } from "vuex";
import router from "../../../router";
import axios from "axios";
export default {
  data() {
    return {
      csvfile: null,
      uploadData: '',
    }
  },
  methods: {
    ...mapActions("post", ["uploadPosts"]),
    upload(uploadData) {
      if (uploadData) {
        alert("Successful CSV Upload!!!");
      }
      axios.post(process.env.VUE_APP_SERVER + '/post/upload', { uploadData } )
        .then(
          router.push('/postlist')
        );
    },
    uploadFile(e) {
      var reader = new FileReader();
      reader.onload = (e) => {
        this.uploadData = e.target.result;
      };
      reader.readAsDataURL(e.target.files[0]);
    },
    goToPostList() {
      router.push("/postlist");
    }
  }
}