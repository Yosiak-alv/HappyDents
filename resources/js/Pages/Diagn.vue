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
            <div class="card-header bg-primary text-white">Diagnóstico de paciente</div>
            <div class="card-body text-center d-flex justify-content-center">
                <form @submit.prevent="submit">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="codigo-paciente" class="form-label">Código paciente:</label>
                                <input type="text" class="form-control" id="codigo-paciente" v-model="codigoPaciente">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="condicion">Observaciones:</label>
                                    <input type="text" class="form-control" id="condicion" name="observaciones"
                                        v-model="form.observations">
                                </div>
                                <div class="form-group">
                                    <label for="parentesco">Diagnóstico:</label>
                                    <input type="text" class="form-control" id="parentesco" name="diagnostico"
                                        v-model="form.diagnostic">
                                </div>
                            </div>
                            <div class="form-group">
                                                <label for="fecha_diagnostico">Fecha de diagnóstico:</label>
                                                <input type="date" class="form-control" id="fecha_diagnostico"
                                                    name="birthdate" v-model="form.date">
                                        </div>
                            <div class="form-group mt-4">
                                        <button class="btn btn-primary" type="submit">Guardar</button>
                                        <a href="registro" class="btn btn-secondary mx-3" type="reset">Cancelar</a>
                                        <a href="home" class="btn btn-primary" @click="siguiente()">Terminar</a>
                                    </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </Layout>
</template>





<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { defineComponent } from 'vue';
import Layout from "@/Layouts/HappyDentsLayout.vue";

const form = useForm({
    'observations': '',
    'diagnostic': '',
    'date': '',

});

const submit = () => {
    form.post(route('post.test'), {
        onSuccess: () => form.reset('direccion'),
    });
};
</script>

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
