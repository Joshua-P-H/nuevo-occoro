<script setup>
import LayoutWelcome from "@/Layouts/LayoutWelcome.vue";
</script>

<template>
  <LayoutWelcome>
    <div>
      <h1 class="title">DEMOGRAFIA</h1>
      <div class="organigrama-content">
        <div class="organigrama">
          <div class="image">
            <img
              src="https://edmanventura.files.wordpress.com/2020/08/059_mapa_del_distrito_de_nuevo_occoro.png"
              alt=""
            />
          </div>
          <div class="description">
            <p>El Distrito peruano de Nuevo Occoro es uno de los diecinueve distritos de la Provincia de Huancavelica, ubicada en el Departamento de Huancavelica, bajo la administración del Gobierno Regional de Huancavelica, en la zona de los andes centrales del Perú. Limita por el norte con el Distrito de Laria; por el oeste con los distritos de Manta y Acobambilla; por el este con el Distrito de Huando; y, por el sur con los distritos de Palca y Ascensión.</p>

            <h4>Superficie: 211.56 km²</h4>
            <h4>Altitud: 3825 m s. n. m.</h4>

          </div>
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
  );
  /* Degradado de color */
  padding: 20px;
  margin: 10px 0;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.organigrama-content {
  display: flex;
  justify-content: center;
  align-items: center;
}

.organigrama {
  max-width: 90%;
  display: flex;
  flex-direction: column;
}

.image img {
  width: 100%;
  height: auto;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}

.description {
  padding: 20px;
  border-bottom-left-radius: 8px;
  border-bottom-right-radius: 8px;
}

@media (min-width: 768px) {
  .organigrama {
    flex-direction: row;
  }

  .image img {
    border-top-right-radius: 0;
    border-bottom-left-radius: 8px;
  }

  .description {
    border-top-left-radius: 0;
    border-bottom-right-radius: 8px;
  }
}
</style>
