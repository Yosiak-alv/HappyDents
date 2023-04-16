<script setup>
    import { Link,usePage,router } from "@inertiajs/vue3";
    import Modal from '@/Components/Modal.vue';
    import { onMounted,ref } from 'vue';
    import $ from 'jquery';
    import DataTable from 'datatables.net-dt';
    const props = defineProps({
        patient_visits:{
            type:Object
        },
        patient_id:{
            type:Number,
            required:true
        }
    });
    onMounted(() => {
        $('#datatable6').DataTable();
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
        router.delete(route('pacienteVisitas.destroy',selectedVisit.value),{
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
    <div v-if="props.patient_visits.length !== 0 ">
        <header>
            <h2 class="h2">Visitas</h2>

            <p class="p">
                Informacion sobre las Visitas del paciente.
            </p>
        </header>
        <div class="flex justify-between mt-6 mb-2" v-if="usePage().props.auth.user.role.type != 'asistente dental'">
            <Link :href="route('pacienteVisitas.create',props.patient_id)"  method="get" as="button" class="btn btn-primary">Crear Nueva Visita</Link>
        </div>
        <table class="table mt-3" id="datatable6">
            <thead>
                <tr>
                    <th scope="col">Tratamiento</th>
                    <th scope="col">Pago</th>
                    <th scope="col">Fecha</th>
                    <th scope="col" class="text-center" v-if="usePage().props.auth.user.role.type != 'asistente dental'">Opciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr v-for="visit in props.patient_visits" :key="visit.id">
                    <td>{{visit.treatment.name}}</td>
                    <td>{{visit.payment}}</td>
                    <td>{{visit.date }}</td>
                    <td class="text-center" v-if="usePage().props.auth.user.role.type != 'asistente dental'">
                        <Link :href="route('pacienteVisitas.edit',visit.id)" as="button" method="get" class="btn btn-outline-success">Editar</Link>
                        <button @click="confirmVisitDeletion(visit.id)" class="btn btn-outline-danger">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="mt-1 text-sm text-gray-600 p-5 text-center">
            El paciente no posee Visitas.
            <div class="py-4" v-if="usePage().props.auth.user.role.type != 'asistente dental'">
                <Link :href="route('pacienteVisitas.create',props.patient_id)"  method="get" as="button" class="btn btn-secondary">Actualizar Informacion.</Link>
            </div>
        </p>
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
</template>