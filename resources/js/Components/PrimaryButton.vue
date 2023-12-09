<template>
    <button :type="type" class="custom-button">
      <slot />
    </button>
  </template>
  
  <style>
    /* Estilos para replicar la apariencia del botón */
    .custom-button {
      display: inline-flex;
      align-items: center;
      padding: 8px 16px;
      background-color: rgb(175, 146, 146);
      border: none;
      border-radius: 4px;
      font-weight: bold;
      font-size: 12px;
      color: #000000;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      cursor: pointer;
      transition: background-color 0.3s ease;
      outline: none;
    }
  
    .custom-button:hover {
      background-color: #3aa724;
    }
  
    .custom-button:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(0, 80, 209, 0.5);
    }
  </style>
  
  <script setup>
    defineProps({
      type: {
        type: String,
        default: 'submit',
      },
    });
  </script>
  