<template>
  <Dashboard>
    <h1>TODAS LAS ACTIVIDADES</h1>
    <button
      class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      type="button"
      @click="openCreateModal"
      style="cursor: pointer; margin-bottom: 10px;"
    >
      Agregar actividad
    </button>
    <div
      class="actividad"
      v-for="convocatoriasFecha in convocatoriasFechas"
      :key="convocatoriasFecha.id"
    >
      <div class="card">
        <div class="card-content">
          <h1>Titulo: {{ convocatoriasFecha.title_convocatoria }}</h1>
          <p>
            Estado:
            <span
              :style="{
                color: convocatoriasFecha.activo === 1 ? 'green' : 'red',
              }"
            >
              {{ convocatoriasFecha.activo === 1 ? "Activo" : "Inactivo" }}
            </span>
          </p>
          <div class="column date">
            Publicación: {{ formatDate(convocatoriasFecha.created_at) }}
          </div>
          <div class="column date">
            Fecha limite: {{(convocatoriasFecha.fecha_limite) }}
          </div>
          <div class="column date">
            fecha de finalización:
            {{ (convocatoriasFecha.fecha_fin) }}
          </div>

          <button
            @click="openEditModal(convocatoriasFecha)"
            style="background-color: aquamarine;"
          >
            Editar
          </button>
          <button
            @click="openDeleteModal(convocatoriasFecha)"
            style="background-color: brown;"
          >
            Eliminar
          </button>
          <Link :href="`/show/${convocatoriasFecha.id}`" class="title">{{
            convocatoriasFecha.title_prensa
          }}</Link>
        </div>
      </div>
    </div>
   <!--<div>
      <label for="selectMonths">Seleccionar mes:</label>
      <select v-model="selectedMonth" id="selectMonths">
        <option v-for="month in uniqueMonths" :key="month" :value="month">
          {{ month }}
        </option>
      </select>
    </div>-->
    <!-- ... (resto de tu plantilla) ... -->

    <AgregarModal v-if="showCreateModal" @close="closeCreateModal" />
    <EditModal
      v-if="showEditModal"
      @close="closeEditModal"
      :convocatoriasFecha="seleccionarActivida"
    />
    <DialogModal
      :show="showDeleteModal"
      class="eliminar"
      @click="closeDeleteModal"
    >
      <template v-slot:title>
        <h1>Confirmar</h1>
      </template>
      <template v-slot:content>
        <h1>¿Estás seguro de eliminar a {{ nombreUsuarioSeleccionado }}?</h1>

        <div class="my-5"></div>

        <div class="flex justify-between items-end">
          <button
            class="bg-green-700 px-4 py-2 rounded"
            @click="eliminarDocumento(seleccionarDocumento)"
          >
            Eliminar
          </button>
          <button
            class="bg-gray-500 px-4 py-2 rounded"
            @click="closeDeleteModal"
          >
            Cancelar
          </button>
        </div>
      </template>
    </DialogModal>
  </Dashboard>
</template>

<script setup>
import AgregarModal from "@/Pages/Administrador/Fecha/Componentes/AgregarModal.vue";
import EditModal from "@/Pages/Administrador/Fecha/Componentes/EditModal.vue";
import { ref, defineProps } from "vue";
import { router, Link } from "@inertiajs/vue3";
import Dashboard from "@/Layouts/LayoutOccoro.vue";
import DialogModal from "@/Components/DialogModal.vue";

let seleccionarActivida = ref(null);
const showEditModal = ref(false);
let showDeleteModal = ref(false);
let nombreUsuarioSeleccionado = "";

const showCreateModal = ref(false);
function openCreateModal() {
  showCreateModal.value = true;
}

function closeCreateModal() {
  showCreateModal.value = false;
}

const { convocatoriasFechas } = defineProps(["convocatoriasFechas"]);
function openEditModal(convocatoriasFecha) {
  seleccionarActivida.value = convocatoriasFecha;
  showEditModal.value = true;
}

function closeEditModal() {
  seleccionarActivida.value = null;
  showEditModal.value = false;
}
//eliminar
const closeDeleteModal = () => {
  showDeleteModal.value = false;
};

const openDeleteModal = (convocatoriasFecha) => {
  seleccionarActivida.value = convocatoriasFecha;
  showDeleteModal.value = true;
  nombreUsuarioSeleccionado = convocatoriasFecha.title_convocatoria;
};

const eliminarDocumento = () => {
  if (
    seleccionarActivida &&
    seleccionarActivida.value &&
    seleccionarActivida.value.id
  ) {
    try {
      const prensaId = seleccionarActivida.value.id;
      router.delete(`/fechas/${prensaId}`);
      closeDeleteModal();
    } catch (error) {
      console.error("Error inesperado:", error);
    }
  }
};
/*const formatDate = (date) => {
  const options = { weekday: 'long' };
  return new Date(date).toLocaleDateString("es-ES", options);
};*/
const formatDate = (date) => {
  const formattedDate = new Date(date).toLocaleDateString("es-ES", {
    year: "numeric",
    month: "long",
    day: "2-digit",
  });
  return formattedDate.replace(/^(\d)$/, "0$1");
};
const uniqueMonths = Array.from(
  new Set(
    convocatoriasFechas.map((item) =>
      new Date(item.created_at).toLocaleDateString("es-ES", { month: "long" })
    )
  )
);
</script>

<style scoped>
.actividad {
  display: flex;
  flex-wrap: wrap;
}

.card {
  width: 100%;
  border: 1px solid #ddd;
  margin: 10px;
  padding: 10px;
  border-radius: 5px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-content {
  margin-bottom: 10px;
}

.eliminar {
  z-index: 9999;
}
</style>
