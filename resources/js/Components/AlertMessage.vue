<template>
  <div class="p-4 right-0 w-full rounded-md shadow" :class="Classes">
    <div class="flex items-center justify-between">
      <div class="flex items-center">
        <span>
          <svg
            class="w-5 h-5"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              v-if="type == 'error'"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
            />

            <path
              v-else
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
        </span>

        <span class="ml-2 font-semibold text-base">{{ message }}</span>
      </div>

      <div>
        <svg
          class="w-5 h-5"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          @click="$emit('closed')"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M6 18L18 6M6 6l12 12"
          />
        </svg>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AlertMessage",

  props: {
    type: {
      type: String,
      default: "success"
    },
    message: {
      type: String,
      required: true
    }
  },

  computed: {
    Classes() {
      return {
        success: "bg-green-100 text-green-800",
        error: "bg-red-100 text-red-800"
      }[this.type];
    }
  }
};
</script>
