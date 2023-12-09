<template>
    <div class="custom-container">
      <div class="custom-logo">
        <slot name="logo" />
      </div>
  
      <div class="custom-content">
        <slot />
      </div>
    </div>
  </template>
  
  <style>
    /* Estilos para replicar la estructura */
    .custom-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
  
    .custom-content {
      width: 100%;
      max-width: 28rem;
      margin-top: 1.5rem;
      padding: 1.5rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 0.375rem;
    }
  </style>
  