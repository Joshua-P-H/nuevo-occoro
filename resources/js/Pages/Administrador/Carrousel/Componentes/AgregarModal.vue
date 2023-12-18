<template>
  <div>
    <div class="modal-fondo" @click="closeModal()">
      <div class="modal-content" @click.stop>
        <button class="close-button" @click="closeModal()">
          <i class="fas fa-times"></i>
        </button>
        <h1>Agregar imagen al carrousel</h1>
        <form @submit.prevent="submit" enctype="multipart/form-data">
          <div class="my-3">
            <input
              v-model="form.name_carrousel"
              type="text"
              id="name_carrousel"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              placeholder="Nombre de la imagen"
            />
            <span v-if="form.errors.name_carrousel" class="text-red-500">{{
              form.errors.name_carrousel
            }}</span>
          </div>
          <div class="my-3">
            <input
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              type="file"
              @change="handleImageUpload"
              id="image_carrousel"
              accept="image/*"
            />
            <span v-if="form.errors.image_carrousel" class="text-red-500">{{
              form.errors.image_carrousel
            }}</span>
          </div>
          <div class="form-group my-3">
            <button
              :disabled="form.processing"
              type="submit"
              class="bg-green-700 text-white px-4 py-2 rounded"
            >
              Guardar datos
            </button>
          </div>
        </form>

        <!--<div v-if="form.errors.image_carrousel" class="error-dialogue">
          {{ form.errors.image_carrousel }}
        </div>-->
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, getCurrentInstance } from "vue";
import { router } from "@inertiajs/vue3";

const form = reactive({
  name_carrousel: null,
  image_carrousel: null,
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
    formData.append("name_carrousel", form.name_carrousel);
    formData.append("image_carrousel", form.image_carrousel);

    router.post("/carrousel/", formData, {
      onSuccess: () => {
        closeModal();
      },
    });
  }
};

const validateForm = () => {
  let isValid = true;
  form.errors = {};

  if (!form.name_carrousel) {
    form.errors.name_carrousel = "El nombre es obligatorio";
    isValid = false;
    setTimeout(() => {
      form.errors.name_carrousel = null;
    }, 3000);
  }


  if (!form.image_carrousel) {
    form.errors.image_carrousel = "La imagen es obligatorio";
    isValid = false;
    setTimeout(() => {
      form.errors.image_carrousel = null;
    }, 3000);
  }

  return isValid;
};
const handleImageUpload = (e) => {
  const file = e.target.files[0];
  form.image_carrousel = file;
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
