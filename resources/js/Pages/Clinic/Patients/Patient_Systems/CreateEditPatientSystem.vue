<script setup>
    import PatientSystemForm from "./Patient_System_Form/PatientSystemForm.vue";
    import { useForm,Head } from "@inertiajs/vue3";
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
    }
    const update = () => {
        form.patch(route('pacienteSistema.update',form.patient_id));
    }
</script>
<template>
    <HappyDentsLayout>
        <Head title="Paciente-Sistema"/>
        <div class="col-md-12 text-center mb-4">
            <p class="h4">Paciente:</p>
            <p class="p">{{ patient.name}}</p>
        </div>
        <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
            <PatientSystemForm :updating="(props.patient_systems === undefined ? false:true)" :patient_id="props.patient.id"
            :form="form" :systems="props.systems" @submit.prevent="(props.patient_systems === undefined ? store() : update())"/>         
        </div>            
    </HappyDentsLayout>
</template>
