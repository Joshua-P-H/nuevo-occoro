<template>
  <div>
    <div class="modal-fondo" @click="closeModal()">
      <div class="modal-content" @click.stop>
        <button class="close-button" @click="closeModal()">
          <i class="fas fa-times"></i>
        </button>
        <h1>Editar lista</h1>
        <form @submit.prevent="submit" enctype="multipart/form-data">
          <div class="my-3">
            <input
              v-model="documento.name_documento"
              type="text"
              id="name_documento"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500"
            />
          </div>
          <div class="my-3">
            <input
              type="file"
              id="image_documento"
              accept="image/*"
              @change="onFileChange"
              @input="documento.image_documento = $event.target.files[0]"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500"
            />
          </div>
          <div class="my-3">
            <input
              type="file"
              id="pdf_documento"
              accept=".pdf"
              @change="onPdfChange"
              @input="documento.pdf_documento = $event.target.files[0]"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500"
            />
          </div>
          <div class="form-group my-3">
            <button
              :disabled="documento.processing"
              type="submit"
              class="bg-green-700 text-white px-4 py-2 rounded"
            >
              Guardar cambios
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, getCurrentInstance } from "vue";
import { defineProps } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  documento: {
    type: Object,
    required: true,
  },
});

const documento = reactive(props.documento);
const { emit } = getCurrentInstance();

async function submit() {
  try {
    const formData = new FormData();
    formData.append("_method", "put");
    formData.append("name_documento", documento.name_documento);

    // Verificar si se ha seleccionado un nuevo archivo de imagen
    if (documento.image_documento) {
      formData.append("image_documento", documento.image_documento);
    }

    // Verificar si se ha seleccionado un nuevo archivo PDF
    if (documento.pdf_documento) {
      formData.append("pdf_documento", documento.pdf_documento);
    }

    await router.post("/documentos/" + documento.id, formData, {
      onSuccess: () => {
        closeModal();
      },
    });
    // Acciones después de una actualización exitosa, si es necesario
  } catch (error) {
    // Manejar errores de actualización, si es necesario
  }
}

function closeModal() {
  emit("close");
}

function onFileChange(event) {
  // Verificar si se seleccionó un nuevo archivo
  documento.image_documento =
    event.target.files.length > 0 ? event.target.files[0] : null;
}

function onPdfChange(event) {
  // Verificar si se seleccionó un nuevo archivo PDF
  documento.pdf_documento =
    event.target.files.length > 0 ? event.target.files[0] : null;
}
</script>

  
  






<style scoped>
/* Estilos generales para el modal */
.modal-fondo {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    transition: opacity 0.2s;
}

/* Estilos generales para el contenido del modal */
.modal-content {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    text-align: center;
    max-height: 80%;
    overflow-y: auto;
    position: relative;
    /* Asegura que los elementos dentro del modal-content sean posicionados relativamente */
}

/* Estilos generales para el botón "close" */
.close-button {
    position: fixed;
    top: 10px;
    /* Posición fija en la parte superior */
    right: 10px;
    /* Posición fija en la parte derecha */
    background: none;
    border: none;
    cursor: pointer;
    font-size: 24px;
    color: #e40d0d;
}
</style>


