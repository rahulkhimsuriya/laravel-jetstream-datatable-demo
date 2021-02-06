<template>
  <th
    scope="col"
    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
    :class="{ 'cursor-pointer': sortable }"
    @click="toggle"
  >
    <slot />

    <template v-if="sortable">
      <span class="ml-2 md:ml-4 inline-block align-bottom">
        <svg
          class="w-4 h-4"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <template v-if="sortOrder == 'asc'">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M19 9l-7 7-7-7"
            />
          </template>

          <template v-if="sortOrder == 'desc'">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M5 15l7-7 7 7"
            />
          </template>
        </svg>
      </span>
    </template>
  </th>
</template>

<script>
export default {
  name: "Heading",

  props: {
    sortable: {
      type: Boolean,
      default: false
    },
    direction: {
      type: String,
      default: "asc"
    },
    fieldName: {
      type: String
    }
  },

  data() {
    return {
      sortField: this.fieldName,
      sortOrder: this.direction
    };
  },

  methods: {
    toggle() {
      this.handleEvent();

      this.sortOrder = this.sortOrder == "asc" ? "desc" : "asc";
    },

    handleEvent() {
      this.$emit("sorted", {
        sortField: this.sortField,
        sortOrder: this.sortOrder
      });
    }
  }
};
</script>

<style scoped>
th span {
  opacity: 0%;
  transition: opacity 0.3s ease-in-out;
}

th:hover span {
  opacity: 100%;
}
</style>
