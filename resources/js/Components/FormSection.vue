<script setup>
import { computed, useSlots } from 'vue';
import SectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
    <div class="custom-grid">
        <SectionTitle >
            <template #title>
                <slot name="title" />
            </template>
            <template #description>
                <slot name="description" />
            </template>
        </SectionTitle>

        <div class="custom-form">
            <form @submit.prevent="$emit('submitted')">
                <div :class="['custom-form-container', hasActions ? 'rounded-top' : 'rounded']">
                    <div class="custom-grid-cols">
                        <slot name="form" />
                    </div>
                </div>

                <div v-if="hasActions" class="custom-actions">
                    <slot name="actions" />
                </div>
            </form>
        </div>
    </div>
</template>

<style>
/* Estilos base */
.custom-grid {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 0.4rem;
}

.custom-form {
    margin-top: 1.1rem;
    grid-column: span 1;
}

.custom-form-container {
    padding: 1rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    border-radius: 0.375rem;
}

.rounded-top {
    border-radius: 0.375rem 0.375rem 0 0;
}

.custom-grid-cols {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1rem;
}

.custom-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 1rem;
    text-align: end;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    border-radius: 0 0 0.375rem 0.375rem;
}

/* Media queries para la responsividad */
@media (min-width: 640px) {
    .custom-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .custom-form {
        grid-column: span 2;
    }
}

@media (min-width: 768px) {
    .custom-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .custom-form {
        grid-column: span 2;
    }
}
</style>
