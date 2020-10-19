<template>
<div>
    <b-navbar toggleable="lg" type="dark" variant="primary">
      <b-navbar-brand href="#" class="ml-5 p-3">SCM Bulletin Board</b-navbar-brand>
      <b-navbar-nav mode="horizontal">
        <b-nav-item
          @click="AllUser()"
          class="spacing"
          v-if="isLoggedIn &&  currentUser.type == 'Admin'"
        >Users</b-nav-item>
        <b-nav-item
          @click="UserDetail()"
          class="spacing"
          v-if="isLoggedIn"
        >User</b-nav-item>
        <b-nav-item v-if="isLoggedIn" @click="AllPost()" class="spacing">Posts</b-nav-item>
      </b-navbar-nav>
      <b-navbar-nav class="ml-auto mr-5">
        <b-nav-form>
          <b-nav-item>
          </b-nav-item>
          <b-nav-item>
            <span class="LogIn-User" @click="logIn" v-if="!isLoggedIn">Login</span>
          </b-nav-item>
          <b-nav-item @click="logOut" v-if="isLoggedIn">Logout</b-nav-item>
        </b-nav-form>
      </b-navbar-nav>
    </b-navbar>
  </div>
</template>

<script src="../services/components/layout.js">
</script>

<style scoped src="../assets/css/components/layout.css">
</style>
