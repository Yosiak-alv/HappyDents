<script setup>
    import PatientHospitalizationForm from './Hospitalization_Forms/PatientHospitalizationForm.vue';
    import { useForm,Head } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    const props = defineProps({
        patient:{
            type:Object,
            required:true
        },
        patient_hospitalization:{
            type:Object,
            required:false
        }
    });

    const form = useForm({
        id: props.patient_hospitalization?.id ?? '',
        patient_id: props.patient_hospitalization?.patient_id ?? props.patient.id,
        reason:props.patient_hospitalization?.reason ?? '',
        date:props.patient_hospitalization?.date ?? '',
    });
</script>
<template>
    <HappyDentsLayout>
        <Head title="Paciente-Hospitalizacion"/>
            <div class="container position-absolute top-50 start-50 translate-middle">
                <div class="row">
                    <div v-if="props.patient_hospitalization == null">
                        <div class="col-md-12 text-center mb-4">
                            <p class="h4">Paciente:</p>
                            <p class="p">{{ patient.name}}</p>
                        </div>
                        <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                            
                            <PatientHospitalizationForm :form="form" @submit.prevent="form.post(route('pacienteHospitalizacion.store',form.patient_id))"/>
                        </div>
                    </div>
                    <div v-else>
                        <div class="col-md-12 text-center mb-4">
                                <p class="h4">Paciente:</p>
                                <p class="p">{{ patient.name}}</p>
                        </div>    
                        <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                            <PatientHospitalizationForm :updating="true" :form="form" @submit.prevent="form.patch(route('pacienteHospitalizacion.update',form.id))"/>
                        </div>
                    </div>
                    
                </div>
            </div>
    </HappyDentsLayout>

</template>
