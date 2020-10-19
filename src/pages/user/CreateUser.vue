<template>
    <div class="list">
        <div slot="header">
            <h3 class="mt-5 mb-5">Create User</h3>
        </div>
            <b-form @submit.prevent="createUser" class="form-group ml-5">
                <b-form-group label="Name" label-for="input-default" label-cols="5" label-cols-lg="3" class="label">
                    <b-form-input type="text" v-model= "user.name" v-validate= "'required'" name="user.name" class="ml-5 mb-3 col-9"  autocomplete="name" :class="{ 'is-invalid': submitted && errors.has('user.name')}"></b-form-input>
                    <div v-if="submitted && errors.has('user.name') && !user.name" class="ml-5 invalid-feedback">Name is required</div>
                </b-form-group>
                <b-form-group label="Email" label-for="input-default" label-cols="5" label-cols-lg="3" class="label">
                    <b-form-input type="email" v-model= "user.email" v-validate= "'required'" name="user.email" class="ml-5 mb-3 col-9" autocomplete="email" :class="{ 'is-invalid': submitted && errors.has('user.email')}"></b-form-input>
                    <div v-if="submitted && errors.has('user.email') && !user.email" class="ml-5 invalid-feedback">Email is required</div>
                </b-form-group>
                <b-form-group label="Password" label-for="input-default" label-cols="5" label-cols-lg="3" class="label">
                    <b-form-input type="password" v-model= "user.password" v-validate= "'required'" name="user.password" class="ml-5 mb-3 col-9"  autocomplete="password" :class="{ 'is-invalid': submitted && errors.has('user.password')}"></b-form-input>
                    <div v-if="submitted && errors.has('user.password') && !user.password" class="ml-5 invalid-feedback">Password is required</div>
                </b-form-group>
                <b-form-group label="ConfirmPassword" label-for="input-default" label-cols="5" label-cols-lg="3" class="label">
                    <b-form-input type="password" v-model= "user.confirmpassword" v-validate= "'required'" name="user.confirmpassword" class="ml-5 mb-3 col-9"  autocomplete="confirmpassword" :class="{ 'is-invalid': submitted && errors.has('user.confirmpassword')}"></b-form-input>
                    <div v-if="submitted && errors.has('user.confirmpassword') && !user.confirmpassword" class="ml-5 invalid-feedback">Password is required</div>
                </b-form-group>
                <b-form-group label="Type" label-for="input-default" label-cols="5" label-cols-lg="3" class="label">
                    <b-form-select v-model= "user.type" v-validate= "'required'" name="user.type" class="ml-5 mb-3 col-9" :class="{ 'is-invalid': submitted && errors.has('user.type')}">
                        <b-form-select-option value="0">Admin</b-form-select-option>
                        <b-form-select-option value="1">User</b-form-select-option>
                    </b-form-select>
                    <div v-if="submitted && errors.has('user.type') && !user.type" class="ml-5 invalid-feedback">Type is required</div>
                </b-form-group>
                <b-form-group label="Phone" label-for="input-default" label-cols="5" label-cols-lg="3" class="label">
                    <b-form-input type="number" v-model= "user.phone" v-validate= "'required'" name="user.phone" class="ml-5 mb-3 col-9"  autocomplete="phone" :class="{ 'is-invalid': submitted && errors.has('user.phone')}"></b-form-input>
                    <div v-if="submitted && errors.has('user.phone') && !user.phone" class="ml-5 invalid-feedback">Phone No is required</div>
                </b-form-group>
                <b-form-group label="DateOfBirth" label-for="input-default" label-cols="5" label-cols-lg="3" class="label">
                    <b-form-input type="date" v-model= "user.dob" v-validate= "'required'" name="user.dob" class="ml-5 mb-3 col-9" autocomplete="dob" :class="{ 'is-invalid': submitted && errors.has('user.dob')}"></b-form-input>
                    <div v-if="submitted && errors.has('user.dob') && !user.dob" class="ml-5 invalid-feedback">DOB is required</div>
                </b-form-group>
                <b-form-group label="Address" label-for="input-default" label-cols="5" label-cols-lg="3" class="label">
                    <b-form-textarea  v-model= "user.address" v-validate= "'required'" name="user.address" class="ml-5 mb-3 col-9"  autocomplete="address" :class="{ 'is-invalid': submitted && errors.has('user.address')}"></b-form-textarea>
                    <div v-if="submitted && errors.has('user.address') && !user.address" class="ml-5 invalid-feedback">Address is required</div>
                </b-form-group>
                <b-form-group label="Profile" label-for="input-default" label-cols="5" label-cols-lg="3" class="label">
                    <b-form-file @change="handleImage" v-model= "user.profile" v-validate= "'required'" name="user.profile" class="ml-5 mb-4 col-9" accept="image/*" :class="{ 'is-invalid': submitted && errors.has('user.profile')}"></b-form-file>
                    <div v-if="submitted && errors.has('user.profile') && !user.profile" class="ml-5 invalid-feedback">Profile is required</div>
                </b-form-group>
                <div class="offset-5">
                  <b-button variant="primary" type="submit">Confirm</b-button>
                  <b-button variant="outline-primary" type="reset" class=" ml-4">Clear</b-button>
                </div>
            </b-form>
        </div>
</template>

<script src="../../services/pages/user/user-create.js">
</script>
<style scoped src="../../assets/css/pages/user/user-list.css">
