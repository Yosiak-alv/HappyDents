<script setup>
    import PatientVisitForm from "./Visit_Form/PatientVisitForm.vue";
    import { useForm,Head,Link } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    const props = defineProps({
        patient:{
            type:Object,
            required:true
        },
        patient_visit:{
            type:Object,
            required:false
        },
        treatments:{
            type:Object,
            required:true
        }
    });

    const form = useForm({
        id: props.patient_visit?.id ?? '',
        patient_id: props.patient_visit?.patient_id ?? props.patient.id,
        treatment_id:props.patient_visit?.treatment_id ?? '',
        date:props.patient_visit?.date ?? '',
    });

    const store = () =>{
        form.post(route('pacienteVisitas.store',form.patient_id));
    }
    const update = () => {
        form.patch(route('pacienteVisitas.update',form.id));
    }
</script>
<template>
    <HappyDentsLayout>
        <Head title="Paciente-Visita"/>
            <div class="container position-absolute top-50 start-50 translate-middle">
                <div class="row">
                    <div class="col-md-12 text-center mb-4">
                        <p class="h4">Paciente:</p>
                        <p class="p">{{ patient.name}}</p>
                    </div>
                    <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                        <div v-if="props.treatments != null">
                            <PatientVisitForm :updating="(props.patient_visit == null ? false : true)" :treatments="props.treatments"
                            :form="form" @submit.prevent="(props.patient_visit == null ? store() : update())"/>
                        </div>
                        <div v-else>
                            <p class="mt-1 text-sm text-gray-600 p-5 text-center">
                                Para Crear Visitas necesita crear por lo menos un Tratamiento.
                                <div class="py-4" v-if="usePage().props.auth.user.role.type == 'administrador' ||
                                 usePage().props.auth.user.role.type == 'doctor'">
                                    <Link :href="route('tratamientos.create')"  method="get" as="button" class="btn btn-secondary">Crearlo Ahora.</Link>
                                </div>
                                <div v-else>
                                    Comuniquese con un Doctor o Administrador!.
                                </div>
                            </p>
                        </div>
                        
                    </div>
                </div>
            </div>
    </HappyDentsLayout>

</template>
