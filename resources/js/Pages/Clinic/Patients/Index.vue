<script setup>
//import GuestLayout from "@/Layouts/GuestLayout.vue";
//import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link,Head,router } from '@inertiajs/vue3';
import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
import {ref, watch} from "vue";
import {debounce} from "lodash";
import Paginator from "@/Components/Paginator.vue";
//vars
const props = defineProps({
    patients:{
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
    router.get('/pacientes',{search:value},{preserveState:true,replace:true});
},500));

</script>

<template>
    <HappyDentsLayout>
        <Head title="Pacientes"/>
        <div class="container">
            <div class="row py-2  ">
                <div class="p-5 bg-light border rounded-3">
                    <div class="col-md-10 offset-md-1 ">
                        <h1 class="h1">Pacientes</h1>
                    </div>
                    <div class="col-md-10 offset-md-1 ">
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <input type="text" id="search" v-model="search" class="rounded-2" placeholder="Buscar">
                            </div>
                            <div class="col-md-6 text-right">
                                <Link :href="route('pacientes.create')" as="button" method="get" class="btn btn-primary">Crear Nuevo Paciente</Link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 bg-white">
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">DUI</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr v-for="patient in patients.data" :key="patient.id">
                                    <td>{{patient.name}}</td>
                                    <td>{{patient.lastname}}</td>
                                    <td>{{patient.dui}}</td>
                                    <td>{{patient.phone}}</td>
                                    <td>
                                        <Link :href="route('pacientes.show',patient.id)" as="button" method="get" class="btn btn-outline-success">Ver más</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12">
                        <Paginator :links="patients.links"/>
                    </div>
                </div>
            </div>
        </div>
    </HappyDentsLayout>
</template>

<style scoped>

</style>
