<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="listing.images.length" class="md:col-span-7 flex items-center">
            <div class="grid grid-cols-2 gap-1">
                <img
                    v-for="image in listing.images"
                    :key="image.id"
                    :src="image.src"
                />
            </div>
        </Box>
        <EmptyState v-else class="md:col-span-7 flex items-center">No images</EmptyState>

        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header> Basic info </template>
                <PriceDisplay
                    :price="listing.price"
                    locale="de-DE"
                    currency="EUR"
                    class="text-2xl font-bold"
                />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>

            <Box>
                <template #header> Monthly Payment </template>
                <div>
                    <label class="label"
                        >Interest rate ({{ interestRate }}%)</label
                    >
                    <input
                        v-model.number="interestRate"
                        type="range"
                        min="0.1"
                        max="30"
                        step="0.1"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />

                    <label class="label">Duration ({{ duration }} years)</label>
                    <input
                        v-model.number="duration"
                        type="range"
                        min="3"
                        max="35"
                        step="1"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />

                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <PriceDisplay
                            :price="monthlyPayment"
                            locale="de-DE"
                            currency="EUR"
                            class="text-3xl"
                        />
                    </div>

                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Total paid</div>
                            <div>
                                <PriceDisplay
                                    :price="totalPaid"
                                    locale="de-DE"
                                    currency="EUR"
                                    class="font-medium"
                                />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>Principal paid</div>
                            <div>
                                <PriceDisplay
                                    :price="listing.price"
                                    locale="de-DE"
                                    currency="EUR"
                                    class="font-medium"
                                />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>Interest paid</div>
                            <div>
                                <PriceDisplay
                                    :price="totalInterest"
                                    locale="de-DE"
                                    currency="EUR"
                                    class="font-medium"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </Box>
            <MakeOffer
                v-if="user && !offerMade"
                :listing-id="listing.id"
                :price="listing.price"
            />

            <OfferMade v-if="user && offerMade" :offer="offerMade" />
        </div>
    </div>
</template>

<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import PriceDisplay from "@/Components/PriceDisplay.vue";
import Box from "@/Components/UI/Box.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";
import MakeOffer from "@/Pages/Listing/Show/MakeOffer.vue";
import { ref, computed } from "vue";
import { useMonthlyPayment } from "@/Composables/useMonthlyPayment";
import { usePage } from "@inertiajs/vue3";
import OfferMade from "@/Pages/Listing/Show/OfferMade.vue";

const props = defineProps({
    listing: Object,
    offerMade: Object,
});

const interestRate = ref(2.5);
const duration = ref(25);

// Calculate monthly payment
const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
    props.listing.price,
    interestRate,
    duration
);

const page = usePage();
const user = computed(() => page.props.user);
</script>
