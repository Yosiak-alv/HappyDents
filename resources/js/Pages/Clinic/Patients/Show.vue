<script setup>
    //import FormRegistro from "@/Pages/Registro.vue";
    import { Head,Link } from "@inertiajs/vue3";
    
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    //Forms e Indexes
    import CreateEditPatient from "./CreateEditPatient.vue";
    import IndexDiagnostics from "./Patient_Diagnostics/Index.vue";
    import IndexOdontogram from "./Patient_Odontogram/Index.vue";
    import IndexHospitalization from "./Patient_Hospitalizations/Index.vue";
    import IndexVisit from "./Patient_Visits/Index.vue";
    import IndexFamilyBack from "./Patient_Family_Backgrounds/Index.vue";
    import IndexSystem from "./Patient_Systems/Index.vue";
    
    const props = defineProps({
        patient:{
            type:Object,
            required:true
        },
        branch_offices:{
            type:Object,
            required:true
        },
    });

    //defineOptions({layout:HappyDentsLayout});


</script>
<script>
    //import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    //export default {

        //layout: HappyDentsLayout

    //}
</script>

<template>
    <HappyDentsLayout>
        <Head title="Pacientes"/>
        <div class="container">
            <div class="row ">
                <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                    <CreateEditPatient :branch_offices="branch_offices" :patient="props.patient"/>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                    <!--falta las relaciones mostrarlas y ya -->
                    <IndexDiagnostics :patient_diagnostics="patient.diagnostics" :patient_id="props.patient.id"/>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                     <!--falta las relaciones mostrarlas y ya -->
                     <div class="row">
                        <div class="col-md-12">
                            <IndexOdontogram :patient_detentions="patient.detentions" :patient_id="props.patient.id"/>
                        </div>
                        
                     </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                     <!--falta las relaciones mostrarlas y ya -->
                     <IndexHospitalization :patient_hospitalizations="patient.hospitalizations" :patient_id="props.patient.id"/>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                     <!--falta las relaciones mostrarlas y ya -->
                    <IndexVisit :patient_visits="patient.visits" :patient_id="props.patient.id"/>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                    <div class="row">
                        <div class="col-md-12">
                            <!--falta las relaciones mostrarlas y ya -->
                            <IndexSystem :patient_systems="patient.systems" :patient_id="props.patient.id"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3 mb-5" >
                     <!--falta las relaciones mostrarlas y ya -->
                     <IndexFamilyBack :patient_family_backgrounds="patient.family_backgrounds" :patient_id="props.patient.id"/>
                </div>
            </div>
            
        </div>
    </HappyDentsLayout>

</template>