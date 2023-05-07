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
        roles:{
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
                <h2 class="h3">{{ updating ? 'Editar Usuario' : 'Crear nuevo Usuario' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion del Usuario' : 'Crear nueva Informacion del Usuario' }}
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control rounded" id="name" v-model="form.name" required>
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="text" class="form-control rounded" id="email" v-model="form.email" required>
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="mb-3" v-if="!updating">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control rounded" id="password" v-model="form.password" required>
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Rol</label>
                        <select 
                            id="role_id" 
                            class="form-select rounded" 
                            v-model="form.role_id" 
                            required
                        >
                            <option  v-for="role in roles " :value="role.id">
                                {{role.type}}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.role_id" />
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary mt-3 " :disabled="form.processing" >{{ updating ? 'Actualizar' : 'Crear' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</template>
