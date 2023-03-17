<script setup>

    import {Link} from '@inertiajs/vue3';

    const props = defineProps({
        links:{
            type:Array,
            required:true
        }
    })

</script>
<template>

    <div v-if="links.length > 1" class="grid justify-items-center">
        
        <div class="flex flex-wrap mt-8 ">

            <template v-for="(link, key) in links" :key="key">

                <div

                    v-if="link.url === null"

                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"

                     v-html="link.label"
                     preserve-scroll
                />


                <Link

                    v-else

                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-gray-200 text-dark focus:border-primary focus:text-primary"

                    :class="{'bg-gray-500 text-white': link.active, 
                                'bg-white text-dark ': !link.active}"

                    :href="link.url"

                    v-html="link.label" preserve-scroll

                />

            </template>

        </div>
        
    </div>

</template>