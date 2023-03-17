<script setup>
    import { usePage } from '@inertiajs/vue3';
    import { computed, ref, watch } from 'vue';
    const flash = computed(() => usePage().props.flash);
    const showMessage = ref(false);

    watch(flash, () => {
        if (flash.type !== null) {
            showMessage.value = true;
        }
        setTimeout(() => showMessage.value = false, 5000);
    });
</script>


<template>
    <div v-if="flash.type">
        <div v-show="showMessage">
            <p class="alert alert-success" role="alert">
                {{flash.message }}
            </p> 
        </div>
    </div>
    
    
</template>