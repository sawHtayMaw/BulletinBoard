import { mapGetters, mapActions } from "vuex";
import axios from "axios";
import router from "../../../router";
export default {
  data() {
    return {
      currentPage: 1,
      perPage: 5,
      rows: 100,
      search: '',
      title: '',
      description: '',
      submitted: false,
      postArray: [
        { label: "Post Title", key: "title" },
        { label: "Post Description", key: "description" },
        { label: "Post User", key: "create_user_id" },
        { label: "Post Date", key: "created_at" },
        { label: "", key: "edit" },
        { label: "", key: "delete" }
      ]
    };
  },
  created() {
    this.getAllPost();
  },
  computed: {
    ...mapGetters("post", { postlist: "postlist" }),
    isLoggedIn() {
      return this.$store.state.user.isLoggedIn
    }
  },
  methods: {
    ...mapActions("post", ["getAllPost", "searchPost", "update"]),
    searchList() {
      axios.post(process.env.VUE_APP_SERVER + '/post/search?q=' + this.search)
        .then(response => {
          var post = response.data;
          this.searchPost(post);
        })
    },
    addPost() {
      router.push("/post/create");
    },
    editData(id) {
      axios.get(process.env.VUE_APP_SERVER + '/post/getPost/' + id)
        .then(response => {
          var post = response.data;
          this.update(post);
        })
      router.push("/post/update");
    },
    upload() {
      router.push("/post/upload/");
    },
    download() {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${localStorage.getItem("token")}`;
      axios.get(process.env.VUE_APP_SERVER + '/post/download', { responseType: 'blob' })
        .then(response => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement('a');
          link.href = url;
          link.setAttribute('download', 'post.csv'); 
          document.body.appendChild(link);
          link.click();
        })
    },
    deleteData(id) {
      axios.get(process.env.VUE_APP_SERVER + '/post/delete/' + id)
        .then(
          this.getAllPost(),
        )
    }
  }
}