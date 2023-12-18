<template>
  <div v-if="logos.length > 0">
    <LayoutWelcome :logo="logos[logos.length - 1]">
      <h1 class="title">INFORMACION DEL ALCALDE</h1>

      <div class="content-alcalde">
        <div class="imagen">
          <!-- Mostrar la imagen del alcalde más reciente -->
          <img :src="alcaldes.image_alcalde" alt="Imagen del Alcalde" />
          <div class="name-alcalde">
            <h2>{{ alcaldes.name_alcalde }}</h2>
          </div>
        </div>

        <div class="descripcion">
          <p>{{ alcaldes.content_alcalde }}</p>
        </div>
      </div>
      <footer>
        <div v-if="footers.length > 0">
          <FooterWelcome :footer="footers[footers.length - 1]" />
        </div>
      </footer>
    </LayoutWelcome>
  </div>
</template>

<script setup>
import { ref, defineProps } from "vue";
import LayoutWelcome from "@/Layouts/LayoutWelcome.vue";
import FooterWelcome from "@/Pages/Welcome/Components/FooterWelcome.vue";

const { alcaldes, footers, logos } = defineProps([
  "alcaldes",
  "footers",
  "logos",
]);
</script>

<style scoped>
.title {
  font-size: 30px;
  text-align: center;
  background: linear-gradient(
    to right,
    rgba(28, 187, 166, 0.986),
    rgba(185, 185, 185, 0.5)
  );
  padding: 20px;
  margin: 10px 0;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.content-alcalde {
  display: flex;
  justify-content: space-around;
  align-items: center;
  margin: 20px;
  padding: 20px;
  border-radius: 8px;
}

.imagen {
  flex: 1;
  margin-right: 20px;
}

.imagen img {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
}

.name-alcalde {
  text-align: center;
  margin-bottom: 10px;
}

.descripcion {
  flex: 2;
  border-radius: 10px;
}

.descripcion p {
  font-size: 16px;
  line-height: 1.5;
  padding: 10px;
}

/* Media Query para pantallas pequeñas (ejemplo: ancho menor a 600px) */
@media only screen and (max-width: 600px) {
  .content-alcalde {
    flex-direction: column;
    align-items: stretch;
  }

  .imagen {
    margin-right: 0;
    margin-bottom: 10px;
  }
}
</style>
