<script setup>
import LayoutWelcome from "@/Layouts/LayoutWelcome.vue";
</script>

<template>
  <LayoutWelcome>
    <div>
      <h1 class="title">RESEÑA HISTORIA</h1>
      <div class="organigrama-content">
        <div class="organigrama">
          <div class="description">
            <p>
              Nuevo Occoro es un distrito de la ciudad de Huancavelica que fue
              fundada el 4 de agosto de 1570 por el virrey Francisco de Toledo,
              recibió el nombre de Villarrica de Oropesa. Nuevo Occoro,
              antiguamente pertenecía al distrito de Conayca al igual que Laria
              y otros centros poblados vecinos. La comunidad madre de Occoro
              Viejo, era anexo del distrito de Conayca.
            </p>
            <p>
                El distrito fue creado mediante Ley N° 12312 del 10 de mayo de 1955, en el gobierno del Presidente Manuel A. Odría.
            </p>
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
