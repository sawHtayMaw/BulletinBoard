<template>
<v-card class="mx-auto mt-5" max-width="500">
    <v-card-title class="login-title">
        <span class="title font-weight-light">Login</span>
    </v-card-title>
    <v-form ref="form" @submit.prevent="loginData">
        <v-card-text>
            
            <div class="login-input">
                <v-text-field v-model="email" type="text" :rules="emailRules" label="Email"  hide-details="auto" ></v-text-field>
            </div>
            <div class="login-input">
                <v-text-field v-model="password" type="password" :rules="pwdRules" label="Password" hide-details="auto" ></v-text-field>
            </div>
        </v-card-text>
        <v-card-actions>
            <div class="login-action">
                <b-button type="submit" variant="primary">Login</b-button>
            </div>
        </v-card-actions>
    </v-form>
</v-card>
</template>

<script src="../../services/pages/user/login.js">
</script>

<style scoped src="../../assets/css/pages/user/login..css">

</style>
