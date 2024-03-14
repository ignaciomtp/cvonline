<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteModal from '@/Components/DeleteModal.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, onMounted } from "vue";
import { initFlowbite } from 'flowbite';


const sectionVisible = ref('datos-personales');

const setSectionVisible = (section) => {
    sectionVisible.value = section;

    let tabs = document.getElementsByClassName('tab-link');

    if(tabs) {
        for (let i = 0; i < tabs.length; i++) {
          tabs[i].classList.remove('active-dark', 'inactive-dark');

          if(tabs[i].id == section) {
            tabs[i].classList.add('active-dark');
          } else {
            tabs[i].classList.add('inactive-dark');
          }

        }        
    }


}

document.addEventListener("DOMContentLoaded", function(event) {
  document.getElementById('deleteButton').click();
});

router.on('success', (event) => {
  initFlowbite();
});




</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                


<ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-800 dark:text-gray-400">
    <li class="me-2">
        <a @click="setSectionVisible('datos-personales')" class="tab-link active-dark" id="datos-personales">Datos Personales</a>
    </li>
    <li class="me-2">
        <a @click="setSectionVisible('experiencia')" class="tab-link inactive-dark" id="experiencia">Experiencia</a>
    </li>
    <li class="me-2">
        <a @click="setSectionVisible('formacion')" class="tab-link inactive-dark" id="formacion">Formación</a>
    </li>
    <li class="me-2">
        <a @click="setSectionVisible('formacion-complementaria')" class="tab-link inactive-dark" id="formacion-complementaria">Formación Complementaria</a>
    </li>
    <li class="me-2">
        <a @click="setSectionVisible('habilidades')" class="tab-link inactive-dark" id="Habilidades">Habilidades</a>
    </li>
    <li class="me-2">
        <a @click="setSectionVisible('idiomas')" class="tab-link inactive-dark" id="idiomas">Idiomas</a>
    </li>
    <li>
        <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">Disabled</a>
    </li>
</ul>

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'datos-personales'}">
    <div class="p-6 text-gray-900 dark:text-gray-100">Esto es Datos Personales


    </div> <!-- Fin pirmer tab -->

</div>

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'experiencia'}">
    <div class="p-6 text-gray-900 dark:text-gray-100">Esto es Experiencia

<!-- Modal toggle -->
<div class="flex justify-center m-5">
    <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
    Show delete confirmation
    </button>
</div>

    </div>

</div>

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'formacion'}">
    <div class="p-6 text-gray-900 dark:text-gray-100">Esto es Formación</div>

</div>

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'formacion-complementaria'}">
    <div class="p-6 text-gray-900 dark:text-gray-100">Esto es Formación Complementaria</div>

</div>

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'habilidades'}">
    <div class="p-6 text-gray-900 dark:text-gray-100">Esto es Habilidades</div>

</div>

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'idiomas'}">
    <div class="p-6 text-gray-900 dark:text-gray-100">Esto es Idiomas</div>

</div>

            </div>
        </div>
    </AuthenticatedLayout>



    <DeleteModal />



</template>

<style>


.tab-link {
    @apply inline-block p-4 rounded-t-lg;
    cursor: pointer;
}

.active {
    @apply text-blue-600 bg-gray-100;
}

.active-dark {
    @apply bg-gray-800 text-blue-500;
}    

.inactive {
    @apply hover:text-gray-600 hover:bg-gray-50;
}

.inactive-dark {
    @apply hover:bg-gray-800 hover:text-gray-300;
}

</style>