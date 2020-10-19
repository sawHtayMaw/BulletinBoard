<template>
  <div class="container">
    <div slot="header">
      <h4 class="mt-5 mb-5 ml-3">Post List</h4>
    </div>
    <b-row class="mb-5 col-12">
      <b-input type="text" class="textbox ml-3 col-md-3" v-model="search"></b-input>
      <b-button variant="primary" class="ml-3 pr-5 pl-5" @click="searchList">Search</b-button>
      <b-button variant="primary" class="ml-3 pr-5 pl-5" @click="addPost()" v-if="isLoggedIn">Add</b-button>
      <b-button variant="primary" class="ml-3 pr-5 pl-5" @click="upload()" v-if="isLoggedIn">Upload</b-button>
      <b-button variant="primary" class="ml-3 pr-5 pl-5" @click="download()" v-if="isLoggedIn">Download</b-button>
    </b-row>
    <b-table
      class="col-lg-12 table"
      striped
      responsive
      :items= postlist
      :fields="postArray"
      :current-page="currentPage"
      :per-page="perPage"
    >
      <template v-slot:cell(edit)="data">
        <b-button
          variant="primary"
          v-if="isLoggedIn"
          class="btn mr-sm-2 ml-5 pr-4 pl-4"
          @click="editData(data.item.id)"
        >Edit</b-button>
        <b-button
          variant="danger"
          v-if="isLoggedIn"
          class="btn ml-3 pr-3 pl-3"
          @click="deleteData(data.item.id)"
        >Delete</b-button>
      </template>
    </b-table>
    <b-pagination v-model="currentPage" :total-rows="rows" class="pagination mt-5 offset-4"></b-pagination>
  </div>
</template>
<script src="../../services/pages/post/post-list.js">
</script>
<style scoped src="../../assets/css/pages/post/post-list.css">
