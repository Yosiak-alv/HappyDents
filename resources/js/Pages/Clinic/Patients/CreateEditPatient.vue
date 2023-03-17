<script setup>
    import PatientForm from './Patient_Forms/PatientForm.vue';
    import { useForm,Head } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
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

</script>


<template>
     <div v-if="props.patient == null ">
        <HappyDentsLayout>
            <Head title="Pacientes"/>
            <div class="container">
                <div class="row ">
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
</template>