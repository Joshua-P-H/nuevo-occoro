<template>
  <div>
    <div class="modal-fondo" @click="closeModal()">
      <div class="modal-content" @click.stop>
        <button class="close-button" @click="closeModal()">
          <i class="fas fa-times"></i>
        </button>
        <h1>AGREGAR CONVOCATORIA</h1>
        <form @submit.prevent="submit" enctype="multipart/form-data">
          <div class="my-3">
            <label for="content_convocatoria"
              >Contenido de la convocatoria:</label
            >
            <input
              v-model="form.content_convocatoria"
              type="text"
              id="content_convocatoria"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500"
              placeholder="Agregue una descripscion"
            />
          </div>

          <div class="my-3">
            <label for="convocatoria_fecha_id">Seleccionar convocatoria:</label>
            <select
              v-model="selectedConvocatoria"
              id="convocatoria_fecha_id"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500"
            >
              <option value="" selected disabled>Seleccione el tititulo</option>
              <option
                v-for="convocatoria in convocatoriasfechas"
                :key="convocatoria.id"
                :value="convocatoria.id"
              >
                {{ convocatoria.title_convocatoria }}
              </option>
            </select>
          </div>
          <div class="form-group my-3">
            <button
              :disabled="form.processing"
              type="submit"
              class="bg-green-700 text-white px-4 py-2 rounded"
            >
              Guardar
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, getCurrentInstance, ref } from "vue";
import { router } from "@inertiajs/vue3";

const { convocatoriasfechas } = defineProps(["convocatoriasfechas"]);

// Establece selectedConvocatoria con el valor de la opción "Select a title"
const selectedConvocatoria = ref("");

const form = reactive({
  content_convocatoria: "",
  errors: {},
  processing: false,
});

const { emit } = getCurrentInstance();

const closeModal = () => {
  emit("close");
};

const submit = async () => {
  form.processing = true;

  const formData = new FormData();
  formData.append("content_convocatoria", form.content_convocatoria);
  formData.append("convocatoria_fecha_id", selectedConvocatoria.value);

  try {
    await router.post("/convocatorias/", formData);
    form.content_convocatoria = "";
    selectedConvocatoria.value = ""; // Restablece el valor después de enviar el formulario
    closeModal();
  } catch (error) {
    console.error("Error al enviar el formulario:", error);
  } finally {
    form.processing = false;
  }
};
</script>

<style scoped>
.error-dialogue {
  position: fixed;
  top: 10%;
  right: 5%;
  transform: translateY(-50%);
  padding: 10px;
  background-color: red;
  color: white;
  border-radius: 5px;
}

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
