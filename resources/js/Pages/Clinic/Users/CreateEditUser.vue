<script setup>
    import UserForm from './UsersForms/UserForm.vue';
    import { useForm,Head } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    const props = defineProps({
        roles:{
            type:Object,
            required:true
        },
        user:{
            type:Object,
            required:false
        }
    });

    const form = useForm({
        id:props.user?.id ?? '',
        name:props.user?.name ?? '',
        email:props.user?.email ?? '',
        password:props.user?.password ?? '',
        role_id:props.user?.role_id ?? '',

    });
    const store = () =>{
        form.post(route('users.store'));
    }
    const update = () => {
        form.patch(route('users.update',form.id));
    }
</script>

<template>
    <Head title="Usuarios"/>
    <HappyDentsLayout>
        <div class="container">
            <div class="row ">
                <div class="col-md-10 offset-md-1 p-5 bg-light border rounded-3">
                    <UserForm class="" :updating="(user == null ? false: true)"
                    :roles="props.roles" :form="form" @submit.prevent="(user == null ? store(): update())"/>
                </div>
            </div>
        </div>
    </HappyDentsLayout>
   
</template>