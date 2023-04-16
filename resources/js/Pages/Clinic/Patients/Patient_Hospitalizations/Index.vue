<script setup>
    import { router,Link,usePage} from "@inertiajs/vue3";
    import Modal from '@/Components/Modal.vue';
    import { onMounted,ref } from 'vue';
    import $ from 'jquery';
    import DataTable from 'datatables.net-dt';
    const props = defineProps({
        patient_hospitalizations:{
            type:Object
        },
        patient_id:{
            type:Number,
            required:true
        }
    });
    onMounted(() => {
        $('#datatable3').DataTable();
    });

    //---Modal Section----
    const confirmingHospitalizationDeletion = ref(false);
    const selectedHospitalization = ref(0);
    
    const confirmPatientDeletion = (id) => {
        confirmingHospitalizationDeletion.value = true;
        selectedHospitalization.value = id;
    };

    const closeModal = () => {
        confirmingHospitalizationDeletion.value = false;
    };
    
    const deleteHospitalization = () => {
        router.delete(route('pacienteHospitalizacion.destroy',selectedHospitalization.value),{
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
    <div v-if="patient_hospitalizations.length !== 0 ">
        <header>
            <h2 class="h2">Hospitalizaciones</h2>

            <p class="p">
                Informacion sobre las Hospitalizaciones del paciente.
            </p>
        </header>
        <div class="flex justify-between mt-6 mb-2" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
            <Link :href="route('pacienteHospitalizacion.create',props.patient_id)" as="button" class="btn btn-primary">Crear Nueva Hospitalizacion</Link>
        </div>
        <table class="table mt-3" id="datatable3">
            <thead>
                <tr>
                    <th scope="col">Razon</th>
                    <th scope="col">Fecha</th>
                    <th scope="col" class="text-center" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">Opciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr v-for="hospitalization in props.patient_hospitalizations" :key="hospitalization.id">
                    <td>{{hospitalization.reason}}</td>
                    <td>{{ hospitalization.date }}</td>
                    <td class="text-center" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
                        <Link :href="route('pacienteHospitalizacion.edit', hospitalization.id)"  as="button" class="btn btn-outline-success">Editar</Link>
                        <button @click="confirmPatientDeletion(hospitalization.id)" class="btn btn-outline-danger">Eliminar</button>
                    </td>
                
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="mt-1 text-sm text-gray-600 p-5 text-center">
            El paciente no posee Hospitalizaciones.
            <div class="py-4" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
                <Link :href="route('pacienteHospitalizacion.create',props.patient_id)"  method="get" as="button" class="btn btn-secondary">Actualizar Informacion.</Link>
            </div>
        </p>
    </div>

    <Modal :show="confirmingHospitalizationDeletion" @close="closeModal">
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
                <button class="btn btn-danger" @click="deleteHospitalization">Confirmar</button>
            </div>
        </div>
    </Modal>
</template>