<template>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck1" v-model="isChecked">
      <label class="form-check-label" for="gridCheck1">
        <slot></slot>
      </label>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const isChecked = ref(false);
  </script>
  
  <style>
  /* Estilos CSS */
  .form-check {
    display: flex;
    align-items: center;
    font-size: 16px;
    margin-bottom: 10px;
  }
  
  .form-check-input {
    display: none; /* Oculta el input real */
  }
  
  .form-check-label {
    cursor: pointer;
    position: relative;
  }
  
  .form-check-label::before {
    content: '';
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-right: 8px;
    cursor: pointer;
  }
  
  .form-check-input:checked + .form-check-label::before {
    background-color: #ffffff; /* Color de fondo cuando está seleccionado */
  }
  
  .form-check-input:checked + .form-check-label::after {
    content: '✔️';
    display: inline-block;
    position: absolute;
    top: 0;
    left: 3px;
    font-size: 13px;
    color: white !important; /* Asegurarse de que el color sea blanco */
  }
  </style>
  