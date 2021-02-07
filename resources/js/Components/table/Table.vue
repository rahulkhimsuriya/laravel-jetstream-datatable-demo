<template>
  <div
    class="shadow overflow-hidden overflow-x-auto border-b border-gray-200 sm:rounded-lg"
  >
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <slot name="head" />
      </thead>

      <tbody class="bg-white divide-y divide-gray-200">
        <slot name="body" />
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "Table"
};
</script>

<style scoped></style>
