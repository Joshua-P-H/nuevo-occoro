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
              v-model="alcalde.name_alcalde"
              type="text"
              id="name_alcalde"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent border-b-2 border-blue-500 outline-none"
            />
          </div>
          <textarea
            v-model="alcalde.content_alcalde"
            id="content_alcalde"
            type="text"
            class="rounded-lg w-full p-4 bg-transparent dark:focus:ring-blue-500"
          ></textarea>

          <div class="my-3">
            <input
              type="file"
              id="image_alcalde"
              accept="image/*"
              @change="onFileChange"
              @input="alcalde.image_alcalde = $event.target.files[0]"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500"
            />
          </div>
          <div class="form-group my-3">
            <button
              :disabled="alcalde.processing"
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
import { router } from "@inertiajs/vue3";

const props = defineProps({
  alcalde: {
    type: Object,
    required: true,
  },
});

const alcalde = reactive(props.alcalde);
const { emit } = getCurrentInstance();

async function submit() {
  try {
    const formData = new FormData();
    formData.append("_method", "put");
    formData.append("name_alcalde", alcalde.name_alcalde);
    formData.append("content_alcalde", alcalde.content_alcalde);

    // Verificar si se ha seleccionado un nuevo archivo de imagen
    if (alcalde.image_alcalde) {
      formData.append("image_alcalde", alcalde.image_alcalde);
    }

    await router.post("/alcalde/" + alcalde.id, formData, {
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
  alcalde.image_alcalde =
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
