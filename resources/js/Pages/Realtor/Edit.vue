<template>
    <form @submit.prevent="update">
      <div class="grid grid-cols-6 gap-4">
        <div class="col-span-2">
          <label class="label">Beds</label>
          <input v-model.number="form.beds" type="text" class="input" />
          <InputError :error-message="form.errors.beds" />
        </div>

        <div class="col-span-2">
          <label class="label">Baths</label>
          <input v-model.number="form.baths" type="text" class="input" />
          <InputError :error-message="form.errors.baths" />
        </div>

        <div class="col-span-2">
          <label class="label">Area</label>
          <input v-model.number="form.area" type="text" class="input" />
          <InputError :error-message="form.errors.area" />
        </div>

        <div class="col-span-4">
          <label class="label">City</label>
          <input v-model.trim="form.city" type="text" class="input" />
          <InputError :error-message="form.errors.city" />
        </div>

        <div class="col-span-2">
          <label class="label">Post Code</label>
          <input v-model.trim="form.code" type="text" class="input" />
          <InputError :error-message="form.errors.code" />
        </div>

        <div class="col-span-4">
          <label class="label">Street</label>
          <input v-model.trim="form.street" type="text" class="input" />
          <InputError :error-message="form.errors.street" />
        </div>

        <div class="col-span-2">
          <label class="label">Street Nr</label>
          <input v-model.number="form.street_nr" type="text" class="input" />
          <InputError :error-message="form.errors.street_nr" />
        </div>

        <div class="col-span-6">
          <label class="label">Price</label>
          <input v-model.number="form.price" type="text" class="input" />
          <InputError :error-message="form.errors.price" />
        </div>

        <div class="col-span-6">
          <button type="submit" class="btn-primary">Edit</button>
        </div>
      </div>
    </form>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  listing: Object,
})

const form = useForm({
  beds: props.listing.beds,
  baths: props.listing.baths,
  area: props.listing.area,
  city: props.listing.city,
  street: props.listing.street,
  code: props.listing.code,
  street_nr: props.listing.street_nr,
  price: props.listing.price,
})
const update = () => form.put(route('realtor.listing.update', {listing: props.listing.id}))
</script>
