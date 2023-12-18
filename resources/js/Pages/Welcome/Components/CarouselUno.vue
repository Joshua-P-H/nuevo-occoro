<template>
  <div class="carousel-card">
    <div class="image-container">
      <div class="carousel-inner" ref="carouselInner">
        <img
          v-for="(image, index) in carrousel.images"
          :src="image"
          :key="index"
          alt="Imagen del carrusel"
        />
      </div>
      <button @click="prevImage" class="carousel-button">Anterior</button>
      <button @click="nextImage" class="carousel-button">Siguiente</button>
    </div>
  </div>
</template>
<script setup>
import { defineProps, ref, onMounted } from "vue";

const props = defineProps(["carrousel"]);
const currentIndex = ref(0);
const carouselInner = ref(null);

const prevImage = () => {
  currentIndex.value =
    (currentIndex.value - 1 + props.carrousel.images.length) %
    props.carrousel.images.length;
  updateCarousel();
};

const nextImage = () => {
  currentIndex.value = (currentIndex.value + 1) % props.carrousel.images.length;
  updateCarousel();
};

const updateCarousel = () => {
  if (carouselInner.value) {
    carouselInner.value.style.transform = `translateX(-${
      currentIndex.value * 100
    }%)`;
  }
};

onMounted(() => {
  // Asegurémonos de que las imágenes estén cargadas antes de actualizar el carrusel
  const images = props.carrousel.images.map((image) => new Image());
  Promise.all(
    images.map(
      (image) =>
        new Promise((resolve) => {
          image.onload = resolve;
          image.src = image;
        })
    )
  ).then(() => {
    updateCarousel();
  });
});
</script>

<style scoped>
.image-container {
  position: relative;
  overflow: hidden;
  width: 100%;
}

.carousel-inner {
  display: flex;
  transition: transform 0.5s ease;
}

img {
  width: 100%;
  height: auto;
}

.carousel-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: #3498db;
  color: #fff;
  border: none;
  padding: 10px;
  cursor: pointer;
}

.carousel-button:hover {
  background-color: #2980b9;
}
</style>
