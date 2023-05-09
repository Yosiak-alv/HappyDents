<script setup>
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    import Modal from '@/Components/Modal.vue';
    import { Link,Head,router,usePage } from '@inertiajs/vue3';
    import { onMounted,ref } from 'vue';
    import $ from 'jquery';
    import DataTable from 'datatables.net-dt';
    const props = defineProps({
        visits:{
            type:Object,
            required:true
        },
    });
    onMounted(() => {
        $('#datatable').DataTable();
    });

    /* const deleteVisit = (id) => {
        if(confirm('Desea Eliminar la visita?')){
            router.delete(route('visitas.destroy',id));
        }
    }; */

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
        router.delete(route('visitas.destroy',selectedVisit.value),{
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
                        <h1 class="h1">Visitas</h1>
                    </div>
                    <div class="col-md-10 offset-md-1 ">
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-2">
                                        <Link :href="route('visitas.create')" as="button" method="get" class="btn btn-primary">Crear Nuevo Visita</Link>
                                    </div>
                                    <div class="col-2">
                                        <Link :href="route('visitas.deletedindex')" class="btn btn-danger">Visitas Eliminadas</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-3">
                        <table class="table mt-3" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Paciente</th>
                                    <th scope="col">Tratamiento</th>
                                    <th scope="col">Pago</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr v-for="visit in props.visits" :key="visit.id">
                                    <td>{{visit.patient?.name ?? 'Paciente Eliminado, Restaure o editelo'}}</td>
                                    <td>{{visit.treatment?.name ?? 'Tratamiento Eliminado, Restaurelo o editelo'}}</td>
                                    <td>{{visit.payment}}</td>
                                    <td>{{visit.date}}</td>
                                    <td>
                                        <Link v-if="visit.patient != null">
                                            <Link  v-if="visit.treatment != null"
                                            :href="route('visitas.edit',visit.id)" as="button" method="get" class="btn btn-outline-success">Editar</Link>
                                        </Link>
                                    
                                        <button v-if="visit.treatment != null">
                                            <button v-if="visit.patient != null" 
                                             @click="confirmVisitDeletion(visit.id)" class="btn btn-outline-danger ml-3">Eliminar</button>
                                        </button>
                                        
                                        <!--revisar a-->
                                        <a v-if="visit.treatment != null">
                                            <a v-if="visit.patient != null" 
                                            :href="route('visitas.InvoicePDF',visit.id)"  class="btn btn-outline-secondary ml-3"><i class="bi bi-receipt"></i></a>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <Modal :show="confirmingVisitDeletion" @close="closeModal">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4 class="h4 p-4">
                            Seguro de Eliminar el Registro ?
                        </h4>
                    </div>
                    <div class="col-12">
                        <p class="p p-4"> 
                            Si lo Elimina, el registro siempre permanecera en el sistema con estado inactivo, considere
                            que otros registros que utilizen este, apareceran vacios, esperando su edicion o restauracion 
                            de este registro.
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
    </HappyDentsLayout>


    
</template>