<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteModal from '@/Components/DeleteModal.vue';
import CvVisualizer from '@/Components/CvVisualizer.vue';
import ExperienceElement from '@/Components/ExperienceElement.vue';
import FormationElement from '@/Components/FormationElement.vue';
import ComplementaryFormationElement from '@/Components/ComplementaryFormationElement.vue';
import SkillElement from '@/Components/SkillElement.vue';
import LanguageElement from '@/Components/LanguageElement.vue';
import SkillBadge from '@/Components/SkillBadge.vue';
import ToggleVisible from '@/Components/ToggleVisible.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ColorControls from '@/Components/ColorControls.vue';
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
});

const cvUpdated = ref(false);
const modal = ref();
const color1 = ref(props.cv.color_1);
const color2 = ref(props.cv.color_2);

const colorCv = reactive({
   gold: '#AA9739',
   blue: '#168BA3',
   grey: '#AAB0B4',
});

const changeCvColor = (elem) => {
    const req = {
        cv_id: props.cv.id,
        color: elem.color
    };

    const numColor = elem.type == 'principal' ? 1 : 2;

    axios.post('changecolor' + numColor, req)
    .then(function (response) {
        console.log(response);
        color1.value = response.data.color1;
        color2.value = response.data.color2;
        dbUpdated();   

    })
    .catch(function (error) {
        console.log(error);
    });   
}

const form = useForm({
    cv_id: props.cv.id || '',
    profile: props.cv.description || '',
    offer: props.cv.offer || '',
});

const submit = () => {
    const formRoute = 'updateprofile'

    let pro = {
        profile: form.profile,
        cv_id: form.cv_id,
    };

    axios.post(formRoute, pro)
    .then(function (response) {
        console.log(response);

        dbUpdated();

    })
    .catch(function (error) {
        console.log(error);
    });   
};

const submitOffer = () => {
    const formRoute = 'addoffer'

    let pro = {
        offer: form.offer,
        cv_id: form.cv_id,
    };

    axios.post(formRoute, pro)
    .then(function (response) {
        console.log(response);

        dbUpdated();

    })
    .catch(function (error) {
        console.log(error);
    });   
};

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

    console.log(props.experiences);
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
                    </ul>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'profile'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100 ">
                            <div class="flex">
                                <div class="flex-auto w-1/4">
                                    <ToggleVisible 
                                        :visible="incv_sections.includes('profile')"
                                        :section="'profile'"
                                        @toggle-included-section="toggleIncludedSection"
                                    />  
                                </div>
                                <div class="flex-auto w-3/4">
                                    <p>Puedes incluir tu perfil en el currículum, o escribir uno específico. </p>
                                </div>
                                  
                           </div>

                           <div class="mb-2">
                                <form @submit.prevent="submit" enctype="multipart/form-data">
                                    <div class="invisible" style="max-height: 1px;">
                                        <input type="text" id="cv_id_val" v-model="form.cv_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mt-1 block w-full" readonly>
                                    </div>

                                    <div class="p-2 m-2">
                                        <label for="profile_val">Perfil</label>
                                        <textarea id="profile_val" rows="4" v-model="form.profile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mt-1 block w-full"></textarea>
                                    </div>

                                    <div class="flex items-center justify-start pt-3 m-2 row-start-4 ">
                                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                            Guardar
                                        </PrimaryButton>
                                    </div>
                                    
                                </form>
                           </div>

                           <hr>

                           <div class="p-1 m-1">
                               <ColorControls
                                  :type_color="'principal'"
                                  :active_color="color1" 
                                  @color-changed="changeCvColor"
                               />
                           </div>

                           <div class="p-1 m-1 mb-2">
                               <ColorControls
                                  :type_color="'secundario'"
                                  :active_color="color2" 
                                  @color-changed="changeCvColor"
                               />
                           </div>

                           <hr>

                           <form @submit.prevent="submitOffer" enctype="multipart/form-data">
                                <div class="invisible" style="max-height: 1px;">
                                    <input type="text" id="cv_id_val" v-model="form.cv_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mt-1 block w-full" readonly>
                                </div>

                                <div class="p-2 m-2">
                                    <label for="profile_val">Oferta</label>
                                    <textarea id="profile_val" rows="4" v-model="form.offer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mt-1 block w-full"></textarea>
                                </div>

                                <div class="flex items-center justify-start pt-3 m-2 row-start-4 ">
                                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Guardar
                                    </PrimaryButton>
                                </div>
                                
                            </form>
                           
                        </div>
                    </div>


                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'experiencia'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100 ">
                            <div class="flex">
                                <div class="flex-auto w-1/4">
                                    <ToggleVisible 
                                        :visible="incv_sections.includes('experience')"
                                        :section="'experience'"
                                        @toggle-included-section="toggleIncludedSection"
                                    />  
                                </div>
                                <div class="flex-auto w-2/4">
                                    <p>Introduce los puestos en los que has trabajado</p>
                                </div>
                                <div class="flex-auto w-1/4 text-right mb-4">
                                   <button type="button" @click="addElement('experiences')" id="btn-add-experiences" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700">Añadir</button>
                               </div>    
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

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'formacion'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex">
                                <div class="flex-auto w-1/4">
                                    <ToggleVisible 
                                        :visible="incv_sections.includes('formation')"
                                        :section="'formation'"
                                        @toggle-included-section="toggleIncludedSection"
                                    />  
                                </div>
                                <div class="flex-auto w-2/4">
                                    <p>Introduce tu Formación Académica</p>
                                </div>
                                <div class="flex-auto w-1/4 text-right mb-4">

                                   <button type="button" @click="addElement('formations')" id="btn-add-formations" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700">Añadir</button>
                               </div>
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

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'formacion-complementaria'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex">
                                <div class="flex-auto w-1/4">
                                    <ToggleVisible 
                                        :visible="incv_sections.includes('complementary_formation')"
                                        :section="'complementary_formation'"
                                        @toggle-included-section="toggleIncludedSection"
                                    />  
                                </div>
                                <div class="flex-auto w-2/4">
                                    <p>Introduce aquí otro tipo de formación no reglada que tengas (cursos, seminarios, etc).</p>
                                </div>
                                <div class="flex-auto w-1/4 text-right mb-4">

                                   <button type="button" @click="addElement('complementary_formations')" id="btn-add-complementary_formations" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700">Añadir</button>
                               </div>    
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

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'habilidades'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">

                            <div class="flex">
                                <div class="flex-auto w-1/4">
                                    <ToggleVisible 
                                        :visible="incv_sections.includes('skills')"
                                        :section="'skills'"
                                        @toggle-included-section="toggleIncludedSection"
                                    />  
                                </div>
                                <div class="flex-auto w-2/4">
                                    <p>Aquí puedes introducir tus habilidades relativas al puesto, y tu nivel en cada una.</p>
                                </div>
                                <div class="flex-auto w-1/4 text-right mb-4">

          
                               </div>
                            </div>  

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
                                        :resume_id="cv.id"
                                        @element-deleted="removeSkill"
                                        @bd-updated="dbUpdated"
                                    />
                                </span>
                            </div>

                            

                        </div>

                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-b-lg mb-4 mr-3" :class="{hidden: sectionVisible != 'idiomas'}">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="flex">
                                <div class="flex-auto w-1/4">
                                    <ToggleVisible 
                                        :visible="incv_sections.includes('languages')"
                                        :section="'languages'"
                                        @toggle-included-section="toggleIncludedSection"
                                    />  
                                </div>
                                <div class="flex-auto w-2/4">
                                    <p>Aquí puedes introducir los idiomas que hablas y el nivel que tienes en cada uno. Tambien puedes indicar si tienes algún tipo de certificación.</p>
                                </div>
                                <div class="flex-auto w-1/4 text-right mb-4">
                                    <button type="button" @click="addElement('languages')" id="btn-add-languages" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700">Añadir</button>
                    
                               </div>
                            </div>  

                           <div class="my-3 py-2 " v-for="(lang, index) in languages" :key="index + 1">
                                <LanguageElement                                    
                                    :resume_id="cv.id"
                                    :language="lang"
                                    @element-deleted="openModal"
                                    @cancel-add="cancelAddElement"
                                    @language-added="enableAddButton"
                                    @bd-updated="dbUpdated"
                                />
                            </div> 
                        </div>

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