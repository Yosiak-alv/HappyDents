<script setup>
    import { router, Link ,usePage} from "@inertiajs/vue3";
    import Modal from '@/Components/Modal.vue';
    import { onMounted,ref } from 'vue';
    import $ from 'jquery';
    import DataTable from 'datatables.net-dt';
    const props = defineProps({
        patient_diagnostics:{
            type:Object
        },
        patient_id:{
            type:Number,
            required:true
        }
    })
    onMounted(() => {
        $('#datatable').DataTable();
    });

    //---Modal Section----
    const confirmingDiagnosticDeletion = ref(false);
    const selectedDiagnostic = ref(0);
    
    const confirmPatientDeletion = (id) => {
        confirmingDiagnosticDeletion.value = true;
        selectedDiagnostic.value = id;
    };

    const closeModal = () => {
        confirmingDiagnosticDeletion.value = false;
    };
    //---Metodos de links
    const create = () =>{
        router.get(route('pacienteDiagnostico.create',props.patient_id),{
            preserveScroll: true,
        });
    };
    const edit = (id) => {
        router.get(route('pacienteDiagnostico.edit',id),{
            preserveScroll: true,
        });
    };
    const deleteDiagnostic = () => {
        router.delete(route('pacienteDiagnostico.destroy',selectedDiagnostic.value),{
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
    <div v-if="props.patient_diagnostics.length !== 0 ">
        <header>
            <h2 class="h2">Diagnosticos</h2>

            <p class="p">
                Informacion sobre diagnosticos del paciente.
            </p>
        </header>
        <div class="flex justify-between mt-6 mb-2" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
            <button @click="create" class="btn btn-primary">Crear Nuevo Diagnostico</button>
        </div>
        <table class="table" id="datatable">
            <thead>
                <tr>
                    <th scope="col">Diagnostico</th>
                    <th scope="col">Observacion</th>
                    <th scope="col">Fecha</th>
                    <th scope="col" class="text-center" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">Opciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr v-for="diagnostic in props.patient_diagnostics" :key="diagnostic.id">
                    <td>{{diagnostic.diagnostic}}</td>
                    <td>{{ diagnostic.observation }}</td>
                    <td>{{diagnostic.date}}</td>
                    <td class="text-center" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
                        <button @click="edit(diagnostic.id)" class="btn btn-outline-success">Editar</button>
                        <button @click="confirmPatientDeletion(diagnostic.id)" class="btn btn-outline-danger ml-3">Eliminar</button>
                    </td>
                
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="mt-1 text-sm text-gray-600 p-5 text-center">
            El paciente no posee Diagnosticos.
            <div class="py-4" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
                <Link :href="route('pacienteDiagnostico.create',props.patient_id)"  method="get" as="button" class="btn btn-secondary">Actualizar Informacion.</Link>
            </div>
        </p>
    </div>

    <Modal :show="confirmingDiagnosticDeletion" @close="closeModal">
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
                <button class="btn btn-danger" @click="deleteDiagnostic">Confirmar</button>
            </div>
        </div>
    </Modal>
</template>