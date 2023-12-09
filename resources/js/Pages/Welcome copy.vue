<template>
    <Modo></Modo>
    <div>
      <nav >
        <BotonMenu class="menu-icon" @click="toggleMenu" />
        <div class="logo">
          Nuevo Occoro
        </div>
        <div class="nav-items" :class="{ active: isMenuActive }">
          <li><a href="#">Inicio</a></li>
          <li><a href="#">Acerca de</a></li>
          <li><a href="#">Blogs</a></li>
          <li><a href="#">Contacto</a></li>
          <li><a href="#">Comentarios</a></li>
        </div>
        <Buscador class="buscador"></Buscador>
      </nav>
      <div class="content">
        <CarouselUno/>

        <button @click="toggleContent" class="icon-card">
          <i :class="showContent ? 'bx bxs-file' : 'bx bxs-file-blank'">Documentos</i>
        </button>
        <transition name="fade">

        <div v-if="showContent" class="content-card">
          <CardUno v-for="documento in documentos" :key="documento.id">
            <template #header>
              <h1>{{ documento.name_documento }}</h1>
            </template>
            <div class="user-info-container">
              <div class="user-info-row">
              </div>
            </div>
            <template #footer>
              <BotonDos class="card-boton" @click="mostrarPDF(documento.pdf_documento)">Ver</BotonDos>
              <a :href="documento.pdf_documento" :download="documento.name_documento">
                <BotonTres class="card-boton"><i class='bx bx-download'></i>
                </BotonTres>
              </a>
            </template>
          </CardUno>
        </div>
      </transition>
      </div>
    </div>
    <!--<div>
        <h1>Lista de Documentos</h1>
    
        <ul>
          <li v-for="documento in documentos" :key="documento.id">
            {{ documento.name_documento }} 
          </li>
        </ul>
      </div>-->
  </template>
  
  <script setup>
  import Modo from '@/Pages/Theme/Modo.vue'
  import { ref, onMounted, onUnmounted } from 'vue';
  import BotonMenu from '@/Components/Botones/BotonMenu.vue'
  import Buscador from '@/Components/Buscador/Buscador.vue'
  import CarouselUno from '@/Components/Carousel/CarouselUno.vue'
  import CardUno from '@/Components/Cards/CardUno.vue';
  import BotonDos from '@/Components/Botones/BotonDos.vue'
  import BotonTres from '@/Components/Botones/BotonTres.vue'




  const props = defineProps(['documentos']);
  const mostrarPDF = (pdfDocumento) => {
  // Abre el PDF en una nueva ventana o pestaña
  window.open(pdfDocumento, '_blank');
};

  const isMenuActive = ref(false);
  const isSearchActive = ref(false);
  const showContent = ref(false);

const toggleContent = () => {
  showContent.value = !showContent.value;
};
  const toggleMenu = () => {
    isMenuActive.value = !isMenuActive.value;
    isSearchActive.value = false;
  };
  
</script>
  
  
<style scoped>
nav {
    background: #0b59d6;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    height: 70px;
    padding: 0 100px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    position: fixed;
    z-index: 100;
}

nav .logo {
    color: #fff;
    font-size: 30px;
    font-weight: 600;
    letter-spacing: -1px;
}

nav .nav-items {
    display: flex;
    flex: 1;
    padding: 0 0 0 40px;
}

nav .nav-items li {
    list-style: none;
    padding: 0 15px;
}

nav .nav-items li a {
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    text-decoration: none;
}
nav .nav-items li:hover {
    background-color: #0454df;
    border-radius: 10px;

}
nav .nav-items li a:hover {
    color: #000000;
}

nav form {
    display: flex;
    height: 40px;
    padding: 2px;
    background: #0d55c9;
    min-width: 18% !important;
    border-radius: 2px;
    border: 1px solid rgba(155, 155, 155, 0.2);
}
nav .menu-icon {
    width: 40px;
    text-align: center;
    margin: 0 50px;
    cursor: pointer;
    display: none;
    display: none;
}

@media (max-width: 1245px) {
    nav {
        padding: 0 50px;
    }
}

@media (max-width: 1140px) {
    nav {
        padding: 0px;
    }

    nav .logo {
        flex: 2;
        text-align: center;
    }

    nav .nav-items {
        position: fixed;
        z-index: 999;
        top: 60px;
        width: 40%;
        left: -100%;
        height: 100%;
        padding: 10px 50px 0 10px;
        text-align: center;
        background: #0454df;
        display: inline-block;
        transition: left 0.6s ease;
    }

    nav .nav-items.active {
        left: 0px;
    }

    nav .nav-items li {
        line-height: 40px;
        margin: 10px 0;
    }

    nav .nav-items li a {
        font-size: 15px;
    }



    nav .menu-icon {
        display: block;
    }

    nav .cancel-icon.show {
        display: block;
    }
}

.content {
    margin-top: 70px;

}
.content-card{
  display: flex; 
}
.icon-card{
  background-color: #0b59d6;
  font-size: 30px;
  border-radius: 10px;
}
.space {
    margin: 10px 0;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
 /* height: 0;*/
}
.card-boton{
  text-align: center;
}

nav .logo.space {
    color: red;
    padding: 0 5px 0 0;
}

@media (max-width: 980px) {

    nav .menu-icon,
    nav .cancel-icon,
    nav .search-icon {
        margin: 0 20px;
    }
}

@media (max-width: 350px) {

    nav .menu-icon,
    nav .cancel-icon,
    nav .search-icon {
        margin: 0 10px;
        font-size: 16px;
    }
}
.buscador {
    z-index: 999;

}
</style>
