<template>
    <button @click="toggleContent" class="icon-card">
        <i :class="showContent ? 'bx bx-hide' : 'bx bx-show'"></i>

      </button>
</template>

<script script>
  import { ref, onMounted, onUnmounted } from 'vue';

  const showContent = ref(false);

const toggleContent = () => {
  showContent.value = !showContent.value;
};
</script>
<style scoped>
.icon-card{
    background-color: #0b59d6;
    font-size: 30px;
    border-radius: 10px;
  }
</style>