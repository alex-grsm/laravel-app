<template>
    <Box>
        <template #header>
            Offer #{{ offer.id }}
            <span
                v-if="offer.accepted_at"
                class="dark:bg-green-900 dark:text-green-200 bg-green-100 text-green-800 p-1 rounded-md uppercase ml-1"
            >
                accepted
            </span>
        </template>

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
                    v-if="!isSold"
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
    isSold: Boolean,
});

const difference = computed(() => props.offer.amount - props.listingPrice);
const madeOn = computed(() => new Date(props.offer.created_at).toDateString());

</script>
