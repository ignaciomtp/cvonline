<script setup>
import ChevronDown from '@/Components/ChevronDown.vue';
import ChevronUp from '@/Components/ChevronUp.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TerciaryButton from '@/Components/TerciaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ToggleAttached from '@/Components/ToggleAttached.vue';

import { ref, reactive, onMounted } from "vue";
import ClasicEditor from "@ckeditor/ckeditor5-build-classic";

import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    experience: Object,
    resume_id: String,
});


const contentHidden = ref(true);

const editor = ref(ClasicEditor);
const editorConfig = {};

const toggleDeployed = () => {
	contentHidden.value = !contentHidden.value;
}


const emit = defineEmits(['element-deleted', 'bd-updated', 'experience-added', 'cancel-add']);

const form = useForm({
	id: props.experience.id || 0,
    resume_id: props.resume_id || '',
    title: props.experience.title || '',
    company_name: props.experience.company_name || '',
    company_city: props.experience.company_city || '',
    date_start: props.experience.date_start || '',
    date_finish: props.experience.date_finish || '',
    job_description: props.experience.job_description || '',
});

const submit = () => {
	const formRoute = props.experience.id == 0 ? 'addexperience' : 'updateexperience';

    //form.post(route(formRoute));

    let exp = {
    	title: form.title,
    	resume_id: form.resume_id,
    	company_name: form.company_name,
    	company_city: form.company_city,
    	date_start: form.date_start,
    	date_finish: form.date_finish,
    	job_description: form.job_description,
    };

    if(props.experience.id > 0) exp.id = form.id;

    axios.post(formRoute, exp)
		.then(function (response) {
			console.log(response);

			props.experience.id = response.data.id;
			form.id = response.data.id;

			emit('bd-updated');
			if(formRoute == 'addexperience') emit('experience-added', 'experiences');

		})
		.catch(function (error) {
			console.log(error);
		});
    
};

const deleteExp = () => {


	const item = {
		 section: 'experience',
		 id: props.experience.id
	};

   
   emit('element-deleted', item);
	
}

const cancelAdd = () => {
	emit('cancel-add', 'experiences');
}

const toggleAttachExperience = () => {

	const formRoute = 'attachexp';

    let exp = {
    	cv_id: form.resume_id,
    	exp_id: form.id,
    	
    };

    axios.post(formRoute, exp)
		.then(function (response) {
			console.log(response);

			emit('bd-updated');

		})
		.catch(function (error) {
			console.log(error);
		});


}

onMounted(() => {
	contentHidden.value = true;


});

</script>

<template>

	<div class="grid grid-cols-6 gap-4">
		<div class="col-span-5">
			<div id="accordion-collapse" data-accordion="collapse">
			  <h2 id="accordion-collapse-heading-1">
			    <button type="button" @click="toggleDeployed" class="flex items-center justify-between w-full p-4 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:bg-gray-700 gap-3" :class="{roundedtop: !contentHidden, roundedxl: contentHidden}" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
			      <span>{{ form.title }} - {{ form.company_name }}</span>
			      <svg data-accordion-icon class="w-3 h-3 shrink-0" :class="{rotated: contentHidden}"  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
			        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
			      </svg>
			    </button>
			  </h2>
			  <div id="accordion-collapse-body-1" :class="{hidden: contentHidden}" aria-labelledby="accordion-collapse-heading-1">
				<div class=" bg-white dark:bg-gray-900 rounded-b-lg p-2">
					<form @submit.prevent="submit">
						<div class="flex">
							<div class="flex-auto w-33 ">
							   	<div class="p-1 m-1">
					                <InputLabel for="title" value="Puesto" />

					                <TextInput
					                    id="title"
					                    type="text"
					                    class="mt-1 block w-full"
					                    v-model="form.title"
					                    required
					                    autofocus
					                    autocomplete="title"
					                />

					                <InputError class="mt-2" :message="form.errors.title" />
					            </div>
							</div>


							<div class="flex-auto w-33 ">
							   	<div class="p-1 m-1">
					                <InputLabel for="company_name" value="Empresa" />

					                <TextInput
					                    id="company_name"
					                    type="text"
					                    class="mt-1 block w-full"
					                    v-model="form.company_name"
					                    required
					                    autofocus
					                    autocomplete="company_name"
					                />

					                <InputError class="mt-2" :message="form.errors.company_name" />
					            </div>
							</div>

							<div class="flex-auto w-33 ">
							   	<div class="p-1 m-1">
					                <InputLabel for="company_city" value="Localidad" />

					                <TextInput
					                    id="company_city"
					                    type="text"
					                    class="mt-1 block w-full"
					                    v-model="form.company_city"
					                    required
					                    autofocus
					                    autocomplete="company_city"
					                />

					                <InputError class="mt-2" :message="form.errors.company_city" />
					            </div>
							</div>

						</div>

							   	<div class="p-1 m-1">
									<InputLabel for="job_description" value="Descripción" />



					                <ckeditor :editor="editor" v-model="form.job_description" :config="editorConfig" id="job_description"></ckeditor>

					                <InputError class="mt-2" :message="form.errors.job_description" />
							   	</div>			

						<div class="flex">
							<div class="flex-auto w-32">
								<div class="flex">
								   	<div class="p-1 m-1 flex-auto w-1/2">
										<InputLabel for="date_start" value="Fecha Inicio" />

						                <TextInput
						                    id="date_start"
						                    type="date"
						                    class="mt-1 block w-full"
						                    v-model="form.date_start"
						                    required
						                    autofocus
						                    autocomplete="date_start"
						                />

						                <InputError class="mt-2" :message="form.errors.date_start" />
								   	</div>

								   	<div class="p-1 m-1 flex-auto w-1/2">
										<InputLabel for="date_finish" value="Fecha Fin" />

						                <TextInput
						                    id="date_finish"
						                    type="date"
						                    class="mt-1 block w-full"
						                    v-model="form.date_finish"
						                    required
						                    autofocus
						                    autocomplete="date_finish"
						                />

						                <InputError class="mt-2" :message="form.errors.date_finish" />
								   	</div>					
								</div>



							</div>

							<div class="flex-auto w-14">
								<div class="flex w-full invisible">
							   		<div class="flex-auto w-1/2 " v-if="experience.id != 0">
							   			<InputLabel for="id" value="id" />
						                <input 
						                    id="id"
						                    type="number"
						                    class="mt-1 block w-full text-black"
						                    v-model="form.id"
						                    required
						                    readonly 
						                />
							   		</div>
							   		<div class="flex-auto w-1/2 invisible">
							   			<InputLabel for="resume_id" value="id cv" />

							   			<input 
						                    id="resume_id"
						                    type="text"
						                    class="mt-1 block w-full text-black"
						                    v-model="form.resume_id"
						                    required
						                    readonly 
						                />
							   		</div>
							   	</div>
							</div>

							<div class="flex-auto w-64 text-right ">

							   		<div class="flex items-center  pt-3 m-2 ">
							   			<div v-if="props.experience.id == 0" class="flex justify-between w-full">
					                        

					                        <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Guardar y añadir al cv</button>
					                        
			                        		<button 
										        type="button"
										        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
										        @click="cancelAdd"
										    >
										        Cancelar
										    </button>
											
										</div>

				                        <div v-if="props.experience.id > 0" class="flex justify-between w-full">


					                        <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Actualizar</button>

				                        	<button 
										        type="button"
										        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
										        @click="deleteExp"
										    >
										        Borrar
										    </button>
					                                                
				                        </div>
				                        
				                    </div>

				                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
				                      {{ form.progress.percentage }}%
				                    </progress>
							   	
							</div>
						</div>

					</form>
				</div>
			  </div>
			  
			</div>			
		</div>

		<div class="col-span-1">
			<ToggleAttached 
				:attached="experience.inCv"
				@toggle-attached="toggleAttachExperience"
			/>
		</div>
	</div>


</template>

<style>

.rotated {
    --tw-rotate: 180deg;
    transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
}

.roundedtop {
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}


.roundedxl {
	border-radius: 0.75rem;
}


.ck-content {
	@apply bg-gray-50 border px-6 border-gray-300 text-gray-900 text-sm rounded-b-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full !important;
}

</style>