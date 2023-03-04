<template>
    <header class="header fixed-top z-3 fw-bold text-white" style="background-color: #00BFFF;">
        <div class="d-flex align-items-center justify-content-between">
            <img src="/img/dents logo.png" class="d-inline-block" alt="Happy Dents" style="height: 80px;">
            <div class="d-inline-block col-md-6">
                <div class="fs-5 ">
                <slot name="menu" />
            </div>
            </div>
        </div>
    </header>

    <div class="d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 80px); padding-top: 80px;">
        <div class="container">
            <div class="row py-3">

                    <slot />
            </div>
        </div>

    </div>
</template>

<script setup>
</script>

<style scoped>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 16px;
    color: #444;
    background-color: #f7f7f7;
}
</style>
