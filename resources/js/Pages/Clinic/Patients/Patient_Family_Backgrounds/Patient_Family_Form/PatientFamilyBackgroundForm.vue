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
        systems:{
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
                <h2 class="h3">{{ updating ? 'Editar Antecedente Familiar del Paciente' : 'Crear nuevo Antecedente Familiar del Paciente' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion del Antecedente Familiar de un Paciente' : 'Crear nueva Informacion para el Antecedente Familiar de un Paciente' }}
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                    <div class="mb-3">
                        <label for="relationship" class="form-label">Relacion</label>
                        <input type="text" id="relationship"  
                            class="form-control rounded" 
                            v-model="form.relationship"
                            required
                        >
                        <InputError class="mt-2" :message="form.errors.relationship" />
                    </div>
                    <div class="mb-3">
                        <label for="condition" class="form-label">Condicion</label>
                        <textarea id="condition"
                            class="form-control rounded" 
                            v-model="form.condition"
                            required
                        ></textarea>
                        <InputError class="mt-2" :message="form.errors.condition" />
                    </div>
                    <div class="mb-3">
                        <label for="system_id" class="form-label">Sistema Inmunologico</label>
                            <select
                                id="system_id" 
                                class="form-select rounded" 
                                v-model="form.system_id" 
                                required
                            >
                                <option  v-for="value in systems" :value="value.id">
                                    {{value.name}}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.system_id" />
                    </div>
                    <div class="col-12 text-right">
                        <button class="btn btn-primary mt-3" :disabled="form.processing" >{{ updating ? 'Actualizar' : 'Crear' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</template>
