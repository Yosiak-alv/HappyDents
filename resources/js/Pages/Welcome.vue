<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    canLogin:Boolean,
    canRegister:Boolean
});
</script>

<template>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link
                v-if="$page.props.auth.user"
                :href="route('home')"
                class="text-sm text-white underline"
                >Home</Link
            >

            <template v-else>
                <Link :href="route('login')" class="ml-4 text-sm text-white underline">Log in</Link>

            </template>
        </div>
        <div
        class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center"
        >
            <div class="content text-center">
                <h1 class="text-white h1">Happy Dents</h1>
                <p class="text-white p"> El mejor lugar para tu sonrisa xd</p>
            </div>
        </div>
    </div>
</template>

<style>
    .banner-image {
        background: linear-gradient(to top, rgba(132, 142, 199, 0.52), rgba(53, 59, 92, 0.73)),
        url('storage/img/welcome.jpg');
        background-size: cover;
    }

</style>