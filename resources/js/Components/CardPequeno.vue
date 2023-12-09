<template>
    <div class="custom-card">  
      <div class="custom-content">
        <slot />
      </div>
    </div>
  </template>
  
  <style>
  /* Estilos para replicar la estructura de una tarjeta */
  .custom-card {
    display: inline-block; /* Cambio a inline-block para ajustar al contenido */
    border-radius: 10px;
    padding: 10px;
    width: fit-content; /* Ancho ajustado al contenido */
    height: fit-content; /* Altura ajustada al contenido */
    transition: transform 0.3s, background-color 0.3s; /* Agregamos una transición al hacer hover */

  }

  
  .custom-content {
    width: 100%;
  }
  
  /* Media query para pantallas más pequeñas */
  @media (max-width: 768px) {
    .custom-content {
      max-width: 90%; /* Cambia el ancho máximo para pantallas más pequeñas */
    }
  }
  </style>
  