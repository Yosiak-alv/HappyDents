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

</script>
<style>
    @import 'datatables.net-dt';
</style>
<template>
    <HappyDentsLayout>
        <Head title="Usuarios"/>
        <div class="container">
            <div class="row mt-5 mb-5">
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
                                <tr v-for="user in users" :key="user.id">
                                    <td>{{user.name}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{user.role.type}}</td>
                                    <td>
                                        <Link :href="route('users.show',user.id)" :disabled="usePage().props.auth.user.id == user.id"
                                        as="button" method="get" class="btn btn-outline-success">Mostrar</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </HappyDentsLayout>

</template>

