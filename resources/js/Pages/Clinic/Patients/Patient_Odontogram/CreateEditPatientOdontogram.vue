<script setup>
    import PatientOdontogramForm from './Odontogram_Form/PatientOdontogramForm.vue';
    import Modal from '@/Components/Modal.vue';
    import { ref } from 'vue';
    import { useForm,Head,usePage,router } from "@inertiajs/vue3";
    import HappyDentsLayout from "@/Layouts/HappyDentsLayout.vue";
    const props = defineProps({
        patient:{
            type:Object,
            required:true
        },
        selected_patient_odontogram_detentions:{
            type:Object,
            required:false
        },
        detentions:{
            type:Object,
            required:true
        },
        selected_odontogram_conditions:{
            type:Object,
        },

    });
    const form = useForm({
        patient_id: props.patient.id,
        detention_id: props.selected_patient_odontogram_detentions ?? [],
        condition: props.selected_odontogram_conditions ?? []
    });
    const store = () =>{
        form.post(route('pacienteOdontograma.store',form.patient_id));
    };
    const update = () => {
        form.patch(route('pacienteOdontograma.update',{patient_id:form.patient_id}));
    };

    //---Modal Section----
    const confirmingOdontogramDeletion = ref(false);

    const confirmOdontogramDeletion = () => {
        confirmingOdontogramDeletion.value = true;
    };

    const closeModal = () => {
        confirmingOdontogramDeletion.value = false;
    };

    const deleteOdontogram = () => {
        router.delete(route('pacienteOdontograma.remove',props.patient.id),{
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => closeModal(),
        });
    };
</script>

<template>
                <HappyDentsLayout>
  <Head title="Paciente-Odontograma"/>
  <div class="container-fluid overflow-auto h-100">
    <div class="row">
      <div class="col-md-16 text-center mb-4">
        <p class="h4">Paciente:</p>
        <p class="p">{{patient.name}}</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-15 offset-md-1 p-1 bg-light border rounded-3">
        <PatientOdontogramForm :updating="(props.selected_patient_odontogram_detentions === undefined ? false:true)"
          :form="form" :detentions="props.detentions" @submit.prevent="(props.selected_patient_odontogram_detentions === undefined ? store() : update())"/>
        <div class="col-md-12 text-right">
          <div v-if="props.selected_patient_odontogram_detentions != null && (usePage().props.auth.user.role.type == 'administrador' || usePage().props.auth.user.role.type == 'doctor')">
            <button @click="confirmOdontogramDeletion" class="btn btn-danger mt-3">Eliminar el Odontograma</button>
          </div>
          <div v-else></div>
        </div>
      </div>
    </div>
  </div>
</HappyDentsLayout>




    <Modal :show="confirmingOdontogramDeletion" @close="closeModal">
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
                <button class="btn btn-danger" @click=" deleteOdontogram">Confirmar</button>
            </div>
        </div>
    </Modal>
</template>
