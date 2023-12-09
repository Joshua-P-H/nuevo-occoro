<template>
  <div class="carousel-inicio">
    <div class="slides" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
      <div v-for="(slide, index) in slides" :key="index" class="slide">
        <img :src="slide.url" :alt="slide.alt" class="slide-image" />
      </div>
    </div>
    <button @click="prevSlide" class="blue-icon left">
      <i class="bx bx-chevron-left"></i>
    </button>
    <button @click="nextSlide" class="blue-icon right">
      <i class="bx bx-chevron-right"></i>
    </button>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const slides = ref([
  { url: 'https://portal.munipuno.gob.pe/sites/default/files/Slider-2023/Bnner_2023_0.jpg', alt: 'Descripción 1', height: 600 },
  //{ url: 'https://ggirs.munipuno.gob.pe/sites/default/files/Slider-2021/bannerpunohallpaman.jpg', alt: 'Descripción 2', height: 600 },
  // Agrega más imágenes según sea necesario
]);

const currentIndex = ref(0);
let intervalId = null;

const prevSlide = () => {
  currentIndex.value = currentIndex.value > 0 ? currentIndex.value - 1 : slides.value.length - 1;
};

const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % slides.value.length;
};

// Cambiar automáticamente la imagen cada 4 segundos
onMounted(() => {
  intervalId = setInterval(nextSlide, 4000);
});

onBeforeUnmount(() => {
  clearInterval(intervalId);
});
</script>

<style scoped>
.carousel-inicio {
  position: relative;
  overflow: hidden;
}

.slides {
  display: flex;
  transition: transform 0.5s ease-in-out;
}

.slide {
  flex: 0 0 100%;
}

.slide img {
  width: 100%;
  height: auto;
}

.blue-icon {
  background-color: blue;
  border: none;
  cursor: pointer;
  position: absolute;
  top: 50%;
  font-size: 30px;
  transform: translateY(-50%);
  border-radius: 10px;
}

.left {
  left: 0;
}

.right {
  right: 0;
}
</style>
