<template>
    <div class="list">
        <div slot="header">
            <h3 class="mt-5 mb-4 col-lg-12">ConfirmCreate Post</h3>
        </div>
            <b-form @submit.prevent="createPost" class="form-group col-lg-12">
                <b-form-group label="Title" label-for="input-default" label-cols="4" label-cols-lg="2" class="ml-5">
                    <b-form-input type="text" v-model= "postlist.title" name="title" readonly="readonly" class="ml-4 mb-3 col-lg-5"  autocomplete="title"></b-form-input>
                </b-form-group>
                <b-form-group label="Description" label-for="input-default" label-cols="4" label-cols-lg="2" class="ml-5">
                    <b-form-textarea name="description" v-model= "postlist.description" readonly="readonly" class="ml-4 mb-3 col-lg-5" autocomplete="description"></b-form-textarea>
                </b-form-group>
                <div class="col-lg-8 offset-3">
                  <button class="btn btn-primary" type="submit">Create</button>
                  <button class="btn btn-outline-primary ml-5" @click="back">Cancel</button>
                </div>
            </b-form>
        </div>
</template>

<script src="../../services/pages/post/post-confirm.js">
</script>
<style scoped src="../../assets/css/pages/post/post-list.css">
