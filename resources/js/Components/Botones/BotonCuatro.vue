<template>
    <button class="warning-button">
      <slot>Warning Button</slot>
    </button>
  </template>
  
  <style>
  .warning-button {
    padding: 10px 20px;
    background-color: rgb(24, 82, 19); /* Color de advertencia */
    color: #fff;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    font-size: 16px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-right: 10px; /* Espacio entre botones */
  }
  
  .warning-button:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); /* Sombra para efecto 3D */
  }
  </style>
  