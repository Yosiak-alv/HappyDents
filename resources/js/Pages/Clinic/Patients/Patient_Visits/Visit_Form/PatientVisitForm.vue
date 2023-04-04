<script setup>
    //import { Link} from '@inertiajs/vue3';
    //import InputLabel from "@/Components/InputLabel.vue";
    //import InputError from '@/Components/InputError.vue';
    //import PrimaryButton from '@/Components/PrimaryButton.vue';
    import InputError from "@/Components/InputError.vue";
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
        }
    });
    defineEmits(['submit.prevent']);

</script>
<template>
    <div class="container">
        <div class="row">
            <header>
                <h2 class="h3">{{ updating ? 'Editar Visita del Paciente' : 'Crear nueva Visita del Paciente' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion sobre la Visita de un Paciente' : 'Crear nueva Informacion sobre la Visita de un Paciente' }}
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                    <div class="mb-3">
                        <label for="treatment_id" class="form-label">Tratamiento</label>
                            <select
                                id="treatment_id"
                                class="form-select rounded"
                                v-model="form.treatment_id"
                                required
                            >
                                <option  v-for="value in treatments" :value="value.id">
                                    {{value.name}}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.system_id" />
                    </div>
                    <div class="mb-3">
                        <label for="payment" class="form-label">Pago</label>
                        <input type="number" id="payment" min="0"  step=".01"
                            class="form-control rounded"
                            v-model="form.payment"
                            required
                        >
                        <InputError class="mt-2" :message="form.errors.payment" />
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha</label>
                        <input type="datetime" id="date"
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
