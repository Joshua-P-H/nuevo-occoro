<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    as: String,
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" type="submit" class="my-button">
            <slot />
        </button>

        <a v-else-if="as =='a'" :href="href" class="my-link">
            <slot />
        </a>

        <Link v-else :href="href" class="my-link">
            <slot />
        </Link>
    </div>
</template>

<style scoped>
.my-button,
.my-link {
    display: block;
    font-size: 0.875rem;
    line-height: 1.25rem;
    color: #ffffff;
    background-color: #000000;
    border-radius: 0.375rem;
    transition: background-color 0.3s ease-in-out;
    cursor: pointer;
}

.my-button:hover,
.my-link:hover {
    background-color: #0472e0;
}

.my-button:focus,
.my-link:focus {
    outline: none;
    background-color: #edf2f7;
}

.my-button:focus-visible,
.my-link:focus-visible {
    box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
}
</style>
