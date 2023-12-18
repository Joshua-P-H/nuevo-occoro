<script setup>
import { defineProps, defineEmits } from 'vue';

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    emit('close');
};
</script>

<template>
    <div class="modal" :style="{ display: show ? 'flex' : 'none' }" @click="close">
        <div class="modal-content" :style="{ maxWidth: maxWidth }" @click.stop>
            <div class="modal-body">
                <slot />
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    max-width: 2xl; /* Puedes ajustar esto según tu prop maxWidth */
    width: 40%;
    border-radius: 0.5rem;
    overflow: hidden;

}

.modal-body {
    padding: 1rem;
    font-size: 1rem;
}

@media (max-width: 768px) {
    .modal-content {
        width: 90%;
    }
}
</style>
