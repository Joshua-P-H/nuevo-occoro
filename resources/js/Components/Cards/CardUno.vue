<template>
  <div class="carousel-card">
    <transition>
      <div class="card-list">
        <div class="card-uno">
          <div class="title">
            <slot name="header"></slot>
          </div>
          <div class="card-content">
            <slot></slot>
          </div>
          <div class="footer">
            <slot name="footer"></slot>
          </div>
        </div>
        <!-- Agrega más tarjetas según sea necesario -->
      </div>
    </transition>
  </div>
</template>

<style scoped>
.carousel-card {
}

.card-uno {
  /* Ajusta estilos específicos de la tarjeta según sea necesario */
  margin-right: 5px; /* Aumentar el espacio entre tarjetas */
  border-radius: 20px;
  margin: 10px;
}

.title,
.card-content {
  /* Ajusta estilos de los elementos internos de la tarjeta según sea necesario */
  padding: 5px; /* Añadir espaciado interno alrededor del contenido */
}

.footer {
  display: flex;
  justify-content: center; /* Centrar horizontalmente */
  align-items: center; /* Centrar verticalmente */
  padding: 2px; /* Añadir espaciado interno alrededor del contenido */
}
</style>

<script setup>
import { ref } from 'vue';
</script>
