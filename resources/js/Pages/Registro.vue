<template>
    <Layout>
        <template #menu>
            <a href="registro" class="mx-3">Registrar pacientes</a>
            <a href="#" class="mx-3">Buscar registro</a>
            <a href="#" class="mx-3">Visitas</a>
        </template>
                <div class="col-12 text-center">
                    <div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">Nuevo paciente</div>
                        <div class="card-body text-center d-flex justify-content-center">
                            <form @submit.prevent="submit">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="mb-3">
                                            <label for="codigo-paciente" class="form-label">Código paciente:</label>
                                            <input type="text" class="form-control" id="codigo-paciente" v-model="codigoPaciente">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" class="form-control" id="nombre" name="name" v-model="form.name">
                                            </div>
                                            <div class="form-group">
                                                <label for="apellido">Apellido:</label>
                                                <input type="text" class="form-control" id="apellido" name="lastname" v-model="form.lastname">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="genero">Género:</label>
                                            <select class="form-control" id="genero" name="genre" v-model="form.genre">
                                                <option value="Hombre">Hombre</option>
                                                <option value="Mujer">Mujer</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group ">
                                                <label for="telefono">Teléfono:</label>
                                                <input type="text" class="form-control" id="telefono" name="phone" v-model="form.phone">
                                            </div>
                                            <div class="form-group ">
                                                <label for="ocupacion">Ocupación:</label>
                                                <input type="text" class="form-control" id="ocupacion" name="occupation" v-model="form.occupation">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                                <input type="date" class="form-control" id="fecha_nacimiento"
                                                    name="birthdate" v-model="form.birthdate">
                                        </div>
                                    </div>
                                    <div class="col-5 offset-2">
                                        <div class="form-group">
                                            <label for="direccion">Dirección:</label>
                                            <textarea class="form-control" id="direccion" rows="4" name="birthdate" v-model="form.birthdate"></textarea>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group ">
                                                <label for="telefono2">Teléfono secundario:</label>
                                                <input type="text" class="form-control" id="telefono2" name="second_phone" v-model="form.second_phone">
                                            </div>
                                            <div class="form-group ">
                                                <label for="email">Correo electrónico:</label>
                                                <input type="email" class="form-control" id="email" name="email" v-model="form.email">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group ">
                                                <label for="contacto_emergencia">Contacto de emergencia:</label>
                                                <input type="text" class="form-control" id="contacto_emergencia"
                                                    name="contact_name" v-model="form.contact_name">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group ">
                                                <label for="telefono_emergencia">Teléfono de contacto de emergencia:</label>
                                                <input type="text" class="form-control" id="telefono_emergencia"
                                                    name="contact_phone" v-model="form.contact_email">
                                            </div>
                                            <div class="form-group ">
                                                <label for="email_emergencia">Correo electrónico de contacto de emergencia:</label>
                                                <input type="email" class="form-control" id="email_emergencia"
                                                    name="contact_email" v-model="form.contact_email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <button class="btn btn-primary" type="submit">Guardar</button>
                                        <a href="home" class="btn btn-secondary mx-3" type="reset">Cancelar</a>
                                        <a href="antecedente" class="btn btn-primary" @click="siguiente()">Siguiente</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

    </Layout>
</template>
<script setup>
import Layout from "@/Layouts/HappyDentsLayout.vue";
import {useForm} from '@inertiajs/vue3';

const form = useForm({
    'name': '',
    'lastname': '',
    'genre': '',
    'phone': '',
    'occupation': '',
    'birthdate': '',
    'second_phone':'',
    'email':'',
    'contact_name':'',
    'contact_phone':'',
    'contact_email':'',
});

const submit = () => {
    form.post(route('post.test'), {
        onSuccess: () => form.reset('direccion'),
    });
};
</script>
<!--<script >

import { defineComponent } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
export default defineComponent({
    data() {
        return {
            codigoPaciente: '',
            nombre: '',
            apellido: '',
            genero: '',
            direccion: '',
            telefono: '',
            ocupacion: '',
            telefono2: '',
            email: '',
            fechaNacimiento: '',
            contactoEmergencia: '',
            telefonoEmergencia: '',
            emailEmergencia: '',
        }
    },
    methods: {
        guardarPaciente() {
            // Save patient data to database
        },
        siguiente() {
            // Navigate to next page
        },

    },
})
</script>-->

<style scoped>

.container-fluid {
    margin-top: 50px;
}

.card {
    margin-top: 20px;
}

.card-header {
    font-size: 1.25rem;
}

.form-control {
    font-size: 1.2rem;
}

.btn {
    font-size: 1.2rem;
    margin-top: 10px;
}

.btn-primary {
    background-color: #008CBA;
    border-color: #008CBA;
}

.btn-primary:hover {
    background-color: #006D8B;
    border-color: #006D8B;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}
</style>

