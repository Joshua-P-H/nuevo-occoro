<script setup>
  defineProps({
    value: String,
  });
</script>

<template>
  <label class="">
    <span v-if="value">{{ value }}</span>
    <span v-else><slot /></span>
  </label>
</template>

<style>
  label {
    display: block;
    font-weight: 500;
    font-size: 0.875rem; /* Equivalente a 14px, ajusta según necesites */
  }
</style>
