<script setup>
    import VisitForm from "./VisitForm.vue";
    import { useForm,Head,Link } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    const props = defineProps({
        patients:{
            type:Object,
            required:true
        },
        treatments:{
            type:Object,
            required:true
        },
        visit:{
            type:Object,
            required:false
        }
    });

    const form = useForm({
        id: props.visit?.id ?? '',
        patient_id: props.visit?.patient_id ?? '',
        treatment_id:props.visit?.treatment_id ?? '',
        date:props.visit?.date ?? '',
    });

    const store = () =>{
        form.post(route('visitas.store'));
    }
    const update = () => {
        form.patch(route('visitas.update',form.id));
    }
</script>
<template>
    <HappyDentsLayout>
        <Head title="Visitas"/>
            <div class="container position-absolute top-50 start-50 translate-middle">
                <div class="row">
                    <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                        <div v-if="props.treatments != null || props.patients != null">
                            <VisitForm :updating="(props.visit == null ? false : true)" :treatments="props.treatments" :patients="props.patients"
                            :form="form" @submit.prevent="(props.visit == null ? store() : update())"/>
                        </div>
                        <div v-else>
                            <p class="mt-1 text-sm text-gray-600 p-5 text-center">
                                Para Crear Visitas necesita crear por lo menos un Tratamiento o un Paciente.
                                <div v-if="props.treatments == null">
                                    <div class="py-4" v-if="usePage().props.auth.user.role.type == 'administrador' ||
                                    usePage().props.auth.user.role.type == 'doctor'">
                                        <Link :href="route('tratamientos.create')"  method="get" as="button" class="btn btn-secondary">Crearlo Ahora.</Link>
                                    </div>
                                    <div v-else>
                                        Comuniquese con un Doctor o Administrador!.
                                    </div>
                                </div>
                                <div v-else-if="props.patients == null">
                                    <div class="py-4" v-if="usePage().props.auth.user.role.type != 'asistente dental'">
                                        <Link :href="route('pacientes.create')"  method="get" as="button" class="btn btn-secondary">Crearlo Ahora.</Link>
                                    </div>
                                    <div v-else>
                                        Comuniquese con un Doctor, Administrador o Recepcionista!.
                                    </div>
                                </div>
                            </p>
                        </div>
                        
                    </div>
                </div>
            </div>
    </HappyDentsLayout>

</template>
