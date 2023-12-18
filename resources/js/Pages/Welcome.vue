<template>
  <div v-if="logos.length > 0">
    <LayoutWelcome :logo="logos[logos.length - 1]">
      <div class="carousel-container">
        <div
          class="carousel"
          :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
        >
          <div
            v-for="(carousel, index) in carrousels"
            :key="index"
            class="carousel-slide"
          >
            <img
              :src="carousel.image_carrousel"
              alt="Carousel Image"
              class="fixed-height-image"
            />
          </div>
        </div>
        <button class="carousel-button prev" @click="prevSlide">Anterior</button>
        <button class="carousel-button next" @click="nextSlide">Siguiente</button>
        <div class="dots-container">
          <span
            v-for="(carousel, index) in carrousels"
            :key="index"
            class="dot"
            :class="{ active: index === currentIndex }"
            @click="goToSlide(index)"
          ></span>
        </div>
      </div>
      <div class="titulo">
        <h1>NOTICIAS</h1>
      </div>
      <div class="column-container">
        <CardNoticiaWelcome
          v-for="prensa in lastFourPrensas"
          :key="prensa.id"
          :prensa="prensa"
        />
      </div>
      <LinkGobierno/>
      <footer>
        <div v-if="footers.length > 0">
          <FooterWelcome :footer="footers[footers.length - 1]" />
        </div>
      </footer>
    </LayoutWelcome>
  </div>
</template>

<script setup>
import LayoutWelcome from "@/Layouts/LayoutWelcome.vue";
import CardNoticiaWelcome from "@/Pages/Welcome/Components/CardNoticiaWelcome.vue";
import { defineProps, ref, onMounted } from "vue";
import FooterWelcome from "@/Pages/Welcome/Components/FooterWelcome.vue";
import LinkGobierno from "@/Pages/Welcome/Components/LinkGobierno.vue";

const { prensas, documentos, carrousels, logos, footers } = defineProps([
  "prensas",
  "documentos",
  "carrousels",
  "logos",
  "footers",
]);

const lastFourPrensas = ref([]);
const lastFourDocumento = ref([]);
const lastFourLogo = ref([]);

//const lastFourCarrousel = ref([]);
onMounted(() => {
  lastFourPrensas.value = [...prensas]
    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    .slice(0, 4);

  lastFourDocumento.value = documentos.slice(0, 4);
  //lastFourCarrousel.value = carrousels.slice(0, 3);
  lastFourLogo.value = logos.slice(0, 4);
});
const currentIndex = ref(0);

const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % carrousels.length;
};

const prevSlide = () => {
  currentIndex.value =
    (currentIndex.value - 1 + carrousels.length) % carrousels.length;
};

const goToSlide = (index) => {
  currentIndex.value = index;
};

onMounted(() => {
  setInterval(() => {
    nextSlide();
  }, 3000);
});
</script>

<style scoped>
.carousel-container {
  position: relative;
  overflow: hidden;
  width: 100%;
}

.carousel {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.carousel-slide {
  flex: 0 0 100%;
  box-sizing: border-box;
}

img {
  width: 100%;
  height: auto;
}

.carousel-button {
  position: absolute;
  top: 50%;
  background: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  z-index: 1;
  border-radius: 10px;
}

.carousel-button:hover {
  background: rgba(197, 87, 87, 0.8);
}

.prev {
  left: 10px;
}

.next {
  right: 10px;
}

.dots-container {
  position: absolute;
  bottom: 10px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 5px;
}

.dot {
  width: 10px;
  height: 10px;
  background-color: #9c2020;
  border-radius: 50%;
  cursor: pointer;
}

.dot.active {
  background-color: #333;
}
.fixed-height-image {
  height: 600px; /* Ajusta el tamaño fijo según tus necesidades */
  max-width: 100%; /* Añade esta línea para que el ancho no exceda del 100% */
  object-fit: cover; /* Añade esta línea para mantener la proporción de la imagen */
}

.column-container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1px;

  @media (max-width: 768px) {
    grid-template-columns: 1fr;
  }
}
.documento-card {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1px;

  @media (max-width: 768px) {
    grid-template-columns: 1fr;
  }
}

.titulo {
  font-size: 20px;
  text-align: center;
}
</style>
