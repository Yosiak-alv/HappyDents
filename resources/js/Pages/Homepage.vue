<template>
    <Layout>
        <div class="col-md-6">
            <img src="/img/dents home.jpg" alt="Happy Dents Clinic" class="img-fluid"/>
        </div>
        <div class="col-md-6">
            <h1>Happy Dents</h1>
            <p>
                Somos una moderna clínica dental ubicada en el corazón de la
                 ciudad. Nuestros dentistas experimentados y nuestro amable personal brindan
                 servicios dentales de alta calidad para pacientes de todas las edades.
                 Ya sea que necesite un chequeo de rutina, un empaste o una
                 procedimiento cosmético, estamos aquí para ayudarle a lograr un
                 sonrisa saludable y hermosa.
            </p>
        </div>

    </Layout>
    <footer class="text-center text-white p-4" style="background-color: #00BFFF;">
            <p>&copy; 2023 Happy Dents. All rights reserved.</p>
            <a href="#" class="mx-3">Privacy Policy</a>
            <a href="#" class="mx-3">Terms of Service</a>
            <a href="#" class="mx-3">Contact Us</a>
        </footer>
</template>

<script setup>
import Layout from "@/Layouts/HappyDentsLayout.vue";
import {Head, router, Link} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import {ref, watch} from "vue";
import {debounce} from "lodash";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
</script>
