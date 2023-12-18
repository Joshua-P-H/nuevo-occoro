<template>
    <Dashboard>
      <button
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button"
        @click="openCreateModal"
        style="cursor: pointer; margin-bottom: 10px;"
      >
        Agregar nuevo logo
      </button>
  
      <table class="custom-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="logo in logos" :key="logo.id">
            <td>{{ logo.id }}</td>
            <td>{{ logo.name_logo }}</td>
            <td>
              <img :src="logo.image_logo" alt="Imagen" style="max-width: 100px; max-height: 100px;">
  
            </td>
            <td>
              <select @change="handleOption(logo, $event.target.value)">
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
        :logo="seleccionarDocumento"
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
  import { ref } from "vue";
  import Dashboard from "@/Layouts/LayoutOccoro.vue";
  import AgregarModal from "@/Pages/Administrador/Logo/Componentes/AgregarModal.vue";
  import EditModal from "@/Pages/Administrador/Logo/Componentes/EditModal.vue";
  import DialogModal from "@/Components/DialogModal.vue";
  import { router, Link } from "@inertiajs/vue3";
  
  const showCreateModal = ref(false);
  const showEditModal = ref(false);
  let showDeleteModal = ref(false);
  
  let seleccionarDocumento = ref(null);
  let nombreUsuarioSeleccionado = "";
  
  const { Logos } = defineProps(["logos"]);
  const mostrarPDF = (pdfDocumento) => {
    // Abre el PDF en una nueva ventana o pestaña
    window.open(pdfDocumento, "_blank");
  };
  
  function openCreateModal() {
    showCreateModal.value = true;
  }
  
  function closeCreateModal() {
    showCreateModal.value = false;
  }
  
  function openEditModal(logo) {
    seleccionarDocumento.value = logo;
    showEditModal.value = true;
  }
  function closeEditModal() {
    seleccionarDocumento.value = null;
    showEditModal.value = false;
  }
  //Modal de eliminacion
  const closeDeleteModal = () => {
    showDeleteModal.value = false;
  };
  
  const openDeleteModal = (logo) => {
    seleccionarDocumento.value = logo;
    showDeleteModal.value = true;
    nombreUsuarioSeleccionado = logo.name_logo;
  };
  
  const eliminarDocumento = () => {
    if (
      seleccionarDocumento &&
      seleccionarDocumento.value &&
      seleccionarDocumento.value.id
    ) {
      try {
        const documentoId = seleccionarDocumento.value.id;
        router.delete(`/logos/${documentoId}`);
        closeDeleteModal();
      } catch (error) {
        console.error("Error inesperado:", error);
      }
    }
  };
  function handleOption(logo, option) {
    if (option === "edit") {
      openEditModal(logo);
    } else if (option === "delete") {
      openDeleteModal(logo);
    }
    resetDropdown();
  }
  
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
    background-color: rgb(95, 151, 151);
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
    background-color: #e00909;
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
  