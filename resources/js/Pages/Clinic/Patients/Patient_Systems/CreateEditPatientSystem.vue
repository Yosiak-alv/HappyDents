<script setup>
    import PatientSystemForm from "./Patient_System_Form/PatientSystemForm.vue";
    import Modal from '@/Components/Modal.vue';
    import { useForm,Head,router } from "@inertiajs/vue3";
    import { ref } from 'vue';
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    const props = defineProps({
        patient:{
            type:Object,
            required:true
        },
        patient_systems:{
            type:Object,
            required:false
        },
        systems:{
            type:Object,
            required:true
        }
    });
    const form = useForm({
        patient_id: props.patient_systems?.patient_id ?? props.patient.id,
        system_id: props.patient_systems ?? [],
    });
    const store = () =>{
        form.post(route('pacienteSistema.store',form.patient_id));
    };
    const update = () => {
        form.patch(route('pacienteSistema.update',form.patient_id));
    };

    //---Modal Section----
    const confirmingSystemDeletion = ref(false);
    
    const confirmSystemDeletion = () => {
        confirmingSystemDeletion.value = true;
    };

    const closeModal = () => {
        confirmingSystemDeletion.value = false;
    };
    
    const deleteSystem = () => {
        router.delete(route('pacienteSistema.remove',props.patient.id),{
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => closeModal(),
        });
    };
</script>
<template>
    <HappyDentsLayout>
        <Head title="Paciente-Sistema"/>
        <div class="container position-absolute top-50 start-50 translate-middle">
            <div class="col-md-12 text-center mb-4">
                <p class="h4">Paciente:</p>
                <p class="p">{{ patient.name}}</p>
            </div>
            <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                <PatientSystemForm :updating="(props.patient_systems === undefined ? false:true)" :patient_id="props.patient.id"
                :form="form" :systems="props.systems" @submit.prevent="(props.patient_systems === undefined ? store() : update())"/>  
                <div class="col-12 text-right">
                    <div v-if="props.patient_systems != null">
                        <button @click="confirmSystemDeletion()" class="btn btn-danger mt-3">
                            Eliminar el Sistema Inmunologico del Paciente
                        </button>
                    </div>
                    <div v-else></div>
                </div>       
            </div>  
        </div>   
    </HappyDentsLayout>

    <Modal :show="confirmingSystemDeletion" @close="closeModal">
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
                <button class="btn btn-danger" @click="deleteSystem">Confirmar</button>
            </div>
        </div>
    </Modal>
</template>
