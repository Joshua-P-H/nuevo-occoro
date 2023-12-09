<script setup>
import LayoutWelcome from "@/Layouts/LayoutWelcome.vue";
</script>

<template>
  <LayoutWelcome>
    <div>
      <h1 class="title">ORGANIGRAMA</h1>
      <div class="organigrama-content">
        <div class="organigrama">
          <img
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/1200px-Image_created_with_a_mobile_phone.png"
            alt=""
          />
        </div>
      </div>
    </div>
  </LayoutWelcome>
</template>

<style scoped>
.title {
    font-size: 30px;
    text-align: center;
    background: linear-gradient(
      to right,
      rgba(128, 120, 120, 0.5),
      rgba(117, 59, 59, 0.5)
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
