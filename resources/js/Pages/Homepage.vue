<template>
    <Layout>
        <Head title="Home"/>
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-3">
                            <div class="card text-center">
                                <div class="card-header bg-info text-white">
                                    <div class="row">
                                        <div class="col ">
                                            <i class="bi bi-file-earmark-person fs-1"></i>
                                        </div>
                                        <div class="col">
                                            <p class="h2">{{props.patients}}
                                            </p>
                                            <p class="h4">Pacientes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card text-center">
                                <div class="card-header bg-info text-white">
                                    <div class="row">
                                        <div class="col ">
                                            <i class="bi bi-calendar-event-fill fs-1"></i>
                                        </div>
                                        <div class="col">
                                            <p class="h2">{{props.visits}}
                                            </p>
                                            <p class="h4">Visitas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card text-center">
                                <div class="card-header bg-info text-white">
                                    <div class="row">
                                        <div class="col ">
                                            <i class="bi bi-eyedropper fs-1"></i>
                                        </div>
                                        <div class="col">
                                            <p class="h2">{{props.treatments}}
                                            </p>
                                            <p class="h4">Tratamientos</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card text-center">
                                <div class="card-header bg-info text-white">
                                    <div class="row">
                                        <div class="col ">
                                            <i class="bi bi-people fs-1"></i>
                                        </div>
                                        <div class="col">
                                            <p class="h2">{{props.users}}
                                            </p>
                                            <p class="h4">Usuarios</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-5">
                    <img src="/storage/img/dents_home.jpg" alt="Happy Dents Clinic" class="img-fluid"/>
                </div>
                <div class="col-md-6 mt-5">
                    <h1 class="h3">Happy Dents</h1>
                    <p>
                        Somos una moderna clínica dental ubicada en el corazón de la
                        ciudad. Nuestros dentistas experimentados y nuestro amable personal brindan
                        servicios dentales de alta calidad para pacientes de todas las edades.
                        Ya sea que necesite un chequeo de rutina, un empaste o una
                        procedimiento cosmético, estamos aquí para ayudarle a lograr un
                        sonrisa saludable y hermosa.
                    </p>
                </div>
            </div>
        </div>
    </Layout>
    <footer class="text-center text-white p-4" style="background-color: #00BFFF;">
        <p>&copy; 2023 Happy Dents. All rights reserved.</p>
        <Link href="#" class="mx-3">Privacy Policy</Link>
        <Link href="#" class="mx-3">Terms of Service</Link>
        <Link href="#" class="mx-3">Contact Us</Link>
    </footer>
</template>

<script setup>
    import Layout from "@/Layouts/HappyDentsLayout.vue";
    import {Head, router, Link} from '@inertiajs/vue3';
  
    const props = defineProps({
        patients:{
            type:Number,
            required:true
        },
        treatments:{
            type:Number,
            required:true
        },
        users:{
            type:Number,
            required:true
        },
        visits:{
            type:Number,
            required:true
        }
    });
</script>
