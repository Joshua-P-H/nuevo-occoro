<template>
  <div class="content-footer">
    <div class="logo-footer">
      <div class="logo">
        <img :src="footer.image_footer" alt="" width="100%" :style="{ maxWidth: '160px' }">
        <p>{{footer.gestion_footer}}</p>
      </div>
      <div class="iconos">
        <a href="#" class="icon-link"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="icon-link"><i class="bx bxl-youtube"></i></a>
      </div>
    </div>
    <div class="enlaces">
      <h1 class="">Enlaces directos</h1>
      <li><a href="#">Mesa de partes</a></li>
      <li><a href="#">RENIEC</a></li>
    </div>
    <div class="contactanos">
      <h1 class="">Horario de atención</h1>
      <h4>Lunes a Viernes</h4>
      <p>Mañanas: 08:00 a.m - 1:00 p.m</p>
      <p>Tardes: 2:30 a.m - 5:30 p.m</p>

    </div>
    
    <div class="contactanos">
      <h1 class="">Contactanos</h1>

      <li><a :href="'tel:'+footer.telefono_footer">{{'Llamar: '+footer.telefono_footer}}</a></li>
    </div>
  </div>

  <div class="contenido-adicional">{{'©'+footer.copy_footer}}</div>
</template>
<script setup>
const props = defineProps(['footer']);

</script>
<style scoped>
.content-footer {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  background-color: rgb(39, 37, 37);
  color: #ffffff;
}
  .logo img {
    width: 100%; /* Establece el ancho de la imagen al 100% del contenedor (.logo) */
    max-width: 200px; /* Establece el ancho máximo para la imagen */
    height: auto; /* Permite que la altura se ajuste automáticamente según el ancho */
    display: block; /* Elimina el espacio adicional debajo de la imagen */
    border-radius: 20px;
  }

.iconos {
  display: flex;
  gap: 10px;
  margin-top: 20px;
}

.iconos a i {
  transition: transform 0.3s, color 0.3s, font-size 0.3s;
}

.iconos a:hover i {
  transform: scale(1.2);
}

.iconos a i.bxl-facebook {
  color: #1877f2;
  font-size: 34px;
}

.iconos a i.bxl-youtube {
  color: #ff0000;
  font-size: 34px;
}

.enlaces li {
  margin-bottom: 8px;
  list-style-type: none;
}

.enlaces a {
  color: #ffffff;
  text-decoration: none;
  transition: color 0.3s;
}

.enlaces a:hover {
  color: #007bff;
}
h1 {
  font-size: 30px;
  text-align: center;
}

.contactanos li {
  margin-bottom: 8px;
  list-style-type: none;
}

.contactanos a {
  color: #ffffff;
  text-decoration: none;
  transition: color 0.3s;
}

.contactanos a:hover {
  color: #007bff;
}

.contenido-adicional {
  background-color: black;
  color: #ffffff;
}

@media (max-width: 768px) {
  .content-footer {
    flex-direction: column;
  }
}
</style>
