<template>
    <div class="list">
        <div slot="header" class="header">
            <h3 class="mt-5 mb-5">Update Profile</h3>
        </div>
            <b-form @submit.prevent="confirmUpdate" class="form-group ml-5">
                <b-form-group label="Name" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "currentUser.name" v-validate= "'required'" name="name" class="ml-5 mb-3 col-7"  autocomplete="name" :class="{ 'is-invalid': submitted && errors.has('name')}"></b-form-input>
                    <div v-if="submitted && errors.has('name') && !name" class="ml-5 invalid-feedback">Name is required</div>
                </b-form-group>
                <b-form-group label="Email" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "currentUser.email" v-validate= "'required'" name="email" readonly= "readonly" class="ml-5 mb-3 col-7" autocomplete="email" :class="{ 'is-invalid': submitted && errors.has('email')}"></b-form-input>
                    <div v-if="submitted && errors.has('email') && !email" class="ml-5 invalid-feedback">Email is required</div>
                </b-form-group>
                <b-form-group label="Type" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "currentUser.type" v-validate= "'required'" readonly= "readonly" name="type" class="ml-5 mb-3 col-7" :class="{ 'is-invalid': submitted && errors.has('type')}">
                    </b-form-input>
                    <div v-if="submitted && errors.has('type') && !type" class="ml-5 invalid-feedback">Type is required</div>
                </b-form-group>
                <b-form-group label="Phone" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "currentUser.phone" v-validate= "'required'" name="phone" class="ml-5 mb-3 col-7"  autocomplete="phone" :class="{ 'is-invalid': submitted && errors.has('phone')}"></b-form-input>
                    <div v-if="submitted && errors.has('phone') && !phone" class="ml-5 invalid-feedback">Phone No is required</div>
                </b-form-group>
                <b-form-group label="DateOfBirth" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="text" v-model= "currentUser.dob" v-validate= "'required'" name="dob" class="ml-5 mb-3 col-7"  autocomplete="dob" :class="{ 'is-invalid': submitted && errors.has('dob')}"></b-form-input>
                    <div v-if="submitted && errors.has('dob') && !dob" class="ml-5 invalid-feedback">Birth Date is required</div>
                </b-form-group>
                <b-form-group label="Address" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-textarea  v-model= "currentUser.address" v-validate= "'required'" name="address" class="ml-5 mb-3 col-7"  autocomplete="address" :class="{ 'is-invalid': submitted && errors.has('address')}"></b-form-textarea>
                    <div v-if="submitted && errors.has('address') && !address" class="ml-5 invalid-feedback">Address is required</div>
                </b-form-group>
                <b-form-group label="Profile" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-file @change="handleImage" name="profile" class="ml-5 mb-3 col-7" accept="image/*" :class="{ 'is-invalid': submitted && errors.has('profile')}"></b-form-file>
                    <div v-if="submitted && errors.has('profile') && !profile" class="ml-5 invalid-feedback">Profile is required</div>
                </b-form-group>  
                <b-button variant="outline" class="mb-3" @click="passwordChange(userlist.id)">changePassword</b-button>
                <div class="mt-3 offset-4">
                  <b-button variant="primary" type="submit">Confirm</b-button>
                  <b-button variant="outline-primary" type="reset" class="btnClear ml-5">Clear</b-button>
                </div>
            </b-form>
        </div>
</template>

<script src="../../services/pages/user/edit-profile.js">
</script>
<style scoped src="../../assets/css/pages/user/user-list.css">
