<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="custom-input"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>

<style>
  /* Estilos para replicar la apariencia de Tailwind */
  .custom-input {
    border-radius: 10px;
    padding: 8px;
    outline: none;
    transition: border-color 0.15s ease-in-out;
  }

  .custom-input:focus {
    border-color: #3f83f8;
    box-shadow: 0 0 0 3px rgba(63, 131, 248, 0.1);
  }
</style>
