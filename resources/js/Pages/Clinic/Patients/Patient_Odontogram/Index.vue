<script setup>
    import { Link } from "@inertiajs/vue3";
    const props = defineProps({
        patient_detentions:{
            type:Object
        },
        patient_id:{
            type:Number,
            required:true
        }
    });

</script>



<template>
    <div v-if="patient_detentions.length !== 0 ">
        <header>
            <h2 class="h2">Odontograma</h2>

            <p class="p">
                Informacion sobre el Odontograma del paciente.
            </p>
            <div class="flex justify-between mt-6">
                <Link :href="route('pacienteOdontograma.edit',{patient_id:props.patient_id})" 
                as="button" class="btn btn-primary">Editar Odontograma</Link>
            </div>
        </header>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Codigo Diente</th>
                    <th scope="col">Nombre</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr v-for="odontogram in props.patient_detentions" :key="odontogram.id">
                    <td>{{odontogram.id}}</td>
                    <td>{{ odontogram.name }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="mt-1 text-sm text-gray-600 p-5 text-center">
            El paciente no posee Odontogrma.
            <div class="py-4">
                <Link :href="route('pacienteOdontograma.create',props.patient_id)"  method="get" as="button" class="btn btn-secondary">Actualizar Informacion.</Link>
            </div>
        </p>
    </div>
</template>