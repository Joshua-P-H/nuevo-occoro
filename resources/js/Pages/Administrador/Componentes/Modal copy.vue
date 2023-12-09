
<script setup>
import { reactive, getCurrentInstance } from "vue";
import { useForm, router } from "@inertiajs/vue3";



const form = reactive({
    name: null,
})
const { emit } = getCurrentInstance();

const closeModal = () => {
    emit("close");
};
function submit() {
    router.post('/documento', form, {
        onSuccess: () => {
            closeModal()
            showSuccessMessage("Guardado!")
        }
    })
}

</script>
<template>
    <div>
        <div class="modal-fondo" @click="closeModal()">
            <div class="modal-contenido" @click.stop>
                <button class="close-button" @click="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
                <h1>Agregar lista</h1>
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div class="my-3">
                        <input v-model="form.name" type="text" id="name"
                            class="rounded-lg w-full p-2.5 dark:focus:ring-blue-500">
                    </div>
                    <div class="form-group my-3">
                        <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

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
.modal-contenido {
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


