<template>
    <div class="list">
        <div slot="header">
            <h3 class="mt-5 mb-5">Change Password</h3>
        </div>
            <b-form  class="form-group" @submit.prevent="change">
                <b-form-group label="OldPassword" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="password" v-model= "user.oldPassword" name="oldPassword" class="ml-5 mb-3 col-7"  autocomplete="oldPassword" :class="{ 'is-invalid': submitted && errors.has('oldPassword')}"></b-form-input>
                    <div v-if="submitted && errors.has('oldPassword') && !title" class="invalid-feedback">Old Password is required</div>
                </b-form-group>
                <b-form-group label="NewPassword" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="password" name="newPassword" v-model= "user.newPassword" class="ml-5 mb-3 col-7" autocomplete="newPassword" :class="{ 'is-invalid': submitted && errors.has('newPassword')}"></b-form-input>
                    <div v-if="submitted && errors.has('newPassword') && !description" class="invalid-feedback">New Password is required</div>
                </b-form-group>
                <b-form-group label="ConfirmPassword" label-for="input-default" label-cols="4" label-cols-lg="2" class="label">
                    <b-form-input type="password" name="password" v-model= "user.confirmPassword" class="ml-5 mb-4 col-7" autocomplete="confirmPassword" :class="{ 'is-invalid': submitted && errors.has('confirmPassword')}"></b-form-input>
                    <div v-if="submitted && errors.has('confirmPassword') && !description" class="invalid-feedback">Confirm confirmPassword is required</div>
                </b-form-group>
                <div class="offset-4">
                    <b-button variant="primary" type="submit">Confirm</b-button>
                  <b-button variant="outline-primary" type="submit" class=" ml-5">Clear</b-button>
                </div>
            </b-form>
        </div>
</template>

<script src="../../services/pages/user/change-password.js">
</script>
<style scoped src="../../assets/css/pages/user/user-list.css">