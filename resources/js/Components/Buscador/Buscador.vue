<template>
  <div>
    <div class="search-overlay">
      <form action="" class="search-form">
        <div v-if="!isSmallScreen || isSearchOpen" class="input-search">
          <input v-if="!isSmallScreen" type="search" name="" id="" class="input-field" placeholder="Buscar...">
          <button v-if="!isSmallScreen" class="secondary-search-button" @click="performSearch">
            <i :class="isSearchActive ? 'fas fa-times' : 'fas fa-search'" @click="toggleSearch"></i>

          </button>
        </div>
        <button v-else @click="openSearch" class="search-button">
          <i class="fas fa-search"></i>
        </button>
      </form>
    </div>
    <div v-if="isSmallScreen && isSearchOpen" class="modal" @click="closeSearch">
      <!-- Contenido del modal -->
      <div class="modal-content" @click.stop>
        <div class="input-search">
          <input type="search" name="" id="" class="input-field" placeholder="Buscar...">
          <button class="secondary-search-button" @click="performSearch"><i class="fas fa-search"></i></button>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const isSmallScreen = ref(false);
const isSearchOpen = ref(false);

onMounted(() => {
  const handleResize = () => {
    isSmallScreen.value = window.innerWidth < 768;
  };

  handleResize();
  window.addEventListener('resize', handleResize);

  onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
  });
});

const openSearch = () => {
  if (isSmallScreen.value) {
    isSearchOpen.value = true;
  }
};

const closeSearch = () => {
  isSearchOpen.value = false;
};

const performSearch = () => {
  isSearchOpen.value = false; 
};
const isSearchActive = ref(false); // Inicialízala con el valor inicial que desees
const toggleSearch = () => {
  isSearchActive.value = !isSearchActive.value; // Cambia el valor entre true y false
};
</script>

<style scoped>
/* Estilos generales */
.search-overlay {
  position: relative;
  padding: 10px 10px;
}

.search-form {
  display: flex;
  align-items: center;
  justify-content: flex-end;
}

/* Estilos para el campo de búsqueda y botón principal */
.input-search {
  position: relative;
  display: flex;
  align-items: center;
}

.input-field {
  padding-right: 40px;
  /* Espacio para el botón dentro del input */
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 8px;
  width: 350px;
  border-radius: 20px;


  /* Estilos responsive para pantallas pequeñas */
  @media screen and (max-width: 767px) {
    width: 100%;
  }
}

.secondary-search-button {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  border: none;
  cursor: pointer;
  padding: 0;
  font-size: 16px;
  color: #999;
}

/* Estilos para el botón de búsqueda en el modal */
.modal {
  position: fixed;
  top: -37%;
  right: 0;
  /* Ajustado para estar en la parte derecha */
  width: 100%;
  /* Ajustado para ocupar el 80% del ancho de la pantalla */
  height: 100%;
  display: flex;
  align-items: center;
  border-radius: 20px;
  z-index: 100;


}

.modal-content {
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  width: 100%;
  /* El contenido del modal ocupa todo el espacio disponible */
  text-align: center;
  border-radius: 20px;


}

@media screen and (max-width: 767px) {
  .modal {
    display: flex;
    /* Mostrar el modal en pantallas pequeñas */
  }
}</style>
