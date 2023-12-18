<template>
  <Dashboard>
    <h1>TODAS LA CONVOCATORIAS</h1>
    <button
      type="button"
      @click="openCreateModal"
      style="cursor: pointer; margin-bottom: 10px;"
    >
      Agregar Convocatoria
    </button>
    <div
      class="actividad"
      v-for="(convocatoriaGroup, title) in convocatorias"
      :key="title"
    >
      <div class="card" v-for="convocatoria in convocatoriaGroup" :key="convocatoria.id">
        <div class="card-content">
          <h1>Titulo: {{ title }}</h1>
          <div class="column">
            <p>Descripción: {{ convocatoria.content_convocatoria }}</p>
          </div>
          <button
            @click="openEditModal(convocatoria)"
          >
            Editar
          </button>
        </div>
      </div>
    </div>
    <AgregarModal
      :convocatoriasfechas="convocatoriasfechas"
      v-if="showCreateModal"
      @close="closeCreateModal"
    />

    <EditModal
      v-if="showEditModal"
      @close="closeEditModal"
      :convocatoria="seleccionarActivida"
    />
    <h3>En proceso de implementación</h3>
  </Dashboard>
</template>

<script setup>
import AgregarModal from "@/Pages/Administrador/Convocatoria/Componentes/AgregarModal.vue";
import EditModal from "@/Pages/Administrador/Convocatoria/Componentes/EditModal.vue";
import { ref, defineProps } from "vue";
import Dashboard from "@/Layouts/LayoutOccoro.vue";

let seleccionarActivida = ref(null);
const showEditModal = ref(false);

const showCreateModal = ref(false);
function openCreateModal(months) {
  showCreateModal.value = true;
}

function closeCreateModal() {
  showCreateModal.value = false;
}

const { convocatorias, convocatoriasfechas } = defineProps([
  "convocatorias",
  "convocatoriasfechas",
]);


function openEditModal(convocatoria) {
  // Clonar la convocatoria para evitar modificar la original directamente
  seleccionarActivida.value = { ...convocatoria };
  showEditModal.value = true;
}


function closeEditModal() {
  seleccionarActivida.value = null;
  showEditModal.value = false;
}

</script>



