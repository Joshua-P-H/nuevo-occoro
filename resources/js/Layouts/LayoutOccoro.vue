<template>
    <Modo>

        <nav class="navbar" :class="{ close: sidebarClosed }">
            <header>
                <div class="image-text">
                    <span class="image">
                        <img src="" alt="">
                    </span>
                    <div class="text logo-text">
                        <span class="name">Nuevo occoro</span>
                        <span class="profession" v-if="$page.props.jetstream.managesProfilePhotos">
                            <button type="button"
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                            </button>
                        </span>
                        <span v-else>
                            {{ $page.props.auth.user.name }}
                        </span>

                    </div>
                </div>
                <i class='bx bx-chevron-right toggle' @click="toggleSidebar"></i>
            </header>
            <div class="menu-bar">
                <div class="menu">
                    <ul class="menu-links">
                        <li class="nav-link">
                            <Link href="/fechas" class="menu-link">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                            </Link>
                        </li>
                        <li class="nav-link">
                            <Link href="/documentos" class="menu-link">
                            <i class='bx bx-file icon'></i>
                            <span class="text nav-text">Documentos</span>
                            </Link>
                        </li>
                        <li class="nav-link">
                            <Link href="/users" class="menu-link">
                            <i class='bx bx-user icon'></i>

                            <span class="text nav-text">Usuario</span>
                            </Link>
                        </li>
                        <li class="nav-link">
                            <Link href="/prensas" class="menu-link">
                            <i class='bx bx-message-dots icon'></i>
                            <span class="text nav-text">Prensa</span>
                            </Link>
                        </li>
                        <li class="nav-link">
                            <Link href="/convocatorias" class="menu-link">
                            <i class='bx bx-low-vision icon'></i>
                            <span class="text nav-text">Convocatorias</span>
                            </Link>
                        </li>
                    </ul>
                </div>
                <div class="bottom-content">
                    <li class="">
                        <!-- Authentication -->
                        <form @submit.prevent="logout">
                            <DropdownLink as="button">
                                Log Out
                            </DropdownLink>
                        </form>
                    </li>
                </div>
            </div>

        </nav>
        <div class="content-container">

            <div class="content" :style="contentStyles">
                <slot>
                </slot>
            </div>
        </div>
    </Modo>
</template>
  
  
<script setup>
import { ref, computed, onMounted } from 'vue';
import Modo from '@/Pages/Theme/Modo.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import DropdownLink from '@/Components/DropdownLink.vue';
import Dropdown from '@/Components/Dropdown.vue';

//import 'boxicons';


const sidebarClosed = ref(true);

const toggleSidebar = () => {
    sidebarClosed.value = !sidebarClosed.value;
};
const contentStyles = computed(() => ({
    marginLeft: sidebarClosed.value ? '88px' : '250px',
    width: sidebarClosed.value ? 'calc(100% - 88px)' : 'calc(100% - 250px)'
}));


const logout = () => {
    router.post(route('logout'));
}

</script>

<style>
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 250px;
    padding: 10px 14px;
    z-index: 100;
}

.navbar.close {
    width: 88px;
}

/* ===== Reusable code - Here ===== */
.navbar li {
    height: 50px;
    list-style: none;
    display: flex;
    align-items: center;
    margin-top: 10px;
}

.navbar header .image,
.navbar .icon {
    min-width: 60px;
    border-radius: 6px;
}

.navbar .icon {
    min-width: 60px;
    border-radius: 6px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}


.navbar .text {
    font-size: 17px;
    font-weight: 500;
    white-space: nowrap;
    opacity: 1;
}

.navbar.close .text {
    visibility: hidden;
}

/* =========================== */

.navbar header {
    position: relative;
}

.navbar header .image-text {
    display: flex;
    align-items: center;
}

.navbar header .logo-text {
    display: flex;
    flex-direction: column;
}

header .image-text .name {
    margin-top: 2px;
    font-size: 18px;
    font-weight: 600;
}

header .image-text .profession {
    font-size: 16px;
    margin-top: -2px;
    display: block;
}

.navbar header .image {
    display: flex;
    align-items: center;
    justify-content: center;
}

.navbar header .image img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.navbar header .toggle {
    position: absolute;
    top: 50%;
    right: -25px;
    transform: translateY(-50%) rotate(180deg);
    height: 25px;
    width: 25px;
    background-color: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    cursor: pointer;
    transition: var(--tran-05);
}

.navbar.close .toggle {
    transform: translateY(-50%) rotate(0deg);
}

.navbar .menu {
    margin-top: 10px;
}

.navbar li .menu-link {
    list-style: none;
    height: 100%;
    background-color: transparent;
    display: flex;
    align-items: center;
    height: 100%;
    width: 100%;
    border-radius: 10px;
    text-decoration: none;
    transition: transform 0.3s, background-color 0.3s; /* Agregamos una transición al hacer hover */

}

.navbar li .menu-link:hover {
    background-color: var(--primary-color);
    transform: scale(1.09);
    border-radius: 10px;

}

.navbar li .menu-link:hover .icon,
.navbar li .menu-link:hover .text {
    color: var(--sidebar-color);
}

body.dark .navbar li .menu-link:hover .icon,
body.dark .navbar li .menu-link:hover .text {
    color: var(--text-color);
}

.navbar .menu-bar {
    height: calc(100% - 55px);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow-y: scroll;
}

.menu-bar::-webkit-scrollbar {
    display: none;
}


.content-container::-webkit-scrollbar {
    display: none;

}



.content {
    font-size: 18px;
    padding: 10px;
    border-radius: 6px;
    transition: margin-left 0.3s, width 0.3s;

}


@media screen and (max-width: 768px) {
    .content-container {
        overflow-x: auto;
    }

}
</style>  
  
    