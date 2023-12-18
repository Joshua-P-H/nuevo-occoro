<script setup>
import LayoutWelcome from "@/Layouts/LayoutWelcome.vue";
import FooterWelcome from "@/Pages/Welcome/Components/FooterWelcome.vue";

const { logos, footers } = defineProps(["logos", "footers"]);
const organigrama = "/imagenes/organigrama.jpg";
</script>

<template>
  <div v-if="logos.length > 0">
    <LayoutWelcome :logo="logos[logos.length - 1]">
      <div>
        <h1 class="title">ORGANIGRAMA</h1>
        <div class="organigrama-content">
          <div class="organigrama">
            <div class="link-uno">
              <img :src="organigrama  " alt="MINDIS" />
            </div>
          </div>
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

<style scoped>
.title {
  font-size: 30px;
  text-align: center;
  background: linear-gradient(
    to right,
    rgba(28, 187, 166, 0.986),
    rgba(185, 185, 185, 0.5)
  ); /* Degradado de color */
  padding: 20px;
  margin: 10px 0;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.organigrama-content {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 5px;
}

.organigrama {
  max-width: 90%;
  border-radius: 20px;
  overflow: hidden;
}

img {
  width: 100%;
  height: auto;
  display: block;
  margin: 0 auto; /* Centrar horizontalmente */
  border-radius: 20px;
}
</style>
