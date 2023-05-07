<script setup>
    import { ref } from 'vue';
    import { Link,useForm,Head } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    import InputError from "@/Components/InputError.vue";    
    const props = defineProps({
        user:{
            type:Object,
            required:true
        }
    });

    const form = useForm({
        password: '',
        password_confirmation: '',
    });

    const updatePassword = () => {
        if(form.password == form.password_confirmation){
            form.patch(route('users.updatePassword',props.user.id), {
                onError: () => {
                    form.reset()
                },
            });
        }else{
            alert("Las passwords deben coincidir.");
        }
        
    };
</script>

<template>
    <HappyDentsLayout>
        <Head title="Usuarios"/>
        <div class="container mt-5">
            <div class="row p-5 bg-light border rounded-3">
                <header>
                    <h2 class="h3">Reset Password</h2>
                    <p class="p">
                        Puede resetear la contraseña del usuario seleccionado.
                    </p>
                </header>
                <form @submit.prevent="updatePassword()" class="mt-4">
                    <div class="row">
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password"  class="form-control rounded" id="password" v-model="form.password" required>
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control rounded" id="password_confirmation" v-model="form.password_confirmation" required>
                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>
                        <div class="col-12 text-right">
                            <button class="btn btn-primary mt-3 " :disabled="form.processing" >Resetear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </HappyDentsLayout>    
</template>