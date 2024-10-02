<template>
    <Box>
        <template #header>Offer #{{ offer.id }}</template>
        <section class="flex items-center justify-between">
            <div>
                <PriceDisplay
                    :price="offer.amount"
                    locale="de-DE"
                    currency="EUR"
                    class="text-xl"
                />
                <div class="text-gray-500">
                    Difference
                    <PriceDisplay
                        :price="difference"
                        locale="de-DE"
                        currency="EUR"
                    />
                </div>
                <div class="text-gray-500 text-sm">
                    Made by {{ offer.bidder.name }}
                </div>
                <div class="text-gray-500 text-sm">Made on {{ madeOn }}</div>
            </div>
            <div>
                <Link
                    :href="route('realtor.offer.accept', { offer: offer.id })"
                    method="put"
                    class="btn-outline text-xs font-medium"
                    as="button"
                >
                    Accept
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import PriceDisplay from "@/Components/PriceDisplay.vue";
import Box from "@/Components/UI/Box.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    offer: Object,
    listingPrice: Number,
});

const difference = computed(() => props.offer.amount - props.listingPrice);
const madeOn = computed(() => new Date(props.offer.created_at).toDateString());
</script>
