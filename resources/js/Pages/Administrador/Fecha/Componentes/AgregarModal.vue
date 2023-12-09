<template>
  <div>
    <div class="modal-fondo" @click="closeModal()">
      <div class="modal-content" @click.stop>
        <button class="close-button" @click="closeModal()">
          <i class="fas fa-times"></i>
        </button>
        <h1>AGREGAR FECHA</h1>
        <form @submit.prevent="submit" enctype="multipart/form-data">
          <div class="my-3">
            <label
              for="title_convocatoria"
              class="block text-sm font-medium text-gray-700"
              >Título de la convocatoria</label
            >
            <input
              v-model="form.title_convocatoria"
              type="text"
              id="title_convocatoria"
              name="title_convocatoria"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              placeholder="Título de la convocatoria"
            />
            <span v-if="form.errors.title_convocatoria" class="text-red-500">{{
              form.errors.title_convocatoria
            }}</span>
          </div>

          <div class="my-3">
            <label
              for="fecha_limite"
              class="block text-sm font-medium text-gray-700"
              >Fecha límite</label
            >
            <input
              v-model="form.fecha_limite"
              type="date"
              id="fecha_limite"
              name="fecha_limite"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
            />
            <span v-if="form.errors.fecha_limite" class="text-red-500">{{
              form.errors.fecha_limite
            }}</span>
          </div>

          <div class="my-3">
            <label
              for="fecha_fin"
              class="block text-sm font-medium text-gray-700"
              >Fecha de finalización</label
            >
            <input
              v-model="form.fecha_fin"
              type="date"
              id="fecha_fin"
              name="fecha_fin"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
            />
            <span v-if="form.errors.fecha_fin" class="text-red-500">{{
              form.errors.fecha_fin
            }}</span>
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

        <div v-if="form.errors.title_prensa" class="error-dialogue">
          {{ form.errors.title_prensa }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, getCurrentInstance } from "vue";
import { router } from "@inertiajs/vue3";

const form = reactive({
  title_convocatoria: "", // Nuevo campo
  activo: true, // Nuevo campo
  fecha_limite: "", // Nuevo campo
  fecha_fin: "", // Nuevo campo
  errors: {},
  processing: false,
});

const { emit } = getCurrentInstance();

const closeModal = () => {
  emit("close");
};

const submit = () => {
  if (validateForm()) {
  const formData = new FormData();
  formData.append("title_convocatoria", form.title_convocatoria); // Nuevo campo
  formData.append("activo", form.activo); // Nuevo campo
  formData.append("fecha_limite", form.fecha_limite); // Nuevo campo
  formData.append("fecha_fin", form.fecha_fin); // Nuevo campo
  router.post("/fechas/", formData, {
    onSuccess: () => {
      closeModal();
    },
  });
}
};

const validateForm = () => {
  let isValid = true;
  form.errors = {};

  if (!form.title_convocatoria) {
    form.errors.title_convocatoria = "Te falta el titulo de la convocatoria";
    isValid = false;
    setTimeout(() => {
      form.errors.title_convocatoria = null;
    }, 3000);
  }

  if (!form.fecha_limite) {
    form.errors.fecha_limite = "Te falta la fecha de limite";
    isValid = false;
    setTimeout(() => {
      form.errors.fecha_limite = null;
    }, 3000);
  }

  if (!form.fecha_fin) {
    form.errors.fecha_fin = "Te falta la fecha final";
    isValid = false;
    setTimeout(() => {
      form.errors.fecha_fin = null;
    }, 3000);
  }

  return isValid;
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
