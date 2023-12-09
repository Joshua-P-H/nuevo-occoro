<template>
    <div class="custom-wrapper">
      <div class="custom-left">
        <h3 class="custom-title">
          <slot name="title" />
        </h3>
  
        <p class="custom-description">
          <slot name="description" />
        </p>
      </div>
  
      <div class="custom-right">
        <slot name="aside" />
      </div>
    </div>
  </template>
  
  <style>
    /* Estilos para replicar la estructura */
    .custom-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  
    .custom-left {
      margin-right: 1rem;
    }
  
    .custom-title {
      font-size: 1.25rem;
      font-weight: 500;
      margin-bottom: 0.5rem;
    }
  
    .custom-description {
      font-size: 0.875rem;
    }
  </style>
  