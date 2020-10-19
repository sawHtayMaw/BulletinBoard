<template>
    <div class="list">
        <div slot="header">
            <h3 class="mt-5 mb-4 col-lg-12">Create Post</h3>
        </div>
            <b-form @submit.prevent="addPost" class="form-group col-lg-12">
                <b-form-group label="Title" label-for="input-default" label-cols="4" label-cols-lg="2" class="ml-5">
                    <b-form-input type="text" id="post.title" v-model= "post.title" name="post.title" v-validate="'required'" class="ml-4 mb-3 col-lg-5" autocomplete="title" :class="{ 'is-invalid': submitted && errors.has('post.title')}"></b-form-input>
                    <div v-if="submitted && errors.has('post.title') && !post.title" class="ml-4 invalid-feedback">Title is required</div>
                </b-form-group>
                <b-form-group label="Description" label-for="input-default" label-cols="4" label-cols-lg="2" class="ml-5">
                    <b-form-textarea id="post.description" v-model= "post.description" name="post.description" v-validate="'required'" class="ml-4 mb-3 col-lg-5" autocomplete="description" :class="{ 'is-invalid': submitted && errors.has('post.description')}"></b-form-textarea>
                    <div v-if="submitted && errors.has('post.description') && !post.description" class="ml-4 invalid-feedback">Description is required</div>
                </b-form-group>
                <div class="col-lg-8 offset-3">
                  <button class="btn btn-primary" type="submit">Confirm</button>
                  <button type="reset" class="btn btn-outline-primary ml-5">Clear</button>
                </div>
            </b-form>
        </div>
</template>

<script src="../../services/pages/post/post-create.js">
</script>
<style scoped src="../../assets/css/pages/post/post-list.css">
