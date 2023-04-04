<script setup>
    import { router,Link,usePage} from "@inertiajs/vue3";
    import { onMounted } from 'vue';
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
    const destroy = (id) =>{
        if(confirm('Esta seguro de eliminar la Hospitalizacion?')){
            router.delete(route('pacienteHospitalizacion.destroy',id),)
        }
    };
    onMounted(() => {
        $('#datatable3').DataTable();
    });
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
                        <button @click="destroy(hospitalization.id)" class="btn btn-outline-danger" preserve-scroll>Eliminar</button>
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
</template>