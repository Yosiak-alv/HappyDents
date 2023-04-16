<script setup>
    //import { Link} from '@inertiajs/vue3';
    //import InputLabel from "@/Components/InputLabel.vue";
    //import InputError from '@/Components/InputError.vue';
    //import PrimaryButton from '@/Components/PrimaryButton.vue';
    import InputError from "@/Components/InputError.vue";
    import { nextTick, ref,reactive } from 'vue';
    defineProps({
        form: {
            type: Object,
            required: true,
        },
        updating: {
            type: Boolean,
            required: false,
            default: false,
        },
        treatments:{
            type:Object,
            required:true
        },
        patients:{
            type:Object,
            required:true
        },
    });
    defineEmits(['submit.prevent']);
   
  
</script>
<template>
    <div class="container">
        <div class="row">
            <header>
                <h2 class="h3">{{ updating ? 'Editar Visita' : 'Crear nueva Visita' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion sobre la Visita' : 'Crear nueva Informacion sobre la Visita' }}
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Pacientes</label>
                            <select
                                id="patient_id"
                                class="form-select rounded"
                                v-model="form.patient_id"
                                required
                            >
                                <option  v-for="value in patients" :value="value.id">
                                    {{value.name}}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.patient_id" />
                    </div>
                    <div class="mb-3">
                        <label for="treatment_id" class="form-label">Tratamiento</label>
                            <select
                                id="treatment_id"
                                class="form-select rounded"
                                v-model="form.treatment_id"
                                required
                            >
                                <option  v-for="value in treatments" :value="value.id">
                                    {{value.name}} , Precio: {{value.price}}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.treatment_id" />
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha</label>
                        <input type="datetime-local" id="date"
                                class="form-control rounded"
                            v-model="form.date" required>
                        <InputError class="mt-2" :message="form.errors.date" />
                    </div>
                    <div class="col-12 text-right">
                        <button class="btn btn-primary mt-3" :disabled="form.processing" >{{ updating ? 'Actualizar' : 'Crear' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>
