<template>
  <button
    :type="type"
    class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest focus:outline-none transition ease-in-out duration-150"
    :class="dangerClasses"
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      default: "button"
    },
    variant: {
      type: String,
      default: "filled"
    }
  },

  computed: {
    dangerClasses() {
      return {
        filled:
          "bg-red-600 text-white hover:bg-red-500 focus:border-red-700 focus:shadow-outline-red active:bg-red-600",

        outline:
          "text-red-700 hover:bg-red-100 focus:border-red-800 focus:text-red-800 focus:shadow-outline-red active:bg-red-300 active:text-red-600"
      }[this.variant];
    }
  }
};
</script>
