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

/* const deleteconfirm = ref(false);
const file = ref(null);
const getfile = (file2) => {
    file.value = file2;
};
const confirmBackupDeletion = () => {
    deleteconfirm.value = true;
};

const closeModal = () => {
    deleteconfirm.value = false;
    
};

const destroyBackup = (file) =>{
    router.delete(route('backups.destroy',file),{
        onSuccess: () => closeModal(),
    });
}; */
const destroyBackup2 = (file) =>{
    if(confirm('Seguro que quiere Eliminar el Respaldo?')){
        router.delete(route('backups.destroy',file));
    }
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
                                        <button @click="destroyBackup2(file)" class="btn btn-outline-danger ml-2">
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
</template>