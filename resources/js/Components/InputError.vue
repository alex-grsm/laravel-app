<template>
    <div>
        <div v-if="errorMessage" class="input-error">
          {{ errorMessage }}
        </div>
    </div>
</template>

<script setup>
defineProps({
    errorMessage: String,
});
</script>
