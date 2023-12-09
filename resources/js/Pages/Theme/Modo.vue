<template>
  <div>
    <div :class="theme">
      <button @click="toggleTheme" :class="{ active: theme === 'theme-dark', circle: true }" class="floating-button">
        <i :class="theme === 'theme-dark' ? 'fas fa-sun' : 'fas fa-moon'"
          :style="{ color: theme === 'theme-dark' ? 'var(--color-icon-dark)' : 'var(--color-icon-light)' }"></i>
      </button>
    </div>
    <slot/>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';

const theme = ref('');

const saveThemeToLocalStorage = () => {
  localStorage.setItem('theme', theme.value);
};

const toggleTheme = () => {
  theme.value = theme.value === 'theme-light' ? 'theme-dark' : 'theme-light';
  document.body.className = theme.value;
  saveThemeToLocalStorage();
};

onMounted(() => {
  // Recuperar el tema almacenado en localStorage al cargar la página
  const savedTheme = localStorage.getItem('theme');
  theme.value = savedTheme || 'theme-light'; // Usa 'theme-light' si no hay tema almacenado
  document.body.className = theme.value;
});

// Usar watch para detectar cambios en la referencia de tema y guardar en localStorage
watch(theme, () => {
  saveThemeToLocalStorage();
});
</script>

<style scoped>
.custom-button {
  border-radius: 10px;
}

.floating-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 999;
}
</style>
