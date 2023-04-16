<script setup>
import { Head,Link,router } from "@inertiajs/vue3";
import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";

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
                    <button @click="destroy(user.id)" class="btn btn-outline-danger mt-3">Delete User</button> 
                </div>
            </div>
        </div>
    </HappyDentsLayout>

</template>