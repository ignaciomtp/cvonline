<script setup>
import { useForm } from '@inertiajs/vue3';
import ToggleVisible from '@/Components/ToggleVisible.vue';
import ColorControls from '@/Components/ColorControls.vue';
import TemplatesControl from '@/Components/TemplatesControl.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from "vue";

let props = defineProps({
	cv: Object,
	visible: Boolean,
	templates: Array,
});

const form = useForm({
    cv_id: props.cv.id || '',
    profile: props.cv.description || '',
    offer: props.cv.offer || '',
    title: props.cv.title || '',
});

const color1 = ref(props.cv.color_1);
const color2 = ref(props.cv.color_2);

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
        updateDB();   

    })
    .catch(function (error) {
        console.log(error);
    });   
}


const changeTemplate = (template) => {

    const req = {
        cv_id: props.cv.id,
        template_id: template,
    };

    axios.post('changetemplate', req)
    .then(function (response) {
        console.log(response);
        props.cv.template_id = response.data.template_id;
        updateDB();   

    })
    .catch(function (error) {
        console.log(error);
    });   
}

const submit = () => {
    const formRoute = 'updateprofile'

    let pro = {
        profile: form.profile,
        title: form.title,
        cv_id: form.cv_id,
    };

    axios.post(formRoute, pro)
    .then(function (response) {
        console.log(response);

        updateDB();

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

        updateDB();

    })
    .catch(function (error) {
        console.log(error);
    });   
};

const emit = defineEmits(['toggled-section', 'bd-updated']);

const toggleSection = (section) => {
	emit('toggled-section', section);
}

const updateDB = () => {
	emit('bd-updated');
}

</script>

<template>
	<div class="p-6 text-gray-900 dark:text-gray-100 ">
	    <div class="flex">
	        <div class="flex-auto w-1/4">
	            <ToggleVisible 
	                :visible="visible"
	                :section="'profile'"
	                @toggle-included-section="toggleSection"
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

	            <div class="p-2 mx-2 ">
	                <label for="profile_val">Perfil</label>
	                <textarea id="profile_val" rows="4" v-model="form.profile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mt-1 block w-full"></textarea>
	            </div>

	            <div class="flex items-center justify-start p-2 mx-2  ">

	                <TextInput
	                    id="title"
	                    type="text"
	                    class="mt-1 block w-full mr-3"
	                    v-model="form.title"
	                    required
	                    autofocus
	                    autocomplete="title"
	                />

	                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
	                    Guardar
	                </PrimaryButton>
	            </div>
	            
	        </form>
	   </div>

	   <hr>

	   <div class="pt-1 mx-1">
	       <ColorControls
	          :type_color="'principal'"
	          :active_color="color1" 
	          @color-changed="changeCvColor"
	       />
	   </div>

	   <div class=" mx-1 mb-2">
	       <ColorControls
	          :type_color="'secundario'"
	          :active_color="color2" 
	          @color-changed="changeCvColor"
	       />
	   </div>

	   <hr>

	   <TemplatesControl 
	        :templates="templates"
	        :selected="cv.template_id"
	        @template-changed="changeTemplate"
	   />

	   <hr>

	   <div class="">
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
</template>