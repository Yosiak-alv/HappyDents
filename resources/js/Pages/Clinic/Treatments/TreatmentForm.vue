<script setup>
    //import { Link} from '@inertiajs/vue3';
    //import InputLabel from "@/Components/InputLabel.vue";
    //import InputError from '@/Components/InputError.vue';
    //import PrimaryButton from '@/Components/PrimaryButton.vue';
    import InputError from "@/Components/InputError.vue";
    defineProps({
        form: {
            type: Object,
            required: true,
        },
        updating: {
            type: Boolean,
            required: false,
            default: false,
        }
    });
    defineEmits(['submit.prevent']);

</script>
<template>
    <div class="container">
        <div class="row">
            <header>
                <h2 class="h3">{{ updating ? 'Editando el Tratamiento' : 'Crear nuevo Tratamiento en el Sistema' }}</h2>
                <p class="p">
                    {{ updating ? 'Edite la Informacion sobre un Tratamiento' : 'Crear nueva Informacion sobre un Tratamiento' }}
                </p>
            </header>
            <form @submit.prevent="$emit('submit.prevent')" class="mt-4">
                <div class="row">
                   <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input v-model="form.name" type="text" class="form-control rounded" id="name" >
                        <InputError class="mt-2" :message="form.errors.name" />
                   </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" id="price" min="0"  step=".01"
                            class="form-control rounded"
                            v-model="form.price"
                            
                        >
                        <InputError class="mt-2" :message="form.errors.price" />
                    </div>
                    <div class="col-12 text-right">
                        <button class="btn btn-primary mt-3" :disabled="form.processing" >{{ updating ? 'Actualizar' : 'Crear' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>
