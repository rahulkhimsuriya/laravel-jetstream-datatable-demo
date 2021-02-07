<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight space-x-1">
        <inertia-link
          :href="route('organizations.index')"
          class="focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out"
        >
          Organizations
        </inertia-link>
        <span>/</span>
        <span class="opacity-75">Create</span>
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="w-full space-y-6">
          <div class="bg-white p-6 pb-0 overflow-hidden shadow sm:rounded-lg">
            <form @submit.prevent="submit">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <!-- Name -->
                <div class="w-full">
                  <jet-label for="name" value="Name" />
                  <jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autocomplete="name"
                  />
                  <jet-input-error :message="form.errors.name" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="w-full">
                  <jet-label for="email" value="Email" />
                  <jet-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                  />
                  <jet-input-error :message="form.errors.email" class="mt-2" />
                </div>

                <div class="w-full">
                  <jet-label for="phone" value="Phone" />
                  <jet-input
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    autocomplete="phone"
                  />
                  <jet-input-error :message="form.errors.phone" class="mt-2" />
                </div>

                <div class="w-full">
                  <jet-label for="address" value="Address" />
                  <jet-input
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    autocomplete="address"
                  />
                  <jet-input-error
                    :message="form.errors.address"
                    class="mt-2"
                  />
                </div>

                <div class="w-full">
                  <jet-label for="city" value="City" />
                  <jet-input
                    id="city"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.city"
                    autocomplete="city"
                  />
                  <jet-input-error :message="form.errors.city" class="mt-2" />
                </div>

                <div class="w-full">
                  <jet-label for="state" value="Province/State" />
                  <jet-input
                    id="state"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.region"
                    autocomplete="state"
                  />
                  <jet-input-error :message="form.errors.region" class="mt-2" />
                </div>

                <div class="w-full">
                  <jet-label for="country" value="Country" />
                  <select
                    class="form-select mt-1 block w-full border-gray-300 rounded-md focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    v-model="form.country"
                  >
                    <option v-for="country in countries" :value="country.value">
                      {{ country.title }}
                    </option>
                  </select>
                  <jet-input-error
                    :message="form.errors.country"
                    class="mt-2"
                  />
                </div>

                <div class="w-full">
                  <jet-label for="postal_code" value="Postal Code" />
                  <jet-input
                    id="postal_code"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.postal_code"
                    autocomplete="postal_code"
                  />
                  <jet-input-error
                    :message="form.errors.postal_code"
                    class="mt-2"
                  />
                </div>
              </div>

              <div class="flex items-center justify-end pt-6 pb-4 text-right">
                <jet-button
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Create Organization
                </jet-button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
  name: "OrganizationCreate",

  components: {
    AppLayout,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton
  },

  data() {
    return {
      countries: [
        { title: "", value: "" },
        { title: "Canada", value: "CA" },
        { title: "United States", value: "US" }
      ],
      form: this.$inertia.form({
        _method: "POST",
        name: "",
        email: "",
        phone: "",
        address: "",
        city: "",
        region: "",
        country: "",
        postal_code: ""
      })
    };
  },

  methods: {
    submit() {
      this.form.post(route("organizations.store"), {
        preserveScroll: true
      });
    }
  }
};
</script>

<style scoped></style>
