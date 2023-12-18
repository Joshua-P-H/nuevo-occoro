<template>
  <div class="carousel-card">
    <div class="column">
      <div class="date-container">
        <div class="date">{{ formatDate(prensa.created_at) }}</div>
      </div>
      <div class="content-card">
        <div class="card" @click="openModal">
          <div class="image-container">
            <img
              :src="prensa.image_prensa"
              alt="Imagen de prensa"
              class="card-image"
            />
          </div>
          <div class="title">
            <button @click="openModal">{{ prensa.title_prensa }}</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <MyModal :show="isModalOpen" @close="closeModal" class="modal">
      <div class="conten-modal">
        <h2 class="modal-title">{{ prensa.title_prensa }}</h2>
        <img :src="prensa.image_prensa" alt="">
        <p class="noticia1">{{ prensa.content_prensa }}</p>
        <Link href="/noticias" class="noticia-link">Mas noticia</Link>

      </div>
    </MyModal>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import MyModal from "@/Components/Modal.vue";

import { ref, defineProps } from "vue";

const props = defineProps(["prensa"]);
const isModalOpen = ref(false);

const openModal = () => {
  isModalOpen.value = true;
};

const closeModal = () => {
  isModalOpen.value = false;
};

const formatDate = (date) => {
  const formattedDate = new Date(date).toLocaleDateString("es-ES", {
    month: "long",
    day: "2-digit",
  });
  return formattedDate.replace(/^(\d)$/, "0$1");
};
</script>

<style scoped>
.carousel-card {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  width: 100%;
  margin: 0 auto;
}

.column {
  width: 100%;
  margin-bottom: 20px;
  padding: 10px;
}

.content-card {
  position: relative;
  padding: 15px;
  background-color: rgb(95, 129, 161);
  border-radius: 0 0 10px 10px; /* Bordes redondeados en las dos esquinas inferiores */
}

.card {
  overflow: hidden;
}

.image-container {
  position: relative;
  overflow: hidden;
  margin-bottom: 10px; /* Ajusta el espacio entre la imagen y el título */
}

img {
  width: 100%;
  height: 100%;
  object-fit: contain;
  border-radius: 10px; /* Agrega bordes redondeados a las imágenes */
}

.date-container {
  background-color: rgba(116, 107, 107, 0.5);
  padding: 4px;
  text-align: center;
  width: auto; /* Se ajustará automáticamente al contenido */
  border-radius: 10px 10px 0 0; /* Bordes redondeados en las dos esquinas inferiores */
}

.date {
  font-size: 12px;
  color: white;
}

.title {
  font-size: 16px;
  font-weight: bold;
  margin: 10px 0;
  z-index: 0; /* Asegura que el título esté debajo de la fecha */
}

@media (max-width: 768px) {
  .column {
    width: 80%;
    max-height: 100%;
    padding: 5px;
  }
  .card-image {
    width: 100%;
    height: 100%;
    border-radius: 10px;
  }
}
.modal {
  /* Estilos para el fondo oscuro detrás del modal */
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro semi-transparente */
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  /* Estilos para el contenido del modal */
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.close {
  /* Estilos para el botón de cerrar */
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 20px;
  cursor: pointer;
}

.modal {
  z-index: 9999;
}
.modal-title{
  text-align: center;
  font-size: 30px;
}
.noticia1{
  padding: 10px;
}
.noticia-link{
  background-color: rgb(2, 122, 202);
  padding: 10px;
  border-radius: 10px;
}
</style>
