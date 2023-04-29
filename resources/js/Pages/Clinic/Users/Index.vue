<script setup>

    import { Link,Head,router,usePage } from '@inertiajs/vue3';
    import Modal from '@/Components/Modal.vue';
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    import { onMounted,ref } from 'vue';
    import $ from 'jquery';
    import DataTable from 'datatables.net-dt';
    const props = defineProps({
        users:{
            type:Object,
            requierd:true
        }
    });
    onMounted(() => {
        $('#datatable').DataTable();
    });

    //---Modal Section----
    const confirmingUserDeletion = ref(false);
    const selectedUser = ref(0);
    
    const confirmUserDeletion = (id) => {
        confirmingUserDeletion.value = true;
        selectedUser.value = id;
    };

    const closeModal = () => {
        confirmingUserDeletion.value = false;
    };

    const deleteUser = () => {
        router.delete(route('users.destroy',selectedUser.value),{
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => closeModal(),
        });
    };
</script>
<style>
    @import 'datatables.net-dt';
</style>
<template>
    <HappyDentsLayout>
        <Head title="Usuarios"/>
        <div class="container">
            <div class="row mt-5">
                <div class="p-5 bg-light border rounded-3 " >
                    <div class="col-md-10 offset-md-1">
                        <h1 class="h1">Usuarios</h1>
                    </div>
                    <div class="col-md-10 offset-md-1 ">
                        <div class="row mt-5">
                            <div class="col-2">
                                <Link :href="route('users.create')" as="button" method="get" class="btn btn-primary">Crear Nuevo Usuario</Link>
                            </div>
                            <div class="col-2">
                                <Link :href="route('users.deletedIndex',1)" as="button" method="get" class="btn btn-danger">Usuarios Eliminados</Link>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-4">
                        <table class="table mt-3" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr v-for="user in users.data" :key="user.id">
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{user.role.type}}</td>
                                    <td>
                                        <Link :href="route('users.show',user.id)" :disabled="usePage().props.auth.user.id == user.id"
                                        as="button" method="get" class="btn btn-outline-success">Mostrar</Link>
                                        <button 
                                        @click="confirmUserDeletion(user.id)" :disabled="usePage().props.auth.user.id == user.id"
                                        class="btn btn-outline-danger ml-3">Eliminar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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

