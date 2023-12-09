<template>
    <div>
      <div v-show="on" class="custom-transition">
        <slot />
      </div>
    </div>
  </template>
  
  <style>
    /* Estilos para la transición */
    .custom-transition {
      transition: opacity 1s ease-in;
      opacity: 1;
      background: rgb(6, 107, 16);
      border-radius: 10px;
    }
  
    .custom-transition[style*="display: none;"] {
      opacity: 0;
    }
  </style>
  
  <script setup>
    defineProps({
      on: Boolean,
    });
  </script>
  