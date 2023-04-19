<script setup>
    import {Link,router, usePage} from '@inertiajs/vue3';  
    //import InputLabel from "@/Components/InputLabel.vue";
    //import InputError from '@/Components/InputError.vue';
    //import PrimaryButton from '@/Components/PrimaryButton.vue';
    import InputError from "@/Components/InputError.vue";    
    import { ref,watch,computed } from 'vue';
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
        detentions:{
            type:Object,
            required:true
        },
        conditions:{
            type:Object,
        }
    });
    defineEmits(['submit.prevent']);

</script>
<template>
    <div class="container">
        <div class="row">
            <header>
                <h2 class="h3">{{ updating ? 'Editar Odontograma del Paciente' : 'Crear nuevo Odontograma del Paciente' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion del Odontograma de un Paciente' : 'Crear nueva Informacion para el Odontograma de un Paciente' }}
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6" v-for="(value,index) in detentions" :key="value.id">
                                
                                <input type="checkbox" :value="value.id" v-model="form.detention_id"> {{value.name}}
                                <textarea id="condition"
                                    class="form-control rounded"
                                    v-model="form.condition[index]"
                                ></textarea> 
                               
                               
                            </div>
                            
                          
                        </div>
                       
                        <InputError class="mt-2" :message="form.errors.detention_id" />
                    </div>
                   
                    <div class="col-12 text-right">
                        <button class="btn btn-primary mt-3 " :disabled="form.processing" >{{ updating ? 'Actualizar' : 'Crear' }}</button>
                    </div>
                   
                </div>
            </form>
           
        </div>
    </div>
    
</template>
