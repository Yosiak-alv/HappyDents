<template>
<Layout>
<template #menu>
            <a href="registro" class="mx-3">Registrar pacientes</a>
            <a href="#" class="mx-3">Buscar registro</a>
            <a href="#" class="mx-3">Visitas</a>
        </template>
        <div class="form-container">

                <div class="form-group">
                    <div class="card-header bg-primary text-white">Antecedentes de paciente</div>
                    <label for="codigo-paciente">Código Paciente</label>
                    <input type="text" id="codigo-paciente" v-model="form.codigoPaciente" />
                </div>
                <div class="form-group">
                    <label for="sistema-afectado">Sistema Afectado</label>
                    <select id="sistema-afectado" v-model="form.sistemaAfectado">
                        <option value="Sistema Nervioso">Sistema Nervioso</option>
                        <option value="Sistema Endocrino">Sistema Endocrino</option>
                        <option value="Sistema Circulatorio">Sistema Circulatorio</option>
                        <option value="Sistema Digestivo">Sistema Digestivo</option>
                        <option value="Sistema Respiratorio">Sistema Respiratorio</option>
                        <option value="Sistema Excretor">Sistema Excretor</option>
                        <option value="Sistema Reproductor">Sistema Reproductor</option>
                        <option value="Sistema Muscular">Sistema Muscular</option>
                        <option value="Sistema Esquelético">Sistema Esquelético</option>
                        <option value="Sistema Inmunológico">Sistema Inmunológico</option>
                        <option value="Sistema Linfático">Sistema Linfático</option>
                        <option value="Sistema Integumentario">Sistema Integumentario</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="condicion">Condición</label>
                    <input type="text" id="condicion" v-model="form.condicion" />
                </div>
                <div class="form-group">
                    <label for="parentesco">Parentesco</label>
                    <input type="text" id="parentesco" v-model="form.parentesco" />
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <a href="registro" type="cancelar" class="btn btn-secondary">Cancelar</a>
                    <a href="hosp" type="button" class="btn btn-primary" @click="goToNextPage">Siguiente</a>
                </div>

        </div>
    </Layout>

</template>




<script generic>
import { useForm } from '@inertiajs/inertia-vue3';

import { defineComponent } from 'vue'
export default {
    setup() {
        const { data: form, post } = useForm({
            codigoPaciente: "",
            sistemaAfectado: "",
            condicion: "",
            parentesco: "",
        });
        function submitForm() {
            post(route("submit-patient-form"), form);
        }
        function goToNextPage() {
            // navigate to the next page using the Vue Router
        }
        return {
            form,
            submitForm,
            goToNextPage,
        };
    },

};
</script>

<style scoped>
#codigo-paciente {
    width: 25%;
}

.form-container {
    max-width: 600px;
    margin: 0 auto;
    margin-top: 50px;
}

.form-group {
    margin-bottom: 1rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
}

input[type="text"],
select {
    width: 100%;
    padding: 0.5rem;
    font-size: 1rem;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

input[type="text"]:focus,
select:focus {
    outline: none;
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.button-group {
    margin-top: 1rem;
}

.btn {
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: #f8f9fa;
    border: 1px solid #f8f9fa;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
        border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    cursor: pointer;
}

.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
}

.btn-secondary {
    color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-secondary:hover {
    color: #fff;
    background-color: #5a6268;
    border-color: #545b62;
}
</style>
