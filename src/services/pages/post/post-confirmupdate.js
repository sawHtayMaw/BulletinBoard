import { mapActions, mapGetters } from "vuex";
import axios from "axios";
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
    ...mapActions("post", ["confirmUpdate", "getAllPost"]),
    updated() {
      var post = {
        id: this.postlist.id,
        title: this.postlist.title,
        description: this.postlist.description,
        status: this.postlist.status
      }
      if (post.status == "false") {
        post.status = 0;
      }
      axios.post(process.env.VUE_APP_SERVER + '/post/confirmupdate', post)
        .then(
          this.getAllPost(),
          router.push("/postlist")
        )
    },
    back() {
      router.push('/post/update');
    }
  }
}