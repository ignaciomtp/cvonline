<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CvCard from '@/Components/CvCard.vue';
import NewCvModal from '@/Components/NewCvModal.vue';
import DeleteModal from '@/Components/DeleteModal.vue';
import { Head } from '@inertiajs/vue3';
import { initFlowbite, Modal } from 'flowbite';
import { ref, onMounted } from "vue";

const modal = ref(null);
const deleteModal = ref(null);
const cvToDelete = ref('');

let props = defineProps({ cvs: Array });

const saveNewCv = (cv) => {
    props.cvs.push(cv.data);

    modal.value.hide();
}

const createCv = () => {
    modal.value.show();
}

const closeNewCvModal = () => {
    modal.value.hide();
}

const openConfirmDeleteModal = (idCv) => {
    cvToDelete.value = idCv;
    deleteModal.value.show();
}

const closeDeleteModal = () => {
    deleteModal.value.hide();
}

const deleteCv = () => {

    axios.post('mis-cvs/deletecv' + cvToDelete.value, {
      _method: 'DELETE'
    })
    .then( response => {
        console.log(response);
   
        removeCv(response.data);

        closeDeleteModal();
    })
    .catch( error => {
       console.log(error);
    })

}

const cloningCV = (id) => {


    const req = {
        cv_id: id,
    };

    axios.post('clonecv', req)
    .then( response => {
        console.log(response);
        props.cvs.push(response.data);
   
    })
    .catch( error => {
       console.log(error);
    })
}

const removeCv = (elemId) => {
    const idx = props['cvs'].findIndex(item => item.id == elemId);

    if(idx > -1) props['cvs'].splice(idx, 1);
}

document.addEventListener("DOMContentLoaded", function(event) {
  document.getElementById('newCvButton').click();
});


onMounted(() => {
  const $targetEl = document.getElementById('newCvModal');
  modal.value = new Modal($targetEl); 

  const $targetEl2 = document.getElementById('deleteModal');
  deleteModal.value = new Modal($targetEl2); 
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Mis CVs</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-row flex-wrap bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                   
                                <CvCard
                                    title="Nuevo Currículum"
                                    id="0"
                                    color="green"
                                    @new-cv="createCv"
                                    
                                ></CvCard>                                
                      
                            <div v-for="(cv, index) in cvs" :key="cv.id" >
                                <CvCard
                                    :title="cv.title"
                                    :id="cv.id"
                                    :num="index + 1"
                                    color="blue"
                                    @delete-cv="openConfirmDeleteModal"
                                    @clone-cv="cloningCV"
                                ></CvCard>
                            </div>
                  
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <NewCvModal
        @cv-created="saveNewCv"
        @cancel-create="closeNewCvModal"
     />

    <DeleteModal 
        @confirm-delete="deleteCv"
        @cancel-modal="closeDeleteModal"
    />

</template>