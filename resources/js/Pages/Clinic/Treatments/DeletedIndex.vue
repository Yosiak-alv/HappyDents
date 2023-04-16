<script setup>
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    import Modal from '@/Components/Modal.vue';
    import { Link,Head,router,usePage } from '@inertiajs/vue3';
    import { onMounted,ref } from 'vue';
    import $ from 'jquery';
    import DataTable from 'datatables.net-dt';
    const props =  defineProps({
        treatments:{
            type:Object,
            required:true
        }
    });
    onMounted(() => {
        $('#datatable2').DataTable();
    });

     //---Modal Section----
    const confirmingTreatmentDeletion = ref(false);
    const selectedTreatment = ref(0);
    
    const confirmTreatmentDeletion = (id) => {
        confirmingTreatmentDeletion.value = true;
        selectedTreatment.value = id;
    };

    const closeModal = () => {
        confirmingTreatmentDeletion.value = false;
    };

    const deleteTreatment = () => {
        router.delete(route('tratamientos.forceDelete',selectedTreatment.value),{
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
        <Head title="Tratamientos"/>
        <div class="container">
            <div class="row mt-5">
                <div class="p-5 bg-light border rounded-3 mb-5" >
                    <div class="col-md-10 offset-md-1">
                        <h1 class="h1">Tramientos Eliminados</h1>
                    </div>
                    <div class="col-md-10 offset-md-1 ">
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-2">
                                        <Link :href="route('tratamientos.index')" as="button" method="get" class="btn btn-primary">Ver Activos</Link>
                                    </div>
                                    <div class="col-2">
                                        <Link  v-if="props.treatments.length != 0"
                                        :href="route('tratamientos.restoreAll')" as="button" method="post" class="btn btn-success">Restaurar Todos</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-3" v-if="props.treatments.length != 0 ">
                        <table class="table mt-3" id="datatable2" >
                            <thead>
                                <tr>
                                    <th scope="col">Tratamiento</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Eliminado el</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr v-for="treatment in props.treatments" :key="treatment.id">
                                    <td>{{treatment.name}}</td>
                                    <td>{{treatment.price}}</td>
                                    <td>{{treatment.deleted_at}}</td>
                                    <td>
                                        <Link :href="route('tratamientos.restore',treatment.id)" as="button" method="post" class="btn btn-outline-success">Restaurar</Link>
                                        <button v-if="usePage().props.auth.user.role.type == 'administrador'"
                                        @click="confirmTreatmentDeletion(treatment.id)" class="btn btn-outline-danger">Force-Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-3" v-else>
                        <p class="mt-1 text-sm text-gray-600 p-5 text-center">
                            No se han Eliminado Registros.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </HappyDentsLayout>

    <Modal :show="confirmingTreatmentDeletion" @close="closeModal">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="h4 p-4">
                        Seguro de Eliminar COMPLETAMENTE el Registro ?
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
                <button class="btn btn-danger" @click="deleteTreatment">Confirmar</button>
            </div>
        </div>
    </Modal>
</template>