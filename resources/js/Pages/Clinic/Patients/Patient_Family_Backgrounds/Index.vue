<script setup>
    import { Link,router,usePage } from "@inertiajs/vue3";
    import Modal from '@/Components/Modal.vue';
    import { onMounted,ref } from 'vue';
    import $ from 'jquery';
    import DataTable from 'datatables.net-dt';
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
    onMounted(() => {
        $('#datatable2').DataTable();
    });

    //---Modal Section----
    const confirmingAntecedentesDeletion = ref(false);
    const selectedAntecedentes = ref(0);

    const confirmAntecedentesDeletion = (id) => {
        confirmingAntecedentesDeletion.value = true;
        selectedAntecedentes.value = id;
    };

    const closeModal = () => {
        confirmingAntecedentesDeletion.value = false;
    };

    const deleteAntecedentes = () => {
        router.delete(route('pacienteAntecedentesFamiliares.destroy',selectedAntecedentes.value),{
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
    <div v-if="props.patient_family_backgrounds.length !== 0 ">
        <header>
            <h2 class="h2">Antecedentes Familiares</h2>

            <p class="p">
                Informacion sobre los antecedentes familiares del paciente.
            </p>
        </header>
        <div class="flex justify-between mt-6 mb-2" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
            <Link :href="route('pacienteAntecedentesFamiliares.create',props.patient_id)"  method="get" as="button" class="btn btn-primary">Crear Nuevo Registro</Link>
        </div>
        <table class="table mt-3" id="datatable2">
            <thead>
                <tr>
                    <th scope="col">Relacion</th>
                    <th scope="col">Condicion</th>
                    <th scope="col">Sistema Biológico</th>
                    <th scope="col" class="text-center" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">Opciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr v-for="family_background in props.patient_family_backgrounds" :key="family_background.id">
                    <td>{{family_background.relationship}}</td>
                    <td>{{ family_background.condition}}</td>
                    <td>{{family_background.system.name}}</td>
                    <td class="text-center" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
                        <Link :href="route('pacienteAntecedentesFamiliares.edit', family_background.id)" as="button"  class="btn btn-outline-success">Editar</Link>
                        <button @click="confirmAntecedentesDeletion(family_background.id)" class="btn btn-outline-danger ml-3">Eliminar</button>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="mt-1 text-sm text-gray-600 p-5 text-center">
            El paciente no posee Antecedentes Familiares.
            <div class="py-4" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
                <Link :href="route('pacienteAntecedentesFamiliares.create',props.patient_id)"  as="button" class="btn btn-secondary">Actualizar Informacion.</Link>
            </div>
        </p>
    </div>

    <Modal :show="confirmingAntecedentesDeletion" @close="closeModal">
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
                <button class="btn btn-danger" @click="deleteAntecedentes">Confirmar</button>
            </div>
        </div>
    </Modal>
</template>
