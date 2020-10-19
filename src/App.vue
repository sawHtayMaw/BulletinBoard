<template>
<div id="app">
    <Layout />
    <router-view />
</div>
</template>

<script>
import Layout from './components/Layout';

export default {
    name: 'App',
    components: {
        Layout,
    },
        
};
</script>
