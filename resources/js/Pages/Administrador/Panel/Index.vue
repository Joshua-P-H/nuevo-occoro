<script setup>
import { ref } from 'vue';

import LayoutOccoro from '@/Layouts/LayoutOccoro.vue';
import CarouselUno from '@/Components/Carousel/CarouselUno.vue'
const isChecked = ref(true);
</script>
<template>
    <LayoutOccoro>
        <CarouselUno v-model="isChecked">....</CarouselUno>

    </LayoutOccoro>
</template>