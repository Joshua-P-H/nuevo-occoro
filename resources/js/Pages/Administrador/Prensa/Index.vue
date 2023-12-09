<template>
  <Dashboard>
    <h1>TODAS LAS ACTIVIDADES</h1>
    <button
      class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      type="button" @click="openCreateModal" style="cursor: pointer; margin-bottom: 10px;">
      Agregar actividad
    </button>
    <div class="actividad" v-for="prensa in prensas" :key="prensa.id">
      <div class="card">
        <div class="card-content">
          <h1>Titulo: {{ prensa.title_prensa }}</h1>
          <p>Contenido: {{ prensa.content_prensa }}</p>


          <button @click="openEditModal(prensa)" style="background-color: aquamarine;">Editar</button>
          <button @click="openDeleteModal(prensa)" style="background-color: brown;">
            Eliminar
        </button>     
        <Link :href="`/show/${prensa.id}`" class="title">{{ prensa.title_prensa }}</Link>
   
      </div>
      </div>
    </div>
    <AgregarModal v-if="showCreateModal" @close="closeCreateModal" />
    <EditModal v-if="showEditModal" @close="closeEditModal" :prensa="seleccionarActivida" />
    <DialogModal :show="showDeleteModal" class="eliminar" @click="closeDeleteModal">
      <template v-slot:title>
          <h1>Confirmar</h1>
      </template>
      <template v-slot:content>
          <h1>¿Estás seguro de eliminar a {{ nombreUsuarioSeleccionado }}?</h1>

          <div class="my-5"></div>

          <div class="flex justify-between items-end">
              <button class="bg-green-700 px-4 py-2 rounded" @click="eliminarDocumento(seleccionarDocumento)">
                  Eliminar
              </button>
              <button class="bg-gray-500 px-4 py-2 rounded" @click="closeDeleteModal">Cancelar</button>
          </div>
      </template>
  </DialogModal>
  </Dashboard>
</template>

<script setup>
import AgregarModal from '@/Pages/Administrador/Prensa/Componentes/AgregarModal.vue';
import EditModal from '@/Pages/Administrador/Prensa/Componentes/EditModal.vue';
import { ref, defineProps } from 'vue';
import { router, Link } from '@inertiajs/vue3';
import Dashboard from '@/Layouts/LayoutOccoro.vue';
import DialogModal from '@/Components/DialogModal.vue';


let seleccionarActivida = ref(null);
const showEditModal = ref(false);
let showDeleteModal = ref(false);
let nombreUsuarioSeleccionado = '';



const showCreateModal = ref(false);
function openCreateModal() {
    showCreateModal.value = true;
}

function closeCreateModal() {
    showCreateModal.value = false;
}

const { prensas } = defineProps(['prensas']);
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
    if (seleccionarActivida && seleccionarActivida.value && seleccionarActivida.value.id) {
        try {
            const prensaId = seleccionarActivida.value.id;
            router.delete(`/prensas/${prensaId}`)
            closeDeleteModal();
        } catch (error) {
            console.error('Error inesperado:', error);
        }
    }
};
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

.eliminar{
  z-index: 9999;

}
</style>
