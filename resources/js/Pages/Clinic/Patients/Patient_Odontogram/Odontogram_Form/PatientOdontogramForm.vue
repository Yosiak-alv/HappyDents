<script setup>
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
        detentions:{
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
                <h2 class="h3">{{ updating ? 'Editar Odontograma del Paciente' : 'Crear nuevo Odontograma del Paciente' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion del Odontograma de un Paciente' : 'Crear nueva Informacion para el Odontograma de un Paciente' }}
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                    <div class="mb-3">
                        <div class="row">
                            {{form.condition}}
                            <div class="col-6" v-for="(detention,index) in detentions" :key="detention.id">
                                
                                <input type="checkbox" :value="detention.id" v-model="form.detention_id"> {{detention.name}} 
                                <textarea id="condition"
                                    class="form-control rounded"
                                    v-model="form.condition[detention.id]"
                                ></textarea> 
                                <InputError class="mt-2" :message="form.errors.condition" />
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
