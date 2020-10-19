<template>
    <div class="list">
        <div slot="header">
            <h3 class="mt-5 mb-5">Confirm Create User</h3>
        </div>
                    <img :src= "userlist.profile" class="preview mr-5">
                    <div v-if="submitted && errors.has('profile') && !profile" class="invalid-feedback">Profile is required</div>
            <b-form @submit.prevent="confirmCreate" class="form-group ml-5 mt-5">
                <b-form-group label="Name" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "userlist.name" name="name" readonly="readonly" class="ml-5 mb-3 col-lg-8"  autocomplete="name" :class="{ 'is-invalid': submitted && errors.has('name')}"></b-form-input>
                    <div v-if="submitted && errors.has('title') && !title" class="invalid-feedback">Name is required</div>
                </b-form-group>
                <b-form-group label="Email" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="email" v-model= "userlist.email" name="email" readonly="readonly" class="ml-5 mb-3 col-lg-8" autocomplete="email" :class="{ 'is-invalid': submitted && errors.has('email')}"></b-form-input>
                    <div v-if="submitted && errors.has('email') && !description" class="invalid-feedback">Email is required</div>
                </b-form-group>
                <b-form-group label="Password" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="password" v-model= "userlist.password" name="password" readonly="readonly" class="ml-5 mb-3 col-lg-8"  autocomplete="password" :class="{ 'is-invalid': submitted && errors.has('password')}"></b-form-input>
                    <div v-if="submitted && errors.has('password') && !title" class="invalid-feedback">Password is required</div>
                </b-form-group>
                <b-form-group label="Type" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "userlist.type" name="type" readonly="readonly" class="ml-5 mb-3 col-lg-8" :class="{ 'is-invalid': submitted && errors.has('type')}">
                    </b-form-input>
                    <div v-if="submitted && errors.has('password') && !title" class="invalid-feedback">Type is required</div>
                </b-form-group>
                <b-form-group label="Phone" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="number" v-model= "userlist.phone" name="phone" readonly="readonly" class="ml-5 mb-3 col-lg-8"  autocomplete="phone" :class="{ 'is-invalid': submitted && errors.has('phone')}"></b-form-input>
                    <div v-if="submitted && errors.has('phone') && !title" class="invalid-feedback">Phone No is required</div>
                </b-form-group>
                <b-form-group label="DateOfBirth" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="date" v-model= "userlist.dob" name="dob" readonly="readonly" class="ml-5 mb-3 col-lg-8"  autocomplete="dob" :class="{ 'is-invalid': submitted && errors.has('dob')}"></b-form-input>
                    <div v-if="submitted && errors.has('dob') && !title" class="invalid-feedback">Birth Date is required</div>
                </b-form-group>
                <b-form-group label="Profile" label-for="input-default" label-cols="4" label-cols-lg="2" class="label" style="display:none">
                    <b-form-file v-model= "userlist.profile" name="profile" readonly="readonly" class="ml-5 mb-4 col-lg-8" accept="image/*" :class="{ 'is-invalid': submitted && errors.has('profile')}"></b-form-file>
                </b-form-group>
                <div class="offset-4">
                  <b-button variant="primary" type="submit">Create</b-button>
                  <b-button variant="outline-primary" @click="back" class=" ml-5">Cancel</b-button>
                </div>
            </b-form>
        </div>
</template>

<script src="../../services/pages/user/user-confirm.js">
</script>
<style scoped src="../../assets/css/pages/user/user-list.css">
