<template>
    <Layout>
        <template #menu>
            <a href="registro" class="mx-3">Registrar pacientes</a>
            <a href="#" class="mx-3">Buscar registro</a>
            <a href="#" class="mx-3">Visitas</a>
        </template>
        <div class="container-fluid ">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div>
                    </div>
                    <div class="card ">
                        <div class="card-header bg-primary text-white">Nuevo paciente</div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="codigo_paciente">Código paciente:</label>
                                    <input type="text" class="form-control" id="codigo-paciente" v-model="codigoPaciente">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" v-model="nombre">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="apellido">Apellido:</label>
                                        <input type="text" class="form-control" id="apellido" v-model="apellido">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="genero">Género:</label>
                                    <select class="form-control" id="genero" v-model="genero">
                                        <option value="Hombre">Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección:</label>
                                    <textarea class="form-control" id="direccion" rows="3" v-model="direccion"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="text" class="form-control" id="telefono" v-model="telefono">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ocupacion">Ocupación:</label>
                                        <input type="text" class="form-control" id="ocupacion" v-model="ocupacion">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="telefono2">Teléfono secundario:</label>
                                        <input type="text" class="form-control" id="telefono2" v-model="telefono2">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Correo electrónico:</label>
                                        <input type="email" class="form-control" id="email" v-model="email">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                        <input type="date" class="form-control" id="fecha_nacimiento"
                                            v-model="fechaNacimiento">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="contacto_emergencia">Contacto de emergencia:</label>
                                        <input type="text" class="form-control" id="contacto_emergencia"
                                            v-model="contactoEmergencia">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="telefono_emergencia">Teléfono de contacto de emergencia:</label>
                                        <input type="text" class="form-control" id="telefono_emergencia"
                                            v-model="telefonoEmergencia">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email_emergencia">Correo electrónico de contacto de emergencia:</label>
                                        <input type="email" class="form-control" id="email_emergencia"
                                            v-model="emailEmergencia">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit"
                                        @click.prevent="guardarPaciente()">Guardar</button>
                                    <a href="home" class="btn btn-secondary" type="reset">Cancelar</a>
                                    <a href="antecedente" class="btn btn-primary" @click="siguiente()">Siguiente</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </Layout>
</template>
<script setup>


import Layout from "@/Layouts/HappyDentsLayout.vue";
</script>
<script >

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
</script>

<style scoped>
#codigo-paciente {
    width: 25%;
}

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

