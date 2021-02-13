<template>
  <tr :class="{ 'hover:bg-gray-100': !heading }">
    <slot />
  </tr>
</template>

<script>
export default {
  name: "Row",

  props: {
    heading: {
      typer: Boolean,
      default: false
    }
  }
};
</script>

<style scoped></style>
