<template>
    <div class="list">
        <div slot="header" class="header">
            <h3 class="mt-5 mb-5">Confirm Update Profile</h3>
        </div>
                    <img :src= "userlist.profile" class="preview mr-5">
            <b-form @submit.prevent="updated" class="form-group ml-5">
                <b-form-group label="Name" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "userlist.name" name="name" readonly= "readonly" class="ml-5 mb-3 col-7"  autocomplete="name" :class="{ 'is-invalid': submitted && errors.has('name')}"></b-form-input>
                    <div v-if="submitted && errors.has('name') && !title" class="invalid-feedback">Name is required</div>
                </b-form-group>
                <b-form-group label="Email" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "userlist.email" name="email" readonly= "readonly" class="ml-5 mb-3 col-7" autocomplete="email" :class="{ 'is-invalid': submitted && errors.has('email')}"></b-form-input>
                    <div v-if="submitted && errors.has('email') && !description" class="invalid-feedback">Email is required</div>
                </b-form-group>
                <b-form-group label="Type" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "userlist.type" readonly= "readonly" name="type" class="ml-5 mb-3 col-7" :class="{ 'is-invalid': submitted && errors.has('type')}">
                    </b-form-input>
                    <div v-if="submitted && errors.has('password') && !title" class="invalid-feedback">Type is required</div>
                </b-form-group>
                <b-form-group label="Phone" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "userlist.phone" name="phone" readonly= "readonly" class="ml-5 mb-3 col-7"  autocomplete="phone" :class="{ 'is-invalid': submitted && errors.has('phone')}"></b-form-input>
                    <div v-if="submitted && errors.has('phone') && !title" class="invalid-feedback">Phone No is required</div>
                </b-form-group>
                <b-form-group label="DateOfBirth" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "userlist.dob" name="dob" readonly= "readonly" class="ml-5 mb-3 col-7"  autocomplete="dob" :class="{ 'is-invalid': submitted && errors.has('dob')}"></b-form-input>
                    <div v-if="submitted && errors.has('dob') && !title" class="invalid- feedback">Birth Date is required</div>
                </b-form-group>
                <b-form-group label="Address" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-textarea  v-model= "userlist.address" name="address" readonly= "readonly" class="ml-5 mb-3 col-7"  autocomplete="address" :class="{ 'is-invalid': submitted && errors.has('address')}"></b-form-textarea>
                    <div v-if="submitted && errors.has('address') && !title" class="invalid-feedback">Address is required</div>
                </b-form-group>
                <div class="mt-3 offset-4">
                  <b-button variant="primary" type="submit">Update</b-button>
                  <b-button variant="outline-primary" class=" ml-5" @click="back">Cancel</b-button>
                </div>
            </b-form>
        </div>
</template>

<script src="../../services/pages/user/confirmedit-profile.js">
</script>
<style scoped src="../../assets/css/pages/user/user-list.css">
