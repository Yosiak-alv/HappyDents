<script setup>
    import PatientForm from './Patient_Forms/PatientForm.vue';
    import Modal from '@/Components/Modal.vue';
    import { useForm,Head,usePage,router } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    import { ref } from 'vue';
    const props = defineProps({
        branch_offices:{
            type:Object,
            required:true
        },
        patient:{
            type:Object,
            required:false
        }
    });

    const form = useForm({
        id: props.patient?.id ?? '',
        dui:props.patient?.dui ?? '',
        name:props.patient?.name ?? '',
        lastname:props.patient?.lastname ?? '',
        email:props.patient?.email ?? '',
        phone:props.patient?.phone ?? '',
        second_phone:props.patient?.second_phone ?? '',
        address:props.patient?.address ?? '',
        occupation:props.patient?.occupation ?? '',
        birthdate:props.patient?.birthdate ?? '',
        genre: props.patient?.genre ?? '',
        branch_office_id: props.patient?.branch_office_id ?? '',
        contact_name: props.patient?.contact_name ?? '',
        contact_email: props.patient?.contact_email ?? '',
        contact_phone: props.patient?.contact_phone ?? ''
    });

    //---Modal Section----
    const confirmingPatientDeletion = ref(false);
    
    const confirmPatientDeletion = () => {
        confirmingPatientDeletion.value = true;
    };

    const closeModal = () => {
        confirmingPatientDeletion.value = false;
    };

    const deletePatient = () => {
        router.delete(route('pacientes.destroy',form.id),{
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => closeModal(),
        });
    };

</script>


<template>
     <div v-if="props.patient == null ">
        <HappyDentsLayout>
            <Head title="Pacientes"/>
            <div class="container">
                <div class="row py-4">
                    <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                        <PatientForm class="" 
                        :branch_offices="branch_offices" :form="form" @submit.prevent="form.post(route('pacientes.store'))"/>
                    </div>
                </div>
            </div>
        </HappyDentsLayout>
    </div>
    <div v-else>
        <PatientForm class="" 
        :updating="true" :branch_offices="branch_offices" :form="form" @submit.prevent="form.put(route('pacientes.update',form.id))"/>
    </div>
    <div class="col-12 text-right" v-if="usePage().props.auth.user.role.type == 'administrador' || 
    usePage().props.auth.user.role.type == 'doctor' || usePage().props.auth.user.role.type == 'recepcionista'">
        <button v-if="props.patient != null"
        @click="confirmPatientDeletion()" class="btn btn-danger">Eliminar Paciente</button>
    </div>

    
    <Modal :show="confirmingPatientDeletion" @close="closeModal">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="h4 p-4">
                        Seguro de Eliminar el Registro ?
                    </h4>
                </div>
                <div class="col-12">
                    <p class="p p-4"> 
                        Si lo Elimina, el registro siempre permanecera en el sistema con estado inactivo, considere
                        que otros registros que utilizen este, apareceran vacios, esperando su edicion o restauracion 
                        de este registro.
                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row-reverse border">
            <div class="p-2 ">
                <button class="btn btn-secondary" @click="closeModal">Cancelar</button>
            </div>
            <div class="p-2">
                <button class="btn btn-danger" @click="deletePatient">Confirmar</button>
            </div>
        </div>
    </Modal>
</template>