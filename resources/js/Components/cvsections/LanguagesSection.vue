<script setup>
import ToggleVisible from '@/Components/ToggleVisible.vue';
import LanguageElement from '@/Components/LanguageElement.vue';

let props = defineProps({
	cv: Object,
	visible: Boolean,
	languages: Array
});


const emit = defineEmits([
	'toggled-section', 
	'bd-updated', 
	'element-deleted',
	'cancel-add',
	'language-added',
	'adding-new-element'
]);

const toggleSection = (section) => {
	emit('toggled-section', section);
}

const updateDB = () => {
	emit('bd-updated');
}

const languageDeleted = (language) => {
	emit('element-deleted', language);
}

const cancelAddLanguage = (type) => {
	emit('cancel-add', type);
}

const enableAddButton = (type) => {
	emit('language-added', type);
}

const addNewElement = (element) => {
	emit ('adding-new-element', element);
}

</script>

<template>
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <div class="flex">
            <div class="flex-auto w-1/4">
                <ToggleVisible 
                    :visible="visible"
                    :section="'languages'"
                    @toggle-included-section="toggleSection"
                />  
            </div>
            <div class="flex-auto w-2/4">
                <p>Aquí puedes introducir los idiomas que hablas y el nivel que tienes en cada uno. Tambien puedes indicar si tienes algún tipo de certificación.</p>
            </div>
            <div class="flex-auto w-1/4 text-right mb-4">
                <button type="button" @click="addNewElement('languages')" id="btn-add-languages" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700">Nuevo</button>

           </div>
        </div>  

       <div class="my-3 py-2 " v-for="(lang, index) in languages" :key="index + 1">
            <LanguageElement                                    
                :resume_id="cv.id"
                :language="lang"
                @element-deleted="languageDeleted"
                @cancel-add="cancelAddLanguage"
                @language-added="enableAddButton"
                @bd-updated="updateDB"
            />
        </div> 
    </div>
</template>