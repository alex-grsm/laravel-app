<template>
    <Link href="/">Home page</Link>&nbsp;
    <Link href="/hello">Show page</Link>&nbsp;
    <Link href="/listing">Listing page</Link>&nbsp;
    <Link href="/listing/create">Create page</Link>&nbsp;
    <!-- <div>The page with time {{ timer }}</div> -->
    <br /><br />

    <slot>Default</slot>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
// import { ref } from "vue";

// const timer = ref(0);
// setInterval(() => timer.value++, 1000);
</script>
