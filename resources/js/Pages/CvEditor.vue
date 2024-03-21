<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteModal from '@/Components/DeleteModal.vue';
import CvVisualizer from '@/Components/CvVisualizer.vue';
import ExperienceElement from '@/Components/ExperienceElement.vue';
import FormationElement from '@/Components/FormationElement.vue';
import ComplementaryFormationElement from '@/Components/ComplementaryFormationElement.vue';
import SkillElement from '@/Components/SkillElement.vue';
import SkillBadge from '@/Components/SkillBadge.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, reactive, onMounted } from "vue";
import { initFlowbite } from 'flowbite';
import { Modal } from 'flowbite';

let props = defineProps({
    cv: Object,
    experiences: Array,
    formations: Array,
    complementary_formations: Array,
    skills: Array,
});

const cvUpdated = ref(false);
const modal = ref();

const colorCv = reactive({
   gold: '#AA9739',
   blue: '#168BA3',
   grey: '#AAB0B4',
});

const elemToDelete = reactive({
    section: '',
    id: ''
});


const resetCvUpdated = () => {
    cvUpdated.value = false;
}

const deleteElement = () => {

    axios.post('delete' + elemToDelete.section + '/' + elemToDelete.id, {
      _method: 'DELETE'
    })
    .then( response => {
        console.log(response);
   
        removeElement(elemToDelete.section + 's', elemToDelete.id);
        dbUpdated();
        closeModal();
    })
    .catch( error => {
       console.log(error);
    })
}


const removeElement = (section, elemId) => {
    const idx = props[section].findIndex(item => item.id == elemId);

    if(idx > -1) props[section].splice(idx, 1);
}

const removeSkill = (elem) => {
    removeElement(elem.section, elem.id);
}

const dbUpdated = () => {
    cvUpdated.value = true;
}


const sectionVisible = ref('experiencia');

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

const disableAddElement = (type) => {
    let btn = document.getElementById('btn-add-' + type);

    btn.setAttribute('disabled', '');
}

const enableAddButton = (type) => {
    let btn = document.getElementById('btn-add-' + type);

    btn.removeAttribute('disabled');
}

const addElement = (type) => {
    let elem;

    switch(type) {
        case 'experiences':
            elem = {
                id: 0,
                title: '',
                company_name: '',
                company_city: '',
                date_start: '',
                date_finish: '',
                job_description: '',
            };
            break;

        case 'formations':
            elem = {
                id: 0,
                title: '',
                name: '',
                institution: '',
                institution_city: '',
                date_start: '',
                date_finish: '',
            };
            break;

        case 'complementary_formations':
            elem = {
                id: 0,
                title: '',
                name: '',
                institution: '',
                institution_city: '',
                hours: 0,
                year: 0,
            };
            break;

        case 'skills':
            elem = {
                id: 0,
                name: '',
                level: 0,
            };
            break;

        case 'languages':
            elem = {
                id: 0,
                name: '',
                level: '',
                certification: '',
            };
            break;

    }

    props[type].push(elem);    

    disableAddElement(type);

}

const AddSkill = (elem) => {
    props.skills.push(elem);
}

const cancelAddElement = (type) => {
    props[type].pop();    

    enableAddButton(type);
}


router.on('success', (event) => {
  initFlowbite();
});

const tempFunc = () => {
    console.log('ola k ase');
}

//const modal = ref(new Modal($targetEl, options, instanceOptions));

const openModal = (item) => {
    elemToDelete.section = item.section;
    elemToDelete.id = item.id;

    modal.value.show();
}

const closeModal = () => {
    modal.value.hide();
}

onMounted(() => {

    
    // set the modal menu element
    const $targetEl = document.getElementById('deleteModal');

    // options with default values
    const options = {
        placement: 'bottom-right',
        backdrop: 'dynamic',
        backdropClasses:
            'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
        closable: true,
        onHide: () => {
            console.log('modal is hidden');
        },
        onShow: () => {
            console.log('modal is shown');
        },
        onToggle: () => {
            console.log('modal has been toggled');
        },
    };

    // instance options object
    const instanceOptions = {
      id: 'deleteModal',
      override: true
    };

    modal.value = new Modal($targetEl, options, instanceOptions);


});


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="flex flex-row flex-wrap mx-auto sm:px-6 lg:px-8">

                <div class="w-full sm:w-2/3 md:w-2/3 p-3 mb-4">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-800 dark:text-gray-400">

                        <li class="me-2">
                            <a @click="setSectionVisible('experiencia')" class="tab-link active-dark" id="experiencia">Experiencia</a>
                        </li>
                        <li class="me-2">
                            <a @click="setSectionVisible('formacion')" class="tab-link inactive-dark" id="formacion">Formación</a>
                        </li>
                        <li class="me-2">
                            <a @click="setSectionVisible('formacion-complementaria')" class="tab-link inactive-dark" id="formacion-complementaria">Formación Complementaria</a>
                        </li>
                        <li class="me-2">
                            <a @click="setSectionVisible('habilidades')" class="tab-link inactive-dark" id="habilidades">Habilidades</a>
                        </li>
                        <li class="me-2">
                            <a @click="setSectionVisible('idiomas')" class="tab-link inactive-dark" id="idiomas">Idiomas</a>
                        </li>
                    </ul>


                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'experiencia'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="text-right mb-4">

                               <button type="button" @click="addElement('experiences')" id="btn-add-experiences" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700">Añadir</button>
                           </div>    
                            <div class="my-3 py-2 " v-for="(exp, index) in experiences" :key="index + 1">
                                <ExperienceElement 
                                    :resume_id="cv.id"
                                    :experience="exp"
                                    @experience-added="enableAddButton"
                                    @element-deleted="openModal"
                                    @cancel-add="cancelAddElement"
                                    @bd-updated="dbUpdated"
                                />
                            </div>

                        </div>

                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'formacion'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="text-right mb-4">

                               <button type="button" @click="addElement('formations')" id="btn-add-formations" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700">Añadir</button>
                           </div>    
                            <div class="my-3 py-2 " v-for="(formation, index) in formations" :key="index + 1">
                                <FormationElement                                     
                                    :resume_id="cv.id"
                                    :formation="formation"
                                    @element-deleted="openModal"
                                    @cancel-add="cancelAddElement"
                                    @formation-added="enableAddButton"
                                    @bd-updated="dbUpdated"
                                />
                            </div>
                        </div>

                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'formacion-complementaria'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="text-right mb-4">

                               <button type="button" @click="addElement('complementary_formations')" id="btn-add-complementary_formations" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700">Añadir</button>
                           </div>    
                            <div class="my-3 py-2 " v-for="(cfor, index) in complementary_formations" :key="index + 1">
                                <ComplementaryFormationElement                                     
                                    :resume_id="cv.id"
                                    :formation="cfor"
                                    @element-deleted="openModal"
                                    @cancel-add="cancelAddElement"
                                    @formation-added="enableAddButton"
                                    @bd-updated="dbUpdated"
                                />
                            </div>
                        </div>

                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'habilidades'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="m-1">
                                <SkillElement 
                                    :resume_id="cv.id"
                                    @skill-added="AddSkill"
                                    @bd-updated="dbUpdated"
                                />                   
                            </div> 

                            <div class="my-5 mx-2">
                                <span v-for="(item, index) in skills" :key="index + 1">
                                    <SkillBadge 
                                        :skill="item"
                                        @element-deleted="removeSkill"
                                        @bd-updated="dbUpdated"
                                    />
                                </span>
                            </div>

                            

                        </div>

                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4" :class="{hidden: sectionVisible != 'idiomas'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">Esto es Idiomas</div>

                    </div>                   
                </div>  <!-- Fin 1ª sección -->
                
                <div class="w-full sm:w-1/3 md:w-1/3 p-1 borde bg-black ">
                    <CvVisualizer 
                        :cv_id="props.cv.id"
                        :updated="cvUpdated"
                        @view-updated="resetCvUpdated"
                    />

                </div>

            </div>
        </div>
    </AuthenticatedLayout>

    <!-- Main modal -->
    <DeleteModal 
        @confirm-delete="deleteElement"
        @cancel-modal="closeModal"
    />

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