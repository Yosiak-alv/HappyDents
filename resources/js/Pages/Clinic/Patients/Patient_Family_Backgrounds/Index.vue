<script setup>
    import { Link,router } from "@inertiajs/vue3";
    const props = defineProps({
        patient_family_backgrounds:{
            type:Object,
            required:false
        },
        patient_id:{
            type:Number,
            requierd:true
        }
    });
    const destroy = (id) =>{
        if(confirm('Esta seguro de eliminar el Antecedente Familiar ?')){
            router.delete(route('pacienteAntecedentesFamiliares.destroy',id),)
        }
    };

</script>


<template>
    <div v-if="props.patient_family_backgrounds.length !== 0 ">
        <header>
            <h2 class="h2">Antecedentes Familiares</h2>

            <p class="p">
                Informacion sobre los antecedentes familiares del paciente.
            </p>
        </header>
        <div class="flex justify-between mt-6">
            <Link :href="route('pacienteAntecedentesFamiliares.create',props.patient_id)"  method="get" as="button" class="btn btn-primary">Crear Nuevo Registro</Link>
        </div>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Relacion</th>
                    <th scope="col">Condicion</th>
                    <th scope="col">Sistema Inmunologico</th>
                    <th scope="col" class="text-center">Opciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr v-for="family_background in props.patient_family_backgrounds" :key="family_background.id">
                    <td>{{family_background.relationship}}</td>
                    <td>{{ family_background.condition}}</td>
                    <td>{{family_background.system.name}}</td>
                    <td class="text-center">
                        <Link :href="route('pacienteAntecedentesFamiliares.edit', family_background.id)" as="button"  class="btn btn-outline-success">Editar</Link>
                        <button @click="destroy(family_background.id)" class="btn btn-outline-danger" preserve-scroll>Eliminar</button>                        
                    </td>
                
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="mt-1 text-sm text-gray-600 p-5 text-center">
            El paciente no posee Antecedentes Familiares.
            <div class="py-4">
                <Link :href="route('pacienteAntecedentesFamiliares.create',props.patient_id)"  as="button" class="btn btn-secondary">Actualizar Informacion.</Link>
            </div>
        </p>
    </div>
</template>