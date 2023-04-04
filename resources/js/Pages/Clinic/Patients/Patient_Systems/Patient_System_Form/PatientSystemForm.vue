<script setup>
    import {Link} from '@inertiajs/vue3';  
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
        },
        patient_id:{
            type:Number,
            required:true
        }
    });
    defineEmits(['submit.prevent']);

</script>
<template>
    <div class="container">
        <div class="row">
            <header>
                <h2 class="h3">{{ updating ? 'Editar Sistema Inmunologico del Paciente' : 'Crear nuevo Sistema Unmunologico del Paciente' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion del Sistema Inmunologico de un Paciente' : 'Crear nueva Informacion para el Sistema Inmunologico de un Paciente' }}
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                    <div class="mb-3">
                        <label for="system_id" class="form-label">Sistema Unmunologico</label>
                        <select multiple
                            id="system_id" 
                            class="form-select rounded" 
                            v-model="form.system_id" 
                            required
                        >
                            <option  v-for="system in systems " :value="system.id">
                                {{system.name}}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.system_id" />
                    </div>
                    <div class="col-6 text-left" v-if="usePage().props.auth.user.role.type == 'administrador'
                    || usePage().props.auth.user.role.type == 'doctor'">
                        <div v-if="updating">
                            <Link :href="route('pacienteSistema.remove',patient_id)" as="button"  method="delete" class="btn btn-danger mt-3 ">Eliminar el Sistema Inmunologico del Paciente</Link>
                        </div>
                        <div v-else></div>
                        
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-primary mt-3 " :disabled="form.processing" >{{ updating ? 'Actualizar' : 'Crear' }}</button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</template>
