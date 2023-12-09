<template>
  <LayoutWelcome>
    <CarouselUno />
<MisionVision></MisionVision>
    <div class="titulo">
      <h1>DOCUMENTOS</h1>
    </div>
    <div class="documento-card">
    <CardDocumentoWelcome
      v-for="documento in lastFourDocumento"
      :key="documento.id"
      :documento="documento"
    />
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
  </LayoutWelcome>
</template>

<script setup>
import LayoutWelcome from '@/Layouts/LayoutWelcome.vue';
import CardNoticiaWelcome from '@/Pages/Welcome/Components/CardNoticiaWelcome.vue';
import CardDocumentoWelcome from '@/Pages/Welcome/Components/CardDocumentoWelcome.vue';
import MisionVision from '@/Pages/Welcome/Components/MisionVision.vue';

import CarouselUno from '@/Components/Carousel/CarouselUno.vue';
import { defineProps, ref, onMounted } from 'vue';

const { prensas, documentos } = defineProps(['prensas', 'documentos']);

const lastFourPrensas = ref([]);
const lastFourDocumento = ref([]);

onMounted(() => {
  lastFourPrensas.value = [...prensas]
    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    .slice(0, 4);
  
  lastFourDocumento.value = documentos.slice(0, 4);
});
</script>

<style scoped>
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
