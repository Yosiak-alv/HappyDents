<!-- <script setup>
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
    
    <div v-if="flash.type === 'success'" id="alert-border-1"
        class="flex p-4 border-t-4 rounded-lg fixed bottom-3 right-3 dark:bg-dark-500 z-50 text-green-700 bg-green-100 border-green-500" role="alert">
        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <div v-show="showMessage" class="mx-3 text-sm font-lg font-bold">
            {{ flash.message }}
        </div>
    </div>
</template> -->

<script setup>
import {computed, watch} from "vue";
import { usePage } from "@inertiajs/vue3";

let timingOut = false;
const flash = computed(() => usePage().props.flash);
const hideFlash = () => usePage().props.flash.type = null;

const hide = () => {
    if (timingOut === false && flash.value.timeout !== 0) {
        setTimeout(() => {
            timingOut = false;
            hideFlash();
        }, 5000);
        timingOut = true;
    }
};

hide();

watch(flash, () => hide());
</script>

<template>
    <div v-show="flash.type === 'floating'" id="alert-border-1"
        class="flex p-4 border-t-4 rounded-lg fixed bottom-3 right-3 dark:bg-dark-500 z-50" role="alert"
        :class="{
            'text-blue-700 bg-blue-100 border-blue-500': flash.level === 'info' || flash.level === null,
            'text-red-700 bg-red-100 border-red-500': flash.level === 'danger',
            'text-green-700 bg-green-100 border-green-500': flash.level === 'success',
            'text-yellow-700 bg-yellow-100 border-yellow-500': flash.level === 'warning',
        }">
        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <div class="mx-3 text-sm font-lg font-bold">
            {{ flash.message }}
        </div>
        <button type="button" @click="hideFlash"
                class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex h-8 w-8 dark:bg-dark-300 dark:hover:bg-dark-100"
                :class="{
            'bg-blue-100 text-blue-500 focus:ring-blue-400 hover:bg-blue-200': flash.level === 'info' || flash.level === null,
            'bg-red-100 text-red-500 focus:ring-red-400 hover:bg-red-200': flash.level === 'danger',
            'bg-green-100 text-green-500 focus:ring-green-400 hover:bg-green-200': flash.level === 'success',
            'bg-yellow-100 text-yellow-500 focus:ring-yellow-400 hover:bg-yellow-200': flash.level === 'warning',
        }"
                data-dismiss-target="#alert-border-1" aria-label="Close">
            <span class="sr-only">Dismiss</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
</template>
