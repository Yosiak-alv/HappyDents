<script setup>
    import { Link } from "@inertiajs/vue3";
    const props = defineProps({
        patient_systems:{
            type:Object
        },
        patient_id:{
            type:Number,
            requierd:true
        }
    })

</script>


<template>
    <div v-if="props.patient_systems.length !== 0 ">
        <header>
            <h2 class="h2">Sistema Afectado</h2>

            <p class="p">
                Informacion sobre el sistema biológico afectado del paciente.
            </p>
        </header>
        <div class="flex justify-between mt-6">
            <Link :href="route('pacienteSistema.edit',props.patient_id)"
                as="button" class="btn btn-primary">Editar Sistema Afectado</Link>
        </div>
        <table class="table mt-3 text-center">
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Sistema Afectado</th>
                </tr>
            </thead>
            <tbody class="table-group-divider ">
                <tr v-for="system in props.patient_systems" :key="system.id">
                    <td>{{system.id}}</td>
                    <td>{{system.name}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="mt-1 text-sm text-gray-600 p-5 text-center">
            El paciente no posee condición en su sistema.
            <div class="py-4">
                <Link :href="route('pacienteSistema.create',props.patient_id)"  method="get" as="button" class="btn btn-secondary">Actualizar Informacion.</Link>
            </div>
        </p>
    </div>
</template>
