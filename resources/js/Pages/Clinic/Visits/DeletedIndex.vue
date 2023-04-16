<script setup>
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    import Modal from '@/Components/Modal.vue';
    import { Link,Head,router,usePage } from '@inertiajs/vue3';
    import { onMounted,ref} from 'vue';
    import $ from 'jquery';
    import DataTable from 'datatables.net-dt';
    const props =  defineProps({
        visits:{
            type:Object,
            required:true
        }
    });
    onMounted(() => {
        $('#datatable2').DataTable();
    });

    //---Modal Section----
    const confirmingVisitDeletion = ref(false);
    const selectedVisit = ref(0);
    
    const confirmVisitDeletion = (id) => {
        confirmingVisitDeletion.value = true;
        selectedVisit.value = id;
    };

    const closeModal = () => {
        confirmingVisitDeletion.value = false;
    };

    const deleteVisit = () => {
        router.delete(route('visitas.forceDelete',selectedVisit.value),{
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
        <Head title="Visitas"/>
        <div class="container">
            <div class="row mt-5">
                <div class="p-5 bg-light border rounded-3 mb-5" >
                    <div class="col-md-10 offset-md-1">
                        <h1 class="h1">Visitas Eliminadas</h1>
                    </div>
                    <div class="col-md-10 offset-md-1 ">
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-2">
                                        <Link :href="route('visitas.index')" as="button" method="get" class="btn btn-primary">Ver Activos</Link>
                                    </div>
                                    <div class="col-2">
                                        <Link  v-if="props.visits.length != 0"
                                        :href="route('visitas.restoreAll')" as="button" method="post" class="btn btn-success">Restaurar Todos</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-3" v-if="props.visits.length != 0 ">
                        <table class="table mt-3" id="datatable2" >
                            <thead>
                                <tr>
                                    <th scope="col">Paciente</th>
                                    <th scope="col">Tratamiento</th>
                                    <th scope="col">Pago</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Eliminado el</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr v-for="visit in props.visits" :key="visit.id">
                                    <td>{{visit.patient?.name ?? 'Paciente Eliminado, Restaure el Paciente primero'}}</td>
                                    <td>{{visit.treatment?.name ?? 'Tratamiento Eliminado, Restaurelo o editelo'}}</td>
                                    <td>{{visit.payment}}</td>
                                    <td>{{visit.date}}</td>
                                    <td>{{visit.deleted_at}}</td>
                                    <td>
                                        <Link :href="route('visitas.restore',visit.id)" as="button" method="post" class="btn btn-outline-success">Restaurar</Link>
                                        
                                        <button v-if="usePage().props.auth.user.role.type == 'administrador'" 
                                        @click="confirmVisitDeletion(visit.id)" class="btn btn-outline-danger">Force-Delete</button>
                                        
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

    <Modal :show="confirmingVisitDeletion" @close="closeModal">
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
                    <button class="btn btn-danger" @click="deleteVisit">Confirmar</button>
                </div>
            </div>
        </Modal>

</template>