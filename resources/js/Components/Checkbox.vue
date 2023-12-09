<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        default: false,
    },
    value: {
        type: String,
        default: null,
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit('update:checked', val);
    },
});
</script>


<template>
    <label class="custom-checkbox">
      <input
        type="checkbox"
        v-model="proxyChecked"
        :value="value"
        class="visually-hidden"
      >
      <span class="custom-checkbox-span"></span>
    </label>
  </template>
  
  <style>
    /* Estilos para replicar un checkbox similar a Tailwind con CSS */
    .custom-checkbox {
      display: inline-block;
      vertical-align: middle;
      position: relative;
      cursor: pointer;
    }
  
    .custom-checkbox-span {
      display: inline-block;
      width: 20px;
      height: 20px;
      position: relative;
      border-radius: 4px;
      transition: background-color 0.3s;
    }
  
    .custom-checkbox-span::after {
      content: "";
      display: block;
      position: absolute;
      top: 3px;
      left: 3px;
      width: 12px;
      height: 12px;
      border-radius: 2px;
      transition: left 0.3s;
    }
  
    .visually-hidden {
      position: absolute;
      overflow: hidden;
      clip: rect(0 0 0 0);
      height: 1px;
      width: 1px;
      margin: -1px;
      padding: 0;
      border: 0;
    }
  
    .visually-hidden:focus {
      position: static;
      overflow: visible;
      clip: auto;
      height: auto;
      width: auto;
    }
  
    .visually-hidden + .custom-checkbox-span {
      border-color: #ce1717;
    }
  
    .visually-hidden:checked + .custom-checkbox-span {
      border-color: #0749b9;
    }
  
    .visually-hidden:checked + .custom-checkbox-span::after {
      left: 5px;
    }
  </style>
  