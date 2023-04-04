<script setup>
    import { router, Link ,usePage} from "@inertiajs/vue3";
    import { onMounted } from 'vue';
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
    const destroy = (id) =>{
        if(confirm('Esta seguro de eliminar el Diagnostico ?')){
            router.delete(route('pacienteDiagnostico.destroy',id),)
        }
    };
    onMounted(() => {
        $('#datatable').DataTable();
    });
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
            <Link :href="route('pacienteDiagnostico.create',props.patient_id)" as="button" class="btn btn-primary">Crear Nuevo Diagnostico</Link>
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
                        <Link :href="route('pacienteDiagnostico.edit', diagnostic.id)"  as="button" class="btn btn-outline-success" preserve-scroll>Editar</Link>
                        <button @click="destroy(diagnostic.id)" class="btn btn-outline-danger" preserve-scroll>Eliminar</button>
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
</template>