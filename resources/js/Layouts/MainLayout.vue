<template>
    <Link href="/">Home page</Link>&nbsp;
    <Link href="/hello">Show page</Link>&nbsp;
    <Link href="/listing">Listing page</Link>&nbsp;
    <Link href="/listing/create">Create page</Link>&nbsp;
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>

    <!-- <div>The page with time {{ timer }}</div> -->
    <br /><br />

    <slot>Default</slot>
</template>

<script setup>
import { computed } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
const flashSuccess = computed(
  () => page.props.flash.success,
);

// import { ref } from "vue";
// const timer = ref(0);
// setInterval(() => timer.value++, 1000);
</script>

<style scoped>
  .success {
    background-color: green;
    color: white;
  }
</style>
