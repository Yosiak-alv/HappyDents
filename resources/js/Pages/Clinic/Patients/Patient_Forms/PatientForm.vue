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
        branch_offices:{
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
                <h2 class="h3">{{ updating ? 'Editar Paciente' : 'Crear nuevo Paciente' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion del Paciente' : 'Crear nueva Informacion para el Paciente' }}, ( atributos con * son obligatorios ).
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="mb-3">
                            <label for="dui" class="form-label">Dui*</label>
                            <input type="text" name="dui" class="form-control rounded" id="dui" v-model="form.dui" required>
                            <InputError class="mt-2" :message="form.errors.dui" />
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombres*</label>
                            <input v-model="form.name" type="text" class="form-control rounded" id="name" required>
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Apellidos*</label>
                            <input v-model="form.lastname" type="text" class="form-control rounded" id="lastname" required>
                            <InputError class="mt-2" :message="form.errors.lastname" />
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genero*</label>
                            <select
                                id="genre" 
                                class="form-select rounded" 
                                v-model="form.genre" 
                                required
                            >
                                <option  v-for="value in [{'id':'Hombre','name':'Hombre'},{'id':'Mujer','name':'Mujer'}]" :value="value.id">
                                    {{value.name}}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.genre" />
                        </div>
                        <div class="mb-3">
                            <label for="branch_office_id" class="form-label">Sucursal*</label>
                            <select
                                id="branch_office_id" 
                                class="form-select rounded" 
                                v-model="form.branch_office_id" 
                                required
                            >
                                <option  v-for="value in branch_offices" :value="value.id">
                                    {{value.name}}
                                </option>
                            </select>
                            <InputError class="mt-2" :message="form.errors.branch_office_id" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo*</label>
                            <input v-model="form.email" type="email" class="form-control rounded" id="email" required>
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefono*</label>
                            <input v-model="form.phone" type="text" class="form-control rounded" id="phone" required>
                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>
                        
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="second_phone" class="form-label">Telefono Secundario</label>
                            <input v-model="form.second_phone" type="text" class="form-control rounded" id="second_phone">
                            <InputError class="mt-2" :message="form.errors.second_phone" />
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Direccion*</label>
                            <textarea id="address"
                                class="form-control rounded" 
                                v-model="form.address"
                                required
                            ></textarea>
                            <InputError class="mt-2" :message="form.errors.address" />
                        </div>
                        <div class="mb-3">
                            <label for="occupation" class="form-label">Ocupacion*</label>
                            <input v-model="form.occupation" type="text" class="form-control rounded" id="occupation" required>
                            <InputError class="mt-2" :message="form.errors.occupation" />
                        </div>
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">Fecha de Nacimiento*</label>
                            <input type="date" id="birthdate" 
                                class="form-control rounded"
                            v-model="form.birthdate">
                            <InputError class="mt-2" :message="form.errors.birthdate" />
                        </div>
                        <div class="mb-3">
                            <label for="contact_name" class="form-label">Nombre de Contacto</label>
                            <input v-model="form.contact_name" type="text" class="form-control rounded" id="contact_name">
                            <InputError class="mt-2" :message="form.errors.contact_name" />
                        </div>
                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Numero de Contacto</label>
                            <input v-model="form.contact_phone" type="text" class="form-control rounded" id="contact_phone">
                            <InputError class="mt-2" :message="form.errors.contact_phone" />
                        </div>
                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Correo de Contacto</label>
                            <input v-model="form.contact_email" type="text" class="form-control rounded" id="contact_email">
                            <InputError class="mt-2" :message="form.errors.contact_email" />
                        </div>            

                    </div>

                    <div class="col-12 text-right">
                        <button class="btn btn-primary mt-3" :disabled="form.processing">{{ updating ? 'Actualizar' : 'Crear' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</template>
