<script setup>
    import PatientDiagnosticForm from './Diagnostic_Forms/PatientDiagnosticFom.vue';
    import { useForm,Head } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    const props = defineProps({
        patient:{
            type:Object,
            required:true
        },
        patient_diagnostic:{
            type:Object,
            required:false
        }
    });

    const form = useForm({
        id: props.patient_diagnostic?.id ?? '',
        patient_id: props.patient_diagnostic?.patient_id ?? props.patient.id,
        diagnostic:props.patient_diagnostic?.diagnostic ?? '',
        observation:props.patient_diagnostic?.observation ?? '',
        date:props.patient_diagnostic?.date ?? '',
    });
</script>
<template>
    <HappyDentsLayout>
        <Head title="Paciente-Diagnostico"/>
            <div class="container position-absolute top-50 start-50 translate-middle">
                <div class="row">
                    <div v-if="props.patient_diagnostic == null">
                        <div class="col-md-12 text-center mb-4">
                            <p class="h4">Paciente:</p>
                            <p class="p">{{ patient.name}}</p>
                        </div>
                        <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                            
                            <PatientDiagnosticForm :form="form" @submit.prevent="form.post(route('pacienteDiagnostico.store',form.patient_id),{preserveScroll:true})"/>
                        </div>
                    </div>
                    <div v-else>
                        <div class="col-md-12 text-center mb-4">
                                <p class="h4">Paciente:</p>
                                <p class="p">{{ patient.name}}</p>
                        </div>    
                        <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                            <PatientDiagnosticForm :updating="true" :form="form" @submit.prevent="form.patch(route('pacienteDiagnostico.update',form.id),{preserveScroll:true})"/>
                        </div>
                    </div>
                    
                </div>
            </div>
    </HappyDentsLayout>

</template>
