<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";

import Modo from "@/Pages/Theme/Modo.vue";
import FooterWelcome from "@/Pages/Welcome/Components/FooterWelcome.vue";

const isMenuOpen = ref(false);
const isSmallScreen = ref(window.innerWidth <= 600);

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = () => {
  if (isSmallScreen.value) {
    isMenuOpen.value = false;
  }
};

const updateScreenSize = () => {
  isSmallScreen.value = window.innerWidth <= 600;
  isMenuOpen.value = false;
};

onMounted(() => {
  window.addEventListener("resize", updateScreenSize);
});

onBeforeUnmount(() => {
  window.removeEventListener("resize", updateScreenSize);
});
</script>
<template>
  <Modo>
    <nav>
      <button class="icono" @click="toggleMenu" v-show="isSmallScreen">
        <i class="bx bx-menu"></i>
      </button>
      <div class="logo">
        <img src="http://127.0.0.1:8001/imagesprensa/NUEVO_OCC1.png" alt="" />
      </div>
      <ul
        class="nav-list"
        :class="{ 'show-menu': isMenuOpen }"
        @mouseleave="closeMenu"
      >
        <li><Link href="/" class="nav-link">Inicio</Link></li>
        <li class="dropdown">
          <a href="#" class="nav-link"
            >Opciones <i class="bx bx-caret-down"></i
          ></a>
          <ul class="dropdown-content">
            <li><Link href="/misionvision" class="nav-link">Misión y visión</Link></li>
            <li><Link href="/organigrama" class="nav-link">Organigrama</Link></li>
            <li class="dropdown-submenu">
              <a href="#" class="nav-link"
                >Convocatorias<i class="bx bx-caret-down"></i
              ></a>
              <ul class="dropdown-submenu-content">
                <li><Link href="/viewsconvocatorias" class="nav-link">Convocatoria-1</Link></li>
              </ul>
            </li>
            
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link"
            >Distrito<i class="bx bx-caret-down"></i
          ></a>
          <ul class="dropdown-content">
            <li><Link href="/demografia" class="nav-link">Demografia</Link></li>
            <li><Link href="/historia" class="nav-link">Reseña hitorica</Link></li>            
          </ul>
        </li>
        <li><a href="#" class="nav-link">Otros</a></li>
        <li><Link href="/noticias" class="nav-link">Noticias</Link></li>
        <li><Link href="/docview" class="nav-link">Otros</Link></li>
      </ul>
    </nav>
    <div class="content">
      <slot> </slot>
    </div>
    <footer>
      <FooterWelcome />
    </footer>
  </Modo>
</template>

<style scoped>
body.menu-open {
  overflow-y: hidden; /* Oculta solo el desplazamiento vertical */
}
nav {
  display: flex; /* Asegura que el navbar esté en fila horizontal */
  align-items: center; /* Centra verticalmente los elementos en el navbar */
  background-color: #333;
  padding: 10px;
  font-family: "Arial", sans-serif;
  color: #ddd;
  top: 0;
  left: 0;
  position: fixed;
  z-index: 1000;
  width: 100%;
}

.nav-list {
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: row;
}
.nav-link {
  margin: 5px 0 0 0;
}
.icono {
  margin-right: 20px;
  font-size: 30px;
}
.logo {
  max-width: 200px; /* Establece un ancho máximo para el logo */
  margin-right: 350px; /* Ajusta este valor para establecer el espacio deseado */
}
.logo img {
  width: 100%; /* Establece el ancho de la imagen al 100% del contenedor (.logo) */
  max-width: 180px; /* Establece el ancho máximo para la imagen */
  height: auto; /* Permite que la altura se ajuste automáticamente según el ancho */
  display: block; /* Elimina el espacio adicional debajo de la imagen */
}

@media screen and (max-width: 600px) {
  .logo {
    max-width: 200px; /* Establece un ancho máximo para el logo */
    margin-right: 40px; /* Ajusta este valor para establecer el espacio deseado */
  }
  .nav-list {
    position: absolute;
    top: 82px;
    left: 0;
    width: 40%;
    height: 100vh;
    flex-direction: column;
    background-color: rgb(19, 24, 24);
    text-align: center;
    opacity: 0;
    visibility: hidden;
    transform: translateZ(-20px);
    transition: opacity 0.8s, transform 0.8s, visibility 0.8s;
  }
  .nav-link {
    margin: 5px 0; /* Ajusta el margen superior e inferior según sea necesario */
  }
  .dropdown-content {
    left: 80%;
    visibility: hidden;
    position: absolute;
    background-color: #070606;
    min-width: 190px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 4px;
    padding: 0;
    margin-right: 90px;
    text-align: center;
    opacity: 0;
    transform: translateY(-20px);
    transition: opacity 0.8s, transform 0.8s, visibility 0.8s;
  }
  .dropdown-submenu-content {
    left: 80%;
    visibility: hidden;
    position: absolute;
    background-color: #070606;
    min-width: 190px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 4px;
    padding: 0;
    margin-right: 90px;
    text-align: center;
    opacity: 0;
    transform: translateY(-20px);
    transition: opacity 0.8s, transform 0.8s, visibility 0.8s;
  }

  .show-menu {
    display: flex;
  }

  .nav-list.show-menu {
    opacity: 1;
    visibility: visible;
    transform: translateZ(0);
  }
}

.dropdown {
  position: relative;
}
.dropdown-submenu {
  position: relative;
}

.dropdown-content {
  visibility: hidden;
  position: absolute;
  background-color: #070606;
  min-width: 190px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  z-index: 1;
  border-radius: 4px;
  padding: 0;
  margin-right: 90px;
  text-align: center;
  opacity: 0;
  transform: translateY(-20px);
  transition: opacity 0.8s, transform 0.8s, visibility 0.8s;
}

.dropdown:hover .dropdown-content {
  visibility: visible;
  opacity: 1;
  transform: translateY(0);
}
.dropdown-submenu-content {
  left: 80%;
  visibility: hidden;
  position: absolute;
  background-color: #070606;
  min-width: 190px;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  z-index: 1;
  border-radius: 4px;
  padding: 0;
  margin-right: 200px;
  text-align: center;
  opacity: 0;
  transform: translateY(-10px);
  transition: opacity 0.8s, transform 0.8s, visibility 0.8s;
}
.dropdown-submenu:hover .dropdown-submenu-content {
  visibility: visible;
  opacity: 1;
  transform: translateY(0);
}

.nav-link {
  color: white;
  padding: 14px 16px;
  text-decoration: none;
  display: inline-block;
  transition: background-color 0.3s;
}

.nav-link:hover {
  background-color: #555;
  border-radius: 10px;
}

.nav-link:active {
  background-color: #ddd;
}

.nav-link:focus {
  outline: none;
}

.content {
  padding-top: 0;
  margin-top: 82px;
  /*    position: fixed;
*/
}
footer {
  background-color: #333;
  color: #ddd;
  bottom: 0;
  left: 0;
  width: 100%;
}
</style>
