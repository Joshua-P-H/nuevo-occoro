<template>
  <div>
    <div class="modal-fondo" @click="closeModal()">
      <div class="modal-content" @click.stop>
        <button class="close-button" @click="closeModal()">
          <i class="fas fa-times"></i>
        </button>
        <h1>Actualizar footer</h1>
        <form @submit.prevent="submit" enctype="multipart/form-data">
          <div class="my-3">
            <input
              v-model="form.gestion_footer"
              type="text"
              id="gestion_footer"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              placeholder="Agregue el año de gestión"
            />
            <span v-if="form.errors.gestion_footer" class="text-red-500">{{
              form.errors.gestion_footer
            }}</span>
          </div>
          <div class="my-3">
            <input
              v-model="form.copy_footer"
              type="text"
              id="copy_footer"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              placeholder="Agregue el copy"
            />
            <span v-if="form.errors.copy_footer" class="text-red-500">{{
              form.errors.copy_footer
            }}</span>
          </div>
          <div class="my-3">
            <input
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              type="file"
              @change="handleImageUpload"
              id="image_footer"
              accept="image/*"
            />
            <span v-if="form.errors.image_footer" class="text-red-500">{{
              form.errors.image_footer
            }}</span>
          </div>
          <div class="my-3">
            <input
              v-model="form.telefono_footer"
              type="number"
              id="telefono_footer"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              placeholder="Agregue numeros telefonicos"
              pattern="[0-9]*"
            />
            <span v-if="form.errors.telefono_footer" class="text-red-500">{{
              form.errors.telefono_footer
            }}</span>
          </div>
          <div class="my-3">
            <input
              v-model="form.link_footer"
              type="text"
              id="link_footer"
              class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500 bg-transparent"
              placeholder="Agregue link de redes sociales"
            />
            <span v-if="form.errors.link_footer" class="text-red-500">{{
              form.errors.link_footer
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
  gestion_footer: null,
  copy_footer: null,
  image_footer: null,
  telefono_footer: null,
  link_footer: null,

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
    formData.append("gestion_footer", form.gestion_footer);
    formData.append("copy_footer", form.copy_footer);
    formData.append("image_footer", form.image_footer);
    formData.append("telefono_footer", form.telefono_footer);
    formData.append("link_footer", form.link_footer);

    router.post("/footers/", formData, {
      onSuccess: () => {
        closeModal();
      },
    });
  }
};

const validateForm = () => {
  let isValid = true;
  form.errors = {};

  if (!form.gestion_footer) {
    form.errors.gestion_footer = "El nombre es obligatorio";
    isValid = false;
    setTimeout(() => {
      form.errors.gestion_footer = null;
    }, 3000);
  }

  if (!form.copy_footer) {
    form.errors.copy_footer = "El nombre es obligatorio";
    isValid = false;
    setTimeout(() => {
      form.errors.copy_footer = null;
    }, 3000);
  }

  if (!form.image_footer) {
    form.errors.image_footer = "La imagen es obligatoria";
    isValid = false;
    setTimeout(() => {
      form.errors.image_footer = null;
    }, 3000);
  }
  if (!form.telefono_footer) {
    form.errors.telefono_footer = "El nombre es obligatorio";
    isValid = false;
    setTimeout(() => {
      form.errors.telefono_footer = null;
    }, 3000);
  }

  if (!form.link_footer) {
    form.errors.link_footer = "El nombre es obligatorio";
    isValid = false;
    setTimeout(() => {
      form.errors.link_footer = null;
    }, 3000);
  }

  return isValid;
};
const handleImageUpload = (e) => {
  const file = e.target.files[0];
  form.image_footer = file;
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
