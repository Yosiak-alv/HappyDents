<script setup>

import { Link,Head,router,usePage } from '@inertiajs/vue3';
import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
import {ref, watch} from "vue";
import {debounce} from "lodash";
import Paginator from "@/Components/Paginator.vue";
//vars
const props = defineProps({
    users:{
        type:Object,
        requierd:true
    },
    filters:{
        type:Object,
        requiered:true
    }
});

//search Handling
const search = ref(props.filters.search);
watch(search, debounce(value => {
    router.get('/users',{search:value},{preserveState:true,replace:true});
},500));

</script>

<template>
    <HappyDentsLayout>
        <Head title="Usuarios"/>
        <div class="container">
            <div class="row">
                <div class="p-5 bg-light border rounded-3 " >
                    <div class="col-md-10 offset-md-1">
                        <h1 class="h1">Usuarios</h1>
                    </div>
                    <div class="col-md-10 offset-md-1 ">
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <input type="text" id="search" v-model="search" class="rounded-2" placeholder="Buscar">
                            </div>
                            <div class="col-md-6 text-right">
                                <Link :href="route('users.create')" as="button" method="get" class="btn btn-primary">Crear Nuevo Usuario</Link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 bg-white">
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{user.role.type}}</td>
                                    <td v-if="usePage().props.auth.user.id != user.id">
                                        <Link :href="route('users.show',user.id)" as="button" method="get" class="btn btn-outline-success">Mostrar</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12">
                       <Paginator :links="users.links"/>
                    </div>
                </div>
            </div>
        </div>
    </HappyDentsLayout>
</template>

<style scoped>

</style>
