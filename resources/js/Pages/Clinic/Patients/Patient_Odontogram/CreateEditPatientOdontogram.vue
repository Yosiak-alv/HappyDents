<script setup>
    import PatientOdontogramForm from './Odontogram_Form/PatientOdontogramForm.vue';
    import { useForm,Head } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    const props = defineProps({
        patient:{
            type:Object,
            required:true
        },
        patient_odontogram_detentions:{
            type:Object,
            required:false
        },
        detentions:{
            type:Object,
            required:true
        }
    });
    const form = useForm({
        patient_id: props.patient_odontogram_detentions?.patient_id ?? props.patient.id,
        detention_id: props.patient_odontogram_detentions ?? [],
    });
    const store = () =>{
        form.post(route('pacienteOdontograma.store',form.patient_id));
    }
    const update = () => {
        form.patch(route('pacienteOdontograma.update',{patient_id:form.patient_id}));
    }
</script>
<template>
    <HappyDentsLayout>
        <Head title="Paciente-Odontograma"/>
        <div class="col-md-12 text-center mb-4">
            <p class="h4">Paciente:</p>
            <p class="p">{{ patient.name}}</p>
        </div>
        <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
            <PatientOdontogramForm :updating="(props.patient_odontogram_detentions === undefined ? false:true)" :patient_id="props.patient.id"
            :form="form" :detentions="props.detentions" @submit.prevent="(props.patient_odontogram_detentions === undefined ? store() : update())"/>         
        </div>            
    </HappyDentsLayout>
</template>
