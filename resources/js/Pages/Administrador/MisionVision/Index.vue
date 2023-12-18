<template>
  <Dashboard>
    <h1>Todas las actividades</h1>
    <div class="grid grid-cols-2 gap-4">
      <!-- Columna izquierda: Botón y Mensaje -->
      <div class="content-botones">
        <button
          type="button"
          class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
          @click="openCreateModal"
          :disabled="misiones.length > 0"
        >
          Agregar actividad
        </button>

        <div v-if="misiones.length > 0" class="alert-message">
          <p>Ya tienes una misión y visión. Solo puedes editar.</p>
        </div>
      </div>
    </div>

    <table class="custom-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Misión</th>
          <th>Visión</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in misiones" :key="item.id">
          <td>{{ item.id }}</td>
          <td>{{ item.mision }}</td>
          <td>{{ item.vision }}</td>
          <td>
            <button @click="openEditModal(item)">Editar</button>
          </td>
          <!--<td>        <button @click="openEditModal(documento)">Editar</button>
                      </td>-->
        </tr>
      </tbody>
    </table>
    <AgregarModal v-if="showCreateModal" @close="closeCreateModal" />
    <EditModal
      v-if="showEditModal"
      @close="closeEditModal"
      :item="seleccionarActivida"
    />
  </Dashboard>
</template>

<script setup>
import AgregarModal from "@/Pages/Administrador/MisionVision/Componentes/AgregarModal.vue";
import EditModal from "@/Pages/Administrador/MisionVision/Componentes/EditModal.vue";
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

const { misiones } = defineProps(["misiones"]);
function openEditModal(item) {
  seleccionarActivida.value = item;
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
</script>

<style scoped>
.custom-table {
  width: 100%;
  border-collapse: collapse;
}

.custom-table th,
.custom-table td {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: center;
}

.custom-table th {
  background-color: rgb(9, 185, 185);
  color: black;
  font-weight: bold;
}

.custom-table {
  overflow: hidden;

  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  border-bottom-left-radius: 8px;
  border-bottom-right-radius: 8px;
  overflow: hidden;
}

.eliminar {
  /* Add styles for the modal container here */
  /* For example: */
  border-radius: 5px;
  padding: 2px;
}

.eliminar {
  z-index: 9999;
  /* Elige un valor más alto que el resto de tus elementos */
}

select {
  padding: 8px;
  border: none;
  border-radius: 4px;
  background-color: #09a3e0;
  color: #fff;
  appearance: none;
  /* Quita el estilo nativo del sistema */
  cursor: pointer;
}

select option[disabled] {
  display: none;
}

select option {
  padding: 80px;
  /* Ajusta el relleno */
  margin: 20px 20px;
  /* Ajusta los márgenes */
  background-color: #fff;
  color: #333;
  width: 200px;
}

select option[value="edit"] {
  margin-top: 15px;
  /* Agrega más margen arriba para 'Editar' */
}

select option:hover {
  background-color: #c91111;
}

.alert-message {
  background-color: #ffdddd;
  color: #ff0000;
  padding: 15px;
  margin: 10px 0;
  border-radius: 5px;
}

/* Estilos para las columnas */
.content-botones {
  grid-column: 1 / span 1;
}

.content-mensaje {
  grid-column: 2 / span 1;
}
</style>
