<script setup>
    import { Link,usePage,router } from "@inertiajs/vue3";
    import { onMounted,ref } from 'vue';
    import $ from 'jquery';
    import DataTable from 'datatables.net-dt';
    const props = defineProps({
        patient_systems:{
            type:Object
        },
        patient_id:{
            type:Number,
            requierd:true
        }
    })
    onMounted(() => {
        $('#datatable5').DataTable();
    });


</script>
<style>
    @import 'datatables.net-dt';
</style>

<template>
    <div v-if="props.patient_systems.length !== 0 ">
        <header>
            <h2 class="h2">Sistema Afectado</h2>

            <p class="p">
                Informacion sobre el sistema biológico afectado del paciente.
            </p>
        </header>
        <div class="flex justify-between mt-6 mb-2" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
            <Link :href="route('pacienteSistema.edit',props.patient_id)"
                as="button" class="btn btn-primary">Editar Sistema Afectado</Link>
        </div>
        <table class="table mt-3 " id="datatable5"> 
            <thead>
                <tr>
                    <th scope="col">Sistema Afectado</th>
                    <th scope="col">Condicion</th>
                </tr>
            </thead>
            <tbody class="table-group-divider ">
                <tr v-for="system in props.patient_systems" :key="system.id">
                    <td>{{system.name}}</td>
                    <td>{{system.pivot.condition}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="mt-1 text-sm text-gray-600 p-5 text-center">
            El paciente no posee condición en su sistema.
            <div class="py-4" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
                <Link :href="route('pacienteSistema.create',props.patient_id)"  method="get" as="button" class="btn btn-secondary">Actualizar Informacion.</Link>
            </div>
        </p>
    </div>

   
</template>
