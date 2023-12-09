<template>
    <button class="primary-button">
      <slot/>
    </button>
  </template>
    
  <style>
  .primary-button {
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    margin-right: 10px; /* Agrega margen entre los botones */
  }
  
  .primary-button:hover {
    transform: scale(1.05);
  }
  </style>
    
  <script setup>
  // Puedes añadir lógica aquí si es necesario para el comportamiento del botón
  </script>
  