import { mapActions } from "vuex";
import router from "../../../router";
export default {
  data() {
    return {
      post: {
        title: '',
        description: '',
      },
      submitted: false,

    }
  },
  methods: {
    ...mapActions("post", ["add"]),
    addPost() {
      this.submitted = true;
      var newPost = this.post;
      this.$validator.validateAll().then((result => {
        if (result) {
          this.add(newPost),
            router.push('/post/confirmcreate')
        }
      }),

      )

    }
  }
}