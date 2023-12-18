<template>
  <Dashboard>
    <h1>Todas las actividades</h1>
    <button
      class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      type="button"
      @click="openCreateModal"
      style="cursor: pointer; margin-bottom: 10px;"
    >
      Agregar actividad
    </button>
    <table class="custom-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titulo</th>
          <th>Contenido</th>
          <th>Imagen</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="prensa in prensas" :key="prensa.id">
          <td>{{ prensa.id }}</td>
          <td>{{ prensa.title_prensa }}</td>
          <td>{{ prensa.content_prensa }}</td>

          <td>
            <img
              :src="prensa.image_prensa"
              alt="Imagen"
              style="max-width: 100px; max-height: 100px;"
            />
          </td>
          <td>
            <select @change="handleOption(prensa, $event.target.value)">
              <option disabled selected>Selecionar</option>
              <option value="edit">Editar</option>
              <option value="delete">Eliminar</option>
            </select>
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
      :prensa="seleccionarActivida"
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
import AgregarModal from "@/Pages/Administrador/Prensa/Componentes/AgregarModal.vue";
import EditModal from "@/Pages/Administrador/Prensa/Componentes/EditModal.vue";
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

const { prensas } = defineProps(["prensas"]);
function openEditModal(prensa) {
  seleccionarActivida.value = prensa;
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

const openDeleteModal = (prensa) => {
  seleccionarActivida.value = prensa;
  showDeleteModal.value = true;
  nombreUsuarioSeleccionado = prensa.title_prensa;
};

const eliminarDocumento = () => {
  if (
    seleccionarActivida &&
    seleccionarActivida.value &&
    seleccionarActivida.value.id
  ) {
    try {
      const prensaId = seleccionarActivida.value.id;
      router.delete(`/prensas/${prensaId}`);
      closeDeleteModal();
    } catch (error) {
      console.error("Error inesperado:", error);
    }
  }
};
function handleOption(prensa, option) {
  if (option === "edit") {
    openEditModal(prensa);
  } else if (option === "delete") {
    openDeleteModal(prensa);
  }
  resetDropdown();
};
function resetDropdown() {
  // Utilizando el evento que llama esta función para encontrar el elemento select específico
  const selectElement = event.target.closest("tr").querySelector("select");

  // Restablecer el valor del menú desplegable a "Seleccionar"
  if (selectElement) {
    selectElement.value = selectElement.firstElementChild.value;
  }
}
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
</style>
