<script setup>
    import PatientFamilyBacgroundForm from "./Patient_Family_Form/PatientFamilyBackgroundForm.vue";
    import { useForm,Head } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    const props = defineProps({
        patient:{
            type:Object,
            required:true
        },
        patient_family_background:{
            type:Object,
            required:false
        },
        systems:{
            type:Object,
            required:true
        }
    });

    const form = useForm({
        id: props.patient_family_background?.id ?? '',
        patient_id: props.patient_family_background?.patient_id ?? props.patient.id,
        system_id:props.patient_family_background?.system_id ?? '',
        relationship:props.patient_family_background?.relationship ?? '',
        condition:props.patient_family_background?.condition ?? '',
    });

    const store = () =>{
        form.post(route('pacienteAntecedentesFamiliares.store',form.patient_id));
    }
    const update = () => {
        form.patch(route('pacienteAntecedentesFamiliares.update',form.id));
    }
</script>
<template>
    <HappyDentsLayout>
        <Head title="Paciente-Antecedentes-Familiares"/>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center mb-4">
                        <p class="h4">Paciente:</p>
                        <p class="p">{{ patient.name}}</p>
                    </div>
                    <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                        <PatientFamilyBacgroundForm :updating="(props.patient_family_background == null ? false : true)" :systems="props.systems"
                        :form="form" @submit.prevent="(props.patient_family_background == null ? store() : update())"/>
                    </div>
                </div>
            </div>

    </HappyDentsLayout>

</template>
