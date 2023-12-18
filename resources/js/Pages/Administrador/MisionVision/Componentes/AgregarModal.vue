<template>
  <div>
    <div class="modal-fondo" @click="closeModal()">
      <div class="modal-content" @click.stop>
        <button class="close-button" @click="closeModal()">
          <i class="fas fa-times"></i>
        </button>
        <h1>Agregar misión y vision</h1>
        <form @submit.prevent="submit" enctype="multipart/form-data">
          <div class="my-3">
            <textarea
              v-model="form.mision"
              id="mision"
              class="rounded-lg w-full p-4 bg-transparent dark:focus:ring-blue-500"
              placeholder="Contenido de la actividad"
            ></textarea>
            <br />
            <span v-if="form.errors.mision" class="text-red-500">{{
              form.errors.mision
            }}</span>
          </div>
          <div class="my-3">
            <textarea
              v-model="form.vision"
              id="vision"
              class="rounded-lg w-full p-4 bg-transparent dark:focus:ring-blue-500"
              placeholder="Contenido de la actividad"
            ></textarea>
            <br />
            <span v-if="form.errors.vision" class="text-red-500">{{
              form.errors.vision
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
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, getCurrentInstance } from "vue";
import { router } from "@inertiajs/vue3";

const form = reactive({
  mision: null,
  vision: null,
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
    formData.append("mision", form.mision);
    formData.append("vision", form.vision);

    router.post("/misionvision/", formData, {
      onSuccess: () => {
        closeModal();
      },
    });
  }
};

const validateForm = () => {
  let isValid = true;
  form.errors = {};

  if (!form.mision) {
    form.errors.mision = "El título de la actividad es obligatorio";
    isValid = false;
    setTimeout(() => {
      form.errors.mision = null;
    }, 3000);
  }

  if (!form.vision) {
    form.errors.vision = "El contenido de la actividad es obligatorio";
    isValid = false;
    setTimeout(() => {
      form.errors.vision = null;
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
