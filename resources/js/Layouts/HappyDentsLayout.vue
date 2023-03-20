<template>
    <header class="header fixed-top z-3 fw-bold text-white" style="background-color: #00BFFF;">
        <div class="d-flex align-items-center justify-content-between">
            <!--lOGO-->
            <Link :href="route('home')">
                <img src="/img/dents logo.png" class="d-inline-block" alt="Happy Dents" style="height: 80px;">
            </Link>

            <!--NavBAR-->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-2">
                        <div class="fs-5 ">
                            <Link :href="route('pacientes.index')">Consultar Pacientes</Link>
                        </div>
                    </div>
                    <div class="col-2">
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 80px); padding-top: 80px;">
        <div class="container">
            <div class="row py-3">
                <div class="col-md-12">
                    <Flash/>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>

<script setup>
    import Flash from '@/Components/Flash.vue';
    import  {Link} from '@inertiajs/vue3';
</script>

<style scoped>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 16px;
    color: #444;
    background-color: #f7f7f7;
}
</style>
