<template>
    <button class="secondary-button">
      <slot>Secondary Button</slot>
    </button>
  </template>
  
  <style>
  .secondary-button {
    padding: 10px 20px;
    background-color: #fa1900;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-size: 16px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-right: 10px; /* Espacio entre botones */
    position: relative;
  }
  
  .secondary-button:hover {
    transform: scale(1.09);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); /* Sombra para efecto 3D */
  }
  </style>
  