<template>
      <div v-if="prensa">
        <div class="prensa">
          <div class="title">
            <h1 class="custom-title">{{ prensa.title_prensa }}</h1>
          </div>
          <div class="content-wrapper">
            <div class="img-content">
              <img :src="'../' + prensa.image_prensa" class="img-responsive" />
              <div class="content-data-noticia">
                <div class="column date">
                  {{ formatDate(prensa.created_at) }}
                </div>
                <div class="column noticia">
                  <Link href="/noticias" class="noticia-link">Noticia</Link>
                </div>
              </div>
            </div>

            <div class="prensa-content">
              <p>{{ prensa.content_prensa }}</p>
            </div>
          </div>
        </div>
      </div>
</template>

<style scoped>
.title {
  background-color: aqua;
  text-align: center;
}

.custom-title {
  color: #333;
  font-size: 24px;
}

.img-content {
  width: 100%;
  max-width: 400px; /* Tamaño máximo para la imagen en pantallas pequeñas */
  margin: 0 auto 20px; /* Centra la imagen y agrega espacio inferior */
}

.img-responsive {
  width: 100%;
  height: auto;
  border-radius: 10px; /* Agrega bordes redondeados a la imagen */
}

.content-data-noticia {
  margin-top: 10px; /* Agrega espacio entre la imagen y la fecha */
  text-align: center; /* Ajusta el texto al centro */
  display: grid;
  grid-template-columns: 1fr 1fr; /* Divide en dos columnas de tamaño igual */
  grid-column-gap: 10px; /* Espacio entre las columnas */
}

.column {
  text-align: center; /* Ajusta el texto al centro en cada columna */
}

.date {
  font-size: 14px; /* Ajusta el tamaño de la fecha según sea necesario */
}

.noticia-link {
  font-size: 14px; /* Ajusta el tamaño del enlace según sea necesario */
}

.prensa-content {
  padding: 5px; /* Agrega espacio alrededor de .prensa-content */
  width: 100%; /* Ocupa todo el ancho de su contenedor */
  margin: 0; /* Elimina márgenes */
  text-align: justify;
  text-justify: inter-word;
}

.content-wrapper {
  box-sizing: border-box; /* Incluye el padding en el ancho y alto total del elemento */
  padding: 10px; /* Agrega espacio alrededor de .content-wrapper */
  display: flex;
  flex-direction: column;
  align-items: center; /* Centra elementos en el eje cruzado */
}

@media (max-width: 768px) {
  .img-content {
    max-width: 100%; /* Ajusta el tamaño máximo para pantallas pequeñas */
  }
}

@media (min-width: 1200px) {
  .img-content {
    max-width: 600px; /* Tamaño máximo para la imagen en pantallas grandes */
  }
}
</style>

<script setup>
import LayoutWelcome from "@/Layouts/LayoutWelcome.vue";

import { Link } from "@inertiajs/vue3";

const props = defineProps({
  prensa: Object,
});
const formatDate = (date) => {
  const formattedDate = new Date(date).toLocaleDateString("es-ES", {
    month: "long",
    day: "2-digit",
  });
  return formattedDate.replace(/^(\d)$/, "0$1");
};
</script>
