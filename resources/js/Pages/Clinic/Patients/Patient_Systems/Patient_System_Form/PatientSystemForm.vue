<script setup>
    import {Link,usePage,router} from '@inertiajs/vue3';  
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
                <h2 class="h3">{{ updating ? 'Editar Sistema Inmunologico del Paciente' : 'Crear nuevo Sistema Unmunologico del Paciente' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion del Sistema Inmunologico de un Paciente' : 'Crear nueva Informacion para el Sistema Inmunologico de un Paciente' }}
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                    <div class="mb-3">
                        <div class="row overflow-y-scroll mh-100" style="height: 300px;">
                            <div class="col-6" v-for="(system,index) in systems" :key="system.id">
                                <input type="checkbox" :value="system.id" v-model="form.system_id"> {{system.name}}
                                <textarea id="condition"
                                    class="form-control rounded"
                                    v-model="form.condition[system.id]"
                                    rows="3"
                                ></textarea> 
                                <InputError class="mt-2" :message="form.errors.condition" />
                            </div>
                        </div>
                        <InputError class="mt-2" :message="form.errors.system_id" />
                    </div>
                    <div class="col-12 text-right">
                        <button class="btn btn-primary mt-3 " :disabled="form.processing" >{{ updating ? 'Actualizar' : 'Crear' }}</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    
</template>
