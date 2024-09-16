<template>
    <Box>
        <div>
            <Link :href="route('listing.show', { listing: listing.id })">
                <div class="flex items-center gap-1">
                    <PriceDisplay
                        :price="listing.price"
                        locale="de-DE"
                        currency="EUR"
                        class="text-2xl font-bold"
                    />
                    <div class="text-xs text-gray-500">
                        <PriceDisplay
                            :price="monthlyPayment"
                            locale="de-DE"
                            currency="EUR"
                        />
                        pm
                    </div>
                </div>
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Link>
        </div>
        <!-- <div v-if="$attrs.user"> -->
        <div>
            <Link :href="route('listing.edit', { listing: listing.id })">
                Edit
            </Link>
        </div>
        <div v-if="$attrs.user">
            <Link
                :href="route('listing.destroy', { listing: listing.id })"
                method="DELETE"
                as="button"
            >
                Delete
            </Link>
        </div>
    </Box>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";
import Box from "@/Components/UI/Box.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import PriceDisplay from "@/Components/PriceDisplay.vue";
import { useMonthlyPayment } from "@/Composables/useMonthlyPayment";

const props = defineProps({
    listing: Object,
});

const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);
</script>
