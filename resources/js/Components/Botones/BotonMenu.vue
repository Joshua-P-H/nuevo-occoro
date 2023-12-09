<!-- MenuIcon.vue -->
<template>
    <div class="menu-icon" @click="toggleMenu">
      <i class="bx" :class="{ 'bx-menu': !isMenuActive, 'bx-x': isMenuActive }"></i>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const isMenuActive = ref(false);
  
  const toggleMenu = () => {
    isMenuActive.value = !isMenuActive.value;
  };
  </script>
  
  <style scoped>
  .menu-icon {
    cursor: pointer;
    border-radius: 10px;
    font-size: 28px;
    justify-content: center;
  }
  
  .menu-icon:hover {
    box-shadow: 0 6px 6px rgba(0, 0, 0, 0.15);
    background-color: rgba(148, 24, 24, 0.432);
    border-radius: 10px;
  }
  </style>
  