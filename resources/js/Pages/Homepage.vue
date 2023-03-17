<template>
    <Layout>
        <div class="col-md-6">
            <img src="/img/dents home.jpg" alt="Happy Dents Clinic" class="img-fluid"/>
        </div>
        <div class="col-md-6">
            <h1>Happy Dents</h1>
            <p>
                We are a modern dental clinic located in the heart of the
                city. Our experienced dentists and friendly staff provide
                high-quality dental services for patients of all ages.
                Whether you need a routine check-up, a filling, or a
                cosmetic procedure, we are here to help you achieve a
                healthy and beautiful smile.
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
