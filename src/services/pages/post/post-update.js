import { mapActions, mapGetters } from "vuex";
import router from "../../../router";
export default {
  data() {
    return {
      title: '',
      description: '',
      status: '',
      submitted: false
    }
  },
  computed: {
    ...mapGetters("post", { postlist: "postlist" }),
  },
  methods: {
    ...mapActions("post", ["update", "confirmUpdate"]),
    updatePost() {
      this.submitted = true;
      var post = {
        id: this.postlist.id,
        title: this.postlist.title,
        description: this.postlist.description,
        status: this.postlist.status
      }
      this.$validator.validateAll().then(result => {
        if (result) {
          this.confirmUpdate(post);
          router.push("/post/confirmupdate");
        }
      })
    }
  }
}