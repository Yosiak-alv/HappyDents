<script setup>
    import TreatmentForm from "./TreatmentForm.vue";
    import { useForm,Head } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    const props = defineProps({
        treatment:{
            type:Object,
            required:false
        }
    });

    const form = useForm({
        id: props.treatment?.id ?? '',
        name:props.treatment?.name ?? '',
        price:props.treatment?.price ?? ''

    });

    const store = () =>{
        form.post(route('tratamientos.store'));
    }
    const update = () => {
        form.patch(route('tratamientos.update',form.id));
    }

</script>


<template>

    <HappyDentsLayout>
        <Head title="Tratamientos"/>
        <div class="container position-absolute top-50 start-50 translate-middle">
            <div class="row">
                <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                    <TreatmentForm :updating="(props.treatment == null ? false: true)" 
                    :form="form" @submit.prevent="(props.treatment == null ? store() : update())"/>
                </div>
            </div>
        </div>
    </HappyDentsLayout>
</template>