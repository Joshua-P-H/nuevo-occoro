<template>
  <div class="card-uno" :style="{ padding: dynamicPadding }">
    <div class="title">
      <slot name="header">
        <h1>Card Title</h1>
      </slot>
    </div>
    <div class="card-content">
      <slot></slot>
    </div>
    <slot name="footer">
      <p></p>
    </slot>
  </div>
</template>

<script setup>
const dynamicPadding = '6px'; 
const props = defineProps(['carrousel']);

</script>

<style>
.card-uno {
  display: inline-block;
  border-radius: 20px;
  margin: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
  width: fit-content;
  /* Ajusta el ancho al contenido */
  max-width: calc(100% - 20px);
  transition: transform 0.3s, background-color 0.3s; /* Agregamos una transición al hacer hover */

}

.card-uno:hover {
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);

}

.card-uno .title {
  font-size: 34px;
  margin-bottom: 10px;
  text-align: center;
}
</style>
