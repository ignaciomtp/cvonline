<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteModal from '@/Components/DeleteModal.vue';
import CvVisualizer from '@/Components/CvVisualizer.vue';

import FormationElement from '@/Components/FormationElement.vue';
import ComplementaryFormationElement from '@/Components/ComplementaryFormationElement.vue';
import SkillElement from '@/Components/SkillElement.vue';
import LanguageElement from '@/Components/LanguageElement.vue';
import CustomCategoryElement from '@/Components/CustomCategoryElement.vue';
import SkillBadge from '@/Components/SkillBadge.vue';
import ToggleVisible from '@/Components/ToggleVisible.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ColorControls from '@/Components/ColorControls.vue';
import TemplatesControl from '@/Components/TemplatesControl.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

import ProfileSection from '@/Components/cvsections/ProfileSection.vue';
import ExperienceSection from '@/Components/cvsections/ExperienceSection.vue';
import FormationSection from '@/Components/cvsections/FormationSection.vue';
import ComplementaryFormationSection from '@/Components/cvsections/ComplementaryFormationSection.vue';
import SkillsSection from '@/Components/cvsections/SkillsSection.vue';
import LanguagesSection from '@/Components/cvsections/LanguagesSection.vue';

import { Head, router, useForm } from '@inertiajs/vue3';
import { ref, reactive, onMounted } from "vue";
import { initFlowbite } from 'flowbite';
import { Modal } from 'flowbite';

let props = defineProps({
    cv: Object,
    experiences: Array,
    formations: Array,
    complementary_formations: Array,
    skills: Array,
    languages: Array,
    incv_sections: Array,
    templates: Array,
    custom_categories: Array,
});

const cvUpdated = ref(false);
const modal = ref();


const colorCv = reactive({
   gold: '#AA9739',
   blue: '#168BA3',
   grey: '#AAB0B4',
});


const toggleIncludedSection = (section) => {
    const req = {
        cv_id: props.cv.id,
        section: section
    };

    axios.post('toggleincludedsection', req)
    .then(function (response) {
        console.log(response);

        dbUpdated();
    

    })
    .catch(function (error) {
        console.log(error);
    });
}

const elemToDelete = reactive({
    section: '',
    id: ''
});


const resetCvUpdated = () => {
    cvUpdated.value = false;
}

const deleteElement = () => {

    const routeSection = elemToDelete.section == 'complementary_formation' ? 'formation' : elemToDelete.section;

    axios.post('delete' + routeSection + '/' + elemToDelete.id, {
      _method: 'DELETE'
    })
    .then( response => {
        console.log(response);

        const section = elemToDelete.section == 'category' ? 'custom_categories' : elemToDelete.section + 's';
   
        removeElement(section, elemToDelete.id);
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


const sectionVisible = ref('profile');

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

        case 'custom_categories':
            elem = {
                id: 0,
                category_title: '',
            }

    }

    props[type].push(elem);    

    disableAddElement(type);

}

const addSkill = (elem) => {

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
/*
    color1.value = props.cv.color_1;
    color2.value = props.cv.color_2;
 */   
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

    //console.log(props.templates);
});


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="flex flex-row flex-wrap mx-auto sm:px-6 lg:px-8">

                <div class="w-full sm:w-2/3 md:w-2/3 p-3 mb-4">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-800 dark:text-gray-400 mr-3">

                        <li class="me-2">
                            <a @click="setSectionVisible('profile')" class="tab-link active-dark" id="profile">Editar</a>
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
                            <a @click="setSectionVisible('habilidades')" class="tab-link inactive-dark" id="habilidades">Habilidades</a>
                        </li>
                        <li class="me-2">
                            <a @click="setSectionVisible('idiomas')" class="tab-link inactive-dark" id="idiomas">Idiomas</a>
                        </li>
                        <li class="me-2">
                            <a @click="setSectionVisible('personalizado')" class="tab-link inactive-dark" id="personalizado">Personalizado</a>
                        </li>
                    </ul>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'profile'}">

                        <ProfileSection 
                            :cv="cv"
                            :visible="incv_sections.includes('profile')"
                            :templates="templates"
                            @toggled-section="toggleIncludedSection"
                            @bd-updated="dbUpdated"
                        />

                    </div>


                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'experiencia'}">                            

                        <ExperienceSection 
                            :cv="cv"
                            :visible="incv_sections.includes('experience')"
                            :experiences="experiences"
                            @toggled-section="toggleIncludedSection"
                            @enable-the-add-button="enableAddButton"
                            @open-the-modal="openModal"
                            @cancel-the-adding="cancelAddElement"
                            @adding-new-element="addElement"
                            @bd-updated="dbUpdated"
                        />  
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'formacion'}">

                        <FormationSection 
                            :cv="cv"
                            :visible="incv_sections.includes('formation')"
                            :formations="formations"
                            @toggled-section="toggleIncludedSection"
                            @enable-the-add-button="enableAddButton"
                            @open-the-modal="openModal"
                            @cancel-the-adding="cancelAddElement"
                            @adding-new-element="addElement"
                            @bd-updated="dbUpdated"
                        />
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'formacion-complementaria'}">
                        <ComplementaryFormationSection 
                            :cv="cv"
                            :visible="incv_sections.includes('complementary_formation')"
                            :complementary_formations="complementary_formations"
                            @toggled-section="toggleIncludedSection"
                            @enable-the-add-button="enableAddButton"
                            @open-the-modal="openModal"
                            @cancel-the-adding="cancelAddElement"
                            @adding-new-element="addElement"
                            @bd-updated="dbUpdated"
                        />

                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'habilidades'}">

                        <SkillsSection 
                            :cv="cv"
                            :visible="incv_sections.includes('skills')"
                            :skills="skills"
                            @toggled-section="toggleIncludedSection"
                            @skill-added="addSkill"
                            @skill-removed="removeSkill"
                            @bd-updated="dbUpdated"
                        />
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'idiomas'}">

                        <LanguagesSection 
                            :cv="cv"
                            :visible="incv_sections.includes('languages')"
                            :languages="languages"
                            @toggled-section="toggleIncludedSection"
                            @element-deleted="openModal"
                            @cancel-add="cancelAddElement"
                            @adding-new-element="addElement"
                            @language-added="enableAddButton"
                            @bd-updated="dbUpdated"
                        />

                    </div>    

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'personalizado'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex">
                                <div class="flex-auto w-3/4">
                                    
                                    <p>Aquí puedes añadir secciones personalizadas al currículum, como Proyectos, Logros, Referencias, etc.</p>
                                </div>
                                <div class="flex-auto w-1/4 text-right mb-4">
                                    <button type="button" @click="addElement('custom_categories')" id="btn-add-custom_categories" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700">Nueva</button>
                    
                               </div>
                            </div>  

                            <div class="my-3 py-2 " v-for="(cat, index) in custom_categories" :key="index + 1">
                                <CustomCategoryElement                                    
                                    :resume_id="cv.id"
                                    :category="cat"
                                    :inCv="incv_sections.includes(cat.category_title)"
                                    @cancel-add="cancelAddElement"
                                    @toggle-attached="toggleIncludedSection"
                                    @element-deleted="openModal"
                                />
                            </div> 
                        </div>
                    </div>               
                </div>  <!-- Fin 1ª sección -->
                
                <div class="w-full sm:w-1/3 md:w-1/3 p-1 borde bg-black " style="min-height: 980px;">

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