<template>
    <header class="header fixed-top z-3 fw-bold text-white" style="background-color: #00BFFF;">
        <div class="d-flex align-items-center justify-content-between">
            <!--lOGO-->
            <Link :href="route('home')">
            <img src="/storage/img/Dents_logo.png" class="d-inline-block" alt="Happy Dents" style="height: 80px;">
            </Link>

            <!--NavBAR-->
            <div class="col-md-8">
                <div class="row justify-content-center">
                    <div class="col-2" v-if="usePage().props.auth.user.role.type === 'administrador'">
                        <div class="fs-5 ">
                            <Link :href="route('users.index')">Usuarios</Link>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="fs-5 ">
                            <Link :href="route('pacientes.index')">Pacientes</Link>
                        </div>
                    </div>

                    <div class="col-2 ">
                        <div class="fs-5"
                            v-if="usePage().props.auth.user.role.type === 'administrador'
                                || usePage().props.auth.user.role.type === 'recepcionista' || usePage().props.auth.user.role.type === 'doctor'">
                            <div class="fs-5 ">
                                <Link :href="route('visitas.index')">Visitas</Link>
                            </div>
                        </div>
                    </div>
                    <div class="col-2" v-if="usePage().props.auth.user.role.type === 'administrador'
                        || usePage().props.auth.user.role.type === 'doctor'">
                        <div class="fs-5 ">
                            <Link :href="route('tratamientos.index')">Tratamientos</Link>
                        </div>
                    </div>
                    <div class="col-2 " v-if="usePage().props.auth.user.role.type === 'administrador'">
                        <div class="fs-5">
                            <Link :href="route('backups.index')">Respaldos</Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="me-3">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{ $page.props.auth.user.name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                            <DropdownLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
        </div>
    </header>

    <main style="min-height: calc(100vh - 96px); padding-top:70px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <slot />
                </div>

            </div>
        </div>

    </main>
    <flash-message />
    <footer class="text-center text-white p-4" style="background-color: #00BFFF;">
        <p>&copy; 2023 Happy Dents. All rights reserved.</p>
        <a v-if="usePage().props.auth.user.role.type === 'administrador'" href="
            https://drive.google.com/file/d/15Bacjiy7ETIwPoGW2vIlgQKN0B4VmeBR/view?usp=sharing"
        class="mx-3">Manual de Usuario</a>
        <a v-else-if="usePage().props.auth.user.role.type === 'doctor'" href="
            https://drive.google.com/file/d/1ripzKV2nY8u7-0sOxMtekxdXSfU0y1vy/view"
        class="mx-3">Manual de Usuario</a>
        <a v-else-if="usePage().props.auth.user.role.type === 'asistente dental'" href="
            https://drive.google.com/file/d/1nJynruiSaNBdX3jUKZRcKHxlS7w18n3z/view"
        class="mx-3">Manual de Usuario</a>
        <a v-else-if="usePage().props.auth.user.role.type === 'recepcionista'" href="
            https://drive.google.com/file/d/1MTyYQfPpNZUKkrzJ4AV_KZe1g3ZKQAhR/view"
        class="mx-3">Manual de Usuario</a>
    </footer>
</template>

<script setup>
import FlashMessage from '@/Components/Flash.vue';
import { Link, usePage } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
</script>

<style scoped>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 16px;
    color: #444;
    background-color: #f7f7f7;
}
</style>
