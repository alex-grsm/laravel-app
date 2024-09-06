<template>
    <span>{{ formattedPrice }}</span>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    price: [Number, String],
    locale: { type: String, default: "en-US" },
    currency: { type: String, default: "USD" },
});

const formattedPrice = computed(() => {
    const priceNumber = Number(props.price);

    if (isNaN(priceNumber)) {
        return "N/A";
    }
    return priceNumber.toLocaleString(props.locale, {
        style: "currency",
        currency: props.currency,
        maximumFractionDigits: 0,
    });
});
</script>
