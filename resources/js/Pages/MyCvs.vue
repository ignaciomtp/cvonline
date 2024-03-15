<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CvCard from '@/Components/CvCard.vue';
import NewCvModal from '@/Components/NewCvModal.vue';
import { Head } from '@inertiajs/vue3';
import { initFlowbite, Modal } from 'flowbite';
import { ref, onMounted } from "vue";

const modal = ref(null)

let props = defineProps({ cvs: Array });

const saveNewCv = (cv) => {
    props.cvs.push(cv.data);

    modal.value.hide();
}

const createCv = () => {
    modal.value.show();
}

document.addEventListener("DOMContentLoaded", function(event) {
  document.getElementById('newCvButton').click();
});


onMounted(() => {
  const $targetEl = document.getElementById('newCvModal');

  modal.value = new Modal($targetEl); 
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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                   

                   <div class="p-4 ">

                       <div class="my-2 flex">

                            <div v-for="cv in cvs" :key="cv.id" class="flex-initial m-3 ">
                                <CvCard
                                    :title="cv.title"
                                    :id="cv.id"
                                    color="blue"
                                ></CvCard>
                            </div>

                            <div class="flex-initial m-3">
                                <CvCard
                                    title="Nuevo Currículum"
                                    id="0"
                                    color="green"
                                    @new-cv="createCv"
                                ></CvCard>                                
                            </div>
                          
                       </div>

                       
                   </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <NewCvModal
        @cv-created="saveNewCv"
     />

</template>