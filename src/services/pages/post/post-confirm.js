import { mapGetters, mapActions } from "vuex";
import axios from "axios";
import router from "../../../router";
export default {
  data() {
    return {
      title: '',
      description: '',
      submitted: false
    }
  },
  computed: {
    ...mapGetters("post", { postlist: "postlist" }),
  },
  created() {

  },
  methods: {
    ...mapActions("post", ["add", "getAllPost"]),
    createPost() {
      var newPost = {
        title: this.postlist.title,
        description: this.postlist.description
      }
      axios.post(process.env.VUE_APP_SERVER + '/post/create', newPost)
        .then(response => {
          if (response.data.message) {
            router.push("/post/create");
          } else {
            this.getAllPost(),
              router.push("/postlist")
          }
        }
        );
    },
    back() {
      router.push('/post/create');
    }
  }
}