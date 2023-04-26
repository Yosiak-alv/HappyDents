<script setup>
import { Head,Link,router } from "@inertiajs/vue3";
import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
const props = defineProps({
    user:{
        type:Object,
        required:true
    }
});
const destroy = (id) =>{
        if(confirm('Esta seguro de eliminar el Usuario ' + props.user.name + ' ?')){
            router.delete(route('users.destroy',id),)
        }
    };

//---Modal Section----
const confirmingUserDeletion = ref(false);

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
};

const deleteUser = () => {
    router.delete(route('users.destroy',props.user.id),{
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => closeModal(),
    });
};
</script>

<template>
    <HappyDentsLayout>
        <Head title="Usuarios"/> 
        <div class="container mt-5">
            <div class="row p-5 bg-light border rounded-3">
                <div class="col-3" align="center">
                    <img src="/storage/img/user_account.png" alt="User Image" height="312" width="312">
                </div>
                <div class="col-7">
                    <div class="mt-4 fs-5">
                        <p class="mb-3">Name: {{user.name}}</p>
                        <p class="mb-3">Email: {{user.email}}</p>
                        <p class="mb-3">Rol: {{user.role.type}}</p>
                        <div class="col-12 mt-5">
                            <div class="row">
                                <div class="col-6">
                                    <p>Created :{{user.created_at}}</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p>Last Updated: {{user.updated_at}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 mx-auto mt-5">
                    <Link :href="route('users.edit',user.id)" as="button" method="get" class="btn btn-outline-success mt-5">Edit</Link><br>
                    <Link :href="route('users.resetPassword',user.id)" as="button" method="get" class="btn btn-outline-danger  mt-3">Reset Password</Link>
                    <button 
                    @click="confirmUserDeletion()"
                    class="btn btn-outline-danger mt-3">Eliminar</button>
                </div>
            </div>
        </div>
    </HappyDentsLayout>

    <Modal :show="confirmingUserDeletion" @close="closeModal">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="h4 p-4">
                        Seguro de Eliminar el Registro ?
                    </h4>
                </div>
                <div class="col-12">
                    <p class="p p-4"> 
                        Si lo Elimina, el registro siempre permanecera en el sistema con estado inactivo, considere
                        que otros registros que utilizen este, apareceran vacios, esperando su edicion o restauracion 
                        de este registro.
                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex flex-row-reverse border">
            <div class="p-2 ">
                <button class="btn btn-secondary" @click="closeModal">Cancelar</button>
            </div>
            <div class="p-2">
                <button class="btn btn-danger" @click="deleteUser">Confirmar</button>
            </div>
        </div>
    </Modal>

</template>