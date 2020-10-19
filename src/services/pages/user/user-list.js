import { mapGetters, mapActions } from "vuex";
import axios from "axios";
import router from "../../../router";
export default {
  data() {
    return {
      rows: 100,
      currentPage: 1,
      perPage: 5,
      data: '',
      id: '',
      name: '',
      email: '',
      create_user_id: '',
      createdfrom: '',
      createdto: '',
      phone: '',
      dob: '',
      userArray: [
        { label: "Name", key: "name" },
        { label: "Email", key: "email" },
        { label: "Create User", key: "create_user_id" },
        { label: "Phone", key: "phone" },
        { label: "Birth Date", key: "dob" },
        { label: "Address", key: "address" },
        { label: "CreatedDate", key: "created_at" },
        { label: "UpdatedDate", key: "updated_at" },
        { label: "Action", key: "delete" },
      ],
    }
  },
  created() {
    this.getAllUser();
  },
  computed: {
    ...mapGetters("user", { userlist: "userlist" })
  },
  methods: {
    ...mapActions("user", ["getAllUser", "searchUser"]),
    search(name, email, createdfrom, createdto) {
      var user = {
        name: name,
        email: email,
        createdfrom: createdfrom,
        createdto: createdto
      }
      axios.post(process.env.VUE_APP_SERVER+'/user/search', user)
            .then(response => {
                const user = response.data;
                this.searchUser(user);
            })
    },
    addUser() {
      router.push("/user/create");
    },
    deleteData(id) {
      axios.get(process.env.VUE_APP_SERVER + '/user/delete/'+id)
      .then(
        this.getAllUser()
      )
    }
  }
}