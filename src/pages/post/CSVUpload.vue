<template>
    <div class="uploadContainer">
        <div slot="header">
            <h4 class="mt-5 mb-5 ml-3">Upload CSV File</h4>
        </div>
            <span class="col-6 ml-5">Import File Form:</span>
        <div class="uploadFile pt-4 pb-3 mt-3 ml-5">
            <b-form-file @change="uploadFile" v-model="csvfile" :multiple="false" :auto-upload= "false" accept=".csv" class="mt-3 ml-5" plain></b-form-file>
            <b-button variant="primary" @click="upload(uploadData)" class="btnUpload mt-5 offset-2">import file</b-button>
            <b-button variant="primary" @click="goToPostList" class="mt-5 ml-3">OK</b-button>
        </div>
    </div>
</template>

<script src="../../services/pages/post/post-upload.js">
</script>
<style scoped src="../../assets/css/pages/post/post-list.css">
