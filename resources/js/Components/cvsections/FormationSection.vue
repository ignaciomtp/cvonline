<script setup>
import FormationElement from '@/Components/FormationElement.vue';
import ToggleVisible from '@/Components/ToggleVisible.vue';

let props = defineProps({
	cv: Object,
	visible: Boolean,
	formations: Array
});

const emit = defineEmits([
	'toggled-section', 
	'bd-updated', 
	'enable-the-add-button', 
	'open-the-modal', 
	'cancel-the-adding',
	'adding-new-element'
]);

const toggleSection = (section) => {
	emit('toggled-section', section);
}

const enableAddButton = (type) => {
	emit('enable-the-add-button', type);
}

const openModal = (item) => {
	emit('open-the-modal', item);
}

const cancelAddElement = (type) => {
	emit('cancel-the-adding', type);
}

const updateDB = () => {
	emit('bd-updated');
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
	                :section="'formation'"
	                @toggle-included-section="toggleSection"
	            />  
	        </div>
	        <div class="flex-auto w-2/4">
	            <p>Introduce tu Formación Académica</p>
	        </div>
	        <div class="flex-auto w-1/4 text-right mb-4">

	           <button type="button" @click="addNewElement('formations')" id="btn-add-formations" class=" focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700">Nuevo</button>
	       </div>
	   </div>    
	    <div class="my-3 py-2 " v-for="(formation, index) in formations" :key="index + 1">
	        <FormationElement                                     
	            :resume_id="cv.id"
	            :formation="formation"
	            @element-deleted="openModal"
	            @cancel-add="cancelAddElement"
	            @formation-added="enableAddButton"
	            @bd-updated="updateDB"
	        />
	    </div>
	</div>	
</template>
