<script setup>
import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
import { Link, Head, router } from '@inertiajs/vue3';
import { onMounted,ref } from 'vue';
import $ from 'jquery';
import DataTable from 'datatables.net-dt';

import Modal from '@/Components/Modal.vue';



const props = defineProps({
    files: {
        type: Array,
        requred: true
    }
});

onMounted(() => {
    $('#datatable').DataTable();
});

    //---Modal Section----
    const confirmingBackupDeletion = ref(false);
    const selectedBackup = ref(null);
    
    const confirmBackupDeletion = (file) => {
        confirmingBackupDeletion.value = true;
        selectedBackup.value = file;
    };

    const closeModal = () => {
        confirmingBackupDeletion.value = false;
    };

    const deleteBackup = () => {
        router.delete(route('backups.destroy',selectedBackup.value),{
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => closeModal(),
        });
    };

</script>
<style>
@import 'datatables.net-dt';
</style>
<template>
    <HappyDentsLayout>

        <Head title="Respaldos" />

        <div class="container mt-5">
            <div class="row">
                <div class="p-5 bg-light border rounded-3">
                    <div class="col-md-10 offset-md-1">
                        <h1 class="h1">Respaldos</h1>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-5">
                        <Link :href="route('backups.store')" as="button" method="get" class="btn btn-primary"><i
                            class="bi bi-arrow-counterclockwise"></i> Crear Nuevo Respaldo</Link>
                    </div>

                    <div class="col-md-10 offset-md-1 mt-3">
                        <table class="table mt-3" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Respaldo</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr v-for="file, index in props.files">
                                    <td>{{ index = index + 1 }}</td>
                                    <td>{{ file }}</td>
                                    <td>
                                        <!--<a> porque sino la respuesta no funciona de download-->
                                        <a :href="route('backups.download', file)" class="btn btn-outline-success"><i
                                                class="bi bi-arrow-down"></i></a>
                                        <button @click="confirmBackupDeletion(file)" class="btn btn-outline-danger ml-2">
                                            <i class="bi bi-trash"></i></button>
                                           <!--  <button @click="confirmBackupDeletion()" :ref="getfile(file)" class="btn btn-outline-danger">
                                            <i class="bi bi-trash"></i></button> -->
                                        <!-- <Link :href="route('backups.destroy', file)" :onStart="() => confirm('Are you sure?')" 
                                            as="button" method="delete"
                                            class="btn btn-outline-danger"><i class="bi bi-trash"></i></Link> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </HappyDentsLayout>

    <Modal :show="confirmingBackupDeletion" @close="closeModal">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4 class="h4 p-4">
                            Seguro de Eliminar el Registro ?
                        </h4>
                    </div>
                    <div class="col-12">
                        <p class="p p-4"> 
                            Si lo Elimina, el registro se borrara PERMANETEMENTE, sin posibilidad de 
                            recuperacion de la informacion del registro, desea continuar ?
                        </p>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-row-reverse border">
                <div class="p-2 ">
                    <button class="btn btn-secondary" @click="closeModal">Cancelar</button>
                </div>
                <div class="p-2">
                    <button class="btn btn-danger" @click="deleteBackup">Confirmar</button>
                </div>
            </div>
        </Modal>
</template>