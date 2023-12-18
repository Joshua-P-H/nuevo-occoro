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
              v-model="footer.gestion_footer"
              type="text"
              id="gestion_footer"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent border-b-2 border-blue-500 outline-none"
            />
          </div>
          <div class="my-3">
            <input
              v-model="footer.copy_footer"
              type="text"
              id="copy_footer"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              placeholder="Nombre del logo"
            />
          </div>

          <div class="my-3">
            <input
              type="file"
              id="image_footer"
              accept="image/*"
              @change="onFileChange"
              @input="footer.image_footer = $event.target.files[0]"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500"
            />
          </div>
          <div class="my-3">
            <input
              v-model="footer.telefono_footer"
              type="text"
              id="telefono_footer"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              placeholder="Nombre del logo"
            />
          </div>
          <div class="my-3">
            <input
              v-model="footer.link_footer"
              type="text"
              id="link_footer"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              placeholder="Nombre del logo"
            />
          </div>
          <div class="form-group my-3">
            <button
              :disabled="footer.processing"
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
  footer: {
    type: Object,
    required: true,
  },
});

const footer = reactive(props.footer);
const { emit } = getCurrentInstance();

async function submit() {
  try {
    const formData = new FormData();
    formData.append("_method", "put");
    formData.append("gestion_footer", footer.gestion_footer);
    formData.append("copy_footer", footer.copy_footer);
    formData.append("telefono_footer", footer.telefono_footer);
    formData.append("link_footer", footer.link_footer)
    // Verificar si se ha seleccionado un nuevo archivo de imagen
    if (footer.image_footer) {
      formData.append("image_footer", footer.image_footer);
    }

    await router.post("/footers/" + footer.id, formData, {
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
  footer.image_footer =
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
