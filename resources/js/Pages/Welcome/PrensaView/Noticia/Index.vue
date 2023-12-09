<template>
  <LayoutWelcome>
    <h1>TODAS LAS NOTICIAS</h1>
    <div class="prensa" v-for="prensa in prensas" :key="prensa.id">
      <div class="title">
        <h1 class="custom-title">{{ prensa.title_prensa }}</h1>
      </div>
      <div class="content-wrapper">
        <div class="img-content">
          <img
            :src="prensa.image_prensa"
            alt="Imagen de prensa"
            class="card-image"
          />
          <div class="content-data-noticia">
            <div class="column date">{{ formatDate(prensa.created_at) }}</div>
            <div class="column noticia">
              <Link href="/" class="noticia-link">Inicio</Link>
            </div>
          </div>
        </div>
        <div class="prensa-content">
          <p>{{ prensa.content_prensa }}</p>
        </div>
      </div>
    </div>
  </LayoutWelcome>
</template>

<script setup>
import { ref, defineProps } from "vue";
import LayoutWelcome from "@/Layouts/LayoutWelcome.vue";
import { Link } from "@inertiajs/vue3";

const { prensas } = defineProps(["prensas"]);
const formatDate = (date) => {
  const formattedDate = new Date(date).toLocaleDateString("es-ES", {
    year: "numeric",
    month: "long",
    day: "2-digit",
  });
  return formattedDate.replace(/^(\d)$/, "0$1");
};
</script>

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
  max-width: 80%; /* Ajusta el tamaño máximo de la imagen según tus necesidades */
  margin: 0 auto 20px; /* Centra la imagen horizontalmente y agrega espacio inferior */

}

.img-responsive {
  width: 100%;
}

.content-data-noticia {
  margin-top: 10px;
  text-align: center;
  grid-template-columns: 1fr 1fr;
  grid-column-gap: 10px;
}

.column {
  text-align: center;
}

.date {
  font-size: 14px;
}

.noticia-link {
  font-size: 14px;
}

.prensa-content {
  padding: 5px;
  width: 100%;
  margin: 0;
  text-align: justify;
  text-justify: inter-word;
}

.content-wrapper {
  box-sizing: border-box;
  padding: 10px;
  flex-direction: column;


}

@media (max-width: 768px) {
  .img-content {
    max-width: 100%;
  }
}

@media (min-width: 1200px) {
  .img-content {
    width: 100%;
  }
}
</style>
