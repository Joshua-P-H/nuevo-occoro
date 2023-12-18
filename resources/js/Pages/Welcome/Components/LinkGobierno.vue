<template>
    <div class="content">
      <div class="link-uno">
        <a href="https://www.gob.pe/inei/" target="_blank">
          <img :src="inei" alt="INEI" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://www.regionhuancavelica.gob.pe/" target="_blank">
          <img :src="hvca" alt="Huancavelica" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://infobras.contraloria.gob.pe/infobrasweb" target="_blank">
          <img :src="obras" alt="Contraloría" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://serviciosportal.reniec.gob.pe/cetdnipi/inicio.htm" target="_blank">
          <img :src="reniec" alt="Reniec" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://www.defensoria.gob.pe/" target="_blank">
          <img :src="defensoria" alt="Defensoría" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://serviciosenlinea.contraloria.gob.pe/" target="_blank">
          <img :src="contraloria" alt="Contraloría" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://www.gob.pe/osce" target="_blank">
          <img :src="osce" alt="OSCE" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://www.gob.pe/sis" target="_blank">
          <img :src="sis" alt="SIS" />
        </a>
      </div>
      <div class="link-uno">
        <a href="http://www.sisfoh.gob.pe/" target="_blank">
          <img :src="sisfoh" alt="SISFOH" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://www.gob.pe/mef" target="_blank">
          <img :src="mef" alt="MEF" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://www.gob.pe/servir" target="_blank">
          <img :src="servir" alt="MEF" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://www.gob.pe/institucion/regionhuancavelica/noticias/511149-coer-huancavelica-recomienda-abrigo-para-evitar-complicaciones-en-la-salud" target="_blank">
          <img :src="coer" alt="MEF" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://www.gob.pe/indeci" target="_blank">
          <img :src="indeci" alt="INDECI" />
        </a>
      </div>
      <div class="link-uno">
        <a href="https://www.gob.pe/midis" target="_blank">
          <img :src="mindis" alt="MINDIS" />
        </a>
      </div>
    </div>
  </template>
<script setup>
import { ref } from "vue";

const hvca = "/imagenes/hvca.png";
const contraloria = "/imagenes/contraloria.png";
const defensoria = "/imagenes/defensoria.png";
const inei = "/imagenes/inei.png";
const obras = "/imagenes/obras.png";
const osce = "/imagenes/osce.png";
const reniec = "/imagenes/reniec.png";
const sis = "/imagenes/sis.png";
const sisfoh = "/imagenes/sisfoh.png";
const mef="/imagenes/mef.png"
const servir="/imagenes/servir.png"
const coer="/imagenes/coer.png"
const indeci="/imagenes/indeci.png"
const mindis="/imagenes/mindis.png"



</script>
<style scoped>
.content {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  align-items: center;
  padding: 20px;
}

.link-uno {
  text-align: center;
  padding: 10px;
  border-radius: 8px;
  width: 45%;
  margin-bottom: 20px;
}

.link-uno img {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
}

@media (min-width: 768px) {
  .link-uno {
    width: 23%;
  }
}
</style>
