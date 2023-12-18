<template>
  <div>
    <h1 class="title">MISIÓN/VISIÓN</h1>
    <div class="mision-vision">
      <div class="mision">
        <h2 class="title-mision">Misión</h2>
        <div class="content-mision">
          <p>
            {{ mision.mision }}
          </p>
        </div>
      </div>
      <div class="vision">
        <h2 class="title-vision">Visión</h2>
        <div class="content-vision">
          <p>
            {{ mision.vision }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
const props = defineProps(["mision"]);

</script>

<style scoped>
h1 {
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
.mision-vision {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 10px;
}

.mision,
.vision {
  width: 100%;
  box-sizing: border-box;
  margin-bottom: 20px;
  border-radius: 20px;
  background: linear-gradient(
    to right,
    rgba(80, 167, 133, 0.5),
    rgba(117, 59, 59, 0.5)
  );

}
.title-mision,
.title-vision{
    text-align: center;
    font-size: 20px;
}

/* Estilos para pantallas medianas y grandes */
@media screen and (min-width: 768px) {
  .mision,
  .vision {
    width: 48%; /* Ancho de cada columna */
  }
}

/* Estilos adicionales para mejorar la apariencia */
.mision,
.vision {
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
</style>
