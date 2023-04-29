<script setup>
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    import Modal from '@/Components/Modal.vue';
    import { Link,Head,router,usePage } from '@inertiajs/vue3';
    import { onMounted,ref} from 'vue';
    import $ from 'jquery';
    import DataTable from 'datatables.net-dt';
    const props =  defineProps({
        users:{
            type:Object,
            required:true
        }
    });
    onMounted(() => {
        $('#datatable2').DataTable();
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
        router.delete(route('users.forceDelete',selectedUser.value),{
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
                <div class="p-5 bg-light border rounded-3 mb-5" >
                    <div class="col-md-10 offset-md-1">
                        <h1 class="h1">Usuarios Eliminados</h1>
                    </div>
                    <div class="col-md-10 offset-md-1 ">
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-2">
                                        <Link :href="route('users.index')" as="button" method="get" class="btn btn-primary">Ver Activos</Link>
                                    </div>
                                    <div class="col-2">
                                        <Link  v-if="props.users.length != 0"
                                        :href="route('users.restoreAll')" as="button" method="post" class="btn btn-success">Restaurar Todos</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-3" v-if="props.users.length != 0 ">
                        <table class="table mt-3" id="datatable2" >
                            <thead>
                                <tr>
                                    <th scope="col">Paciente</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Eliminado el</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <tr v-for="user in props.users" :key="user.id">
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{user.role.type}}</td>
                                    <td>{{user.deleted_at}}</td>

                                    <td>
                                        <Link :href="route('users.restore',user.id)" as="button" method="post" class="btn btn-outline-success">Restaurar</Link>
                                        <button 
                                        @click="confirmUserDeletion(user.id)" class="btn btn-outline-danger ml-3">Force-Delete</button>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-10 offset-md-1 mt-3" v-else>
                        <p class="mt-1 text-sm text-gray-600 p-5 text-center">
                            No se han Eliminado Registros.
                        </p>
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
                        Seguro de Eliminar COMPLETAMENTE el Registro ?
                    </h4>
                </div>
                <div class="col-12">
                    <p class="p p-4"> 
                        Si lo Elimina, el registro se borrara PERMANETEMENTE, sin posibilidad de 
                        recuperacion de la informacion del registro, desea continuar ?
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