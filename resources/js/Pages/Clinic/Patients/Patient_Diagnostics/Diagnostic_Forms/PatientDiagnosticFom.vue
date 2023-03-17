<script setup>
    import { Link} from '@inertiajs/vue3';  
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
    });
    defineEmits(['submit.prevent']);

</script>
<template>
    <div class="container">
        <div class="row">
            <header>
                <h2 class="h3">{{ updating ? 'Editar Diagnostico del Paciente' : 'Crear nuevo Diagnostico del Paciente' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion del Diagnostico de un Paciente' : 'Crear nueva Informacion para el Diagnostico de un Paciente' }}
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                    <div class="mb-3">
                        <label for="diagnostic" class="form-label">Diagnostico</label>
                        <textarea id="diagnostic"
                            class="form-control rounded" 
                            v-model="form.diagnostic"
                            required
                        ></textarea>
                        <InputError class="mt-2" :message="form.errors.diagnostic" />
                    </div>
                    <div class="mb-3">
                        <label for="observation" class="form-label">Observaciones</label>
                        <textarea id="observation"
                            class="form-control rounded" 
                            v-model="form.observation"
                            required
                        ></textarea>
                        <InputError class="mt-2" :message="form.errors.observation" />
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha</label>
                        <input type="date" id="date" 
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
