<script setup>
    import { Link,usePage } from "@inertiajs/vue3";
    import { onMounted } from 'vue';
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
                        <Link :href="route('pacienteVisitas.edit',visit.id)"  as="button" method="get" class="btn btn-outline-success">Editar</Link>
                        <!--<Link  as="button" method="get" class="btn btn-outline-danger">Eliminar</Link>-->
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
</template>