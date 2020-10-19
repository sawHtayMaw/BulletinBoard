<template>
    <div class="container">
         <div slot="header">
            <h4 class="mt-4 mb-4 ml-3">User List</h4>
        </div>
        <b-row class="mb-5 col-lg-12">
           <b-input type="text" class="mr-3 col-2" placeholder="Name" v-model="name"></b-input>
           <b-input type="text" class="mr-3 col-2" placeholder="Email" v-model="email"></b-input>
           <b-input class="mr-3 col-2"  placeholder="Created From" onfocus="(this.type='date')" v-model="createdfrom"></b-input>
           <b-input class="mr-3 col-2"  placeholder="Created To" onfocus="(this.type='date')" v-model="createdto"></b-input>
           <b-button variant="primary" @click="search(name, email, createdfrom, createdto)" class="btnSearch pr-5 pl-5">Search</b-button>
           <b-button variant="primary" class="btnAdd ml-3 pr-5 pl-5" @click="addUser()">Add</b-button>
        </b-row>
        <b-table
                class="col-lg-12 text-center"
                striped responsive
                stacked="md"
                :fields="userArray"
                :items="userlist"
                :current-page="currentPage"
                :per-page="perPage"
        >
        <template v-slot:cell(delete)="data">
                <b-button variant="danger" @click="deleteData(data.item.id)">Delete</b-button>
        </template>
        </b-table>
           <b-pagination v-model="currentPage" :total-rows="rows" class="pagination mt-5 offset-4"></b-pagination>
    </div>
</template>

<script src="../../services/pages/user/user-list.js">
</script>

<style scoped src="../../assets/css/pages/user/user-list.css">
