<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TerciaryButton from '@/Components/TerciaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    experience: Object,
    resume_id: String,
});

const emit = defineEmits(['experience-deleted', 'bd-updated']);

const form = useForm({
	id: props.experience.id || 0,
    resume_id: props.resume_id || 0,
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

	})
	.catch(function (error) {
		console.log(error);
	});
    
};

const deleteExp = () => {
	console.log(props.experience.id);

	axios.post('deleteexperience/' + props.experience.id, {
	  _method: 'DELETE'
	})
	.then( response => {
	   console.log(response);

	   emit('experience-deleted', response.data);
	})
	.catch( error => {
	   console.log(error);
	})
}

</script>

<template>
	<div class="m-1">
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

			<div class="flex">
				<div class="flex-auto w-33">
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

					<div class="flex w-full ">
				   		<div class="flex-auto w-1/2 invisible" v-if="experience.id != 0">
				   			<InputLabel for="id" value="id" />

			                <TextInput
			                    id="id"
			                    type="number"
			                    class="mt-1 block w-full"
			                    v-model="form.id"
			                    autofocus
			                    autocomplete="id"
			                />
				   		</div>
				   		<div class="flex-auto w-1/2 invisible">
				   			<InputLabel for="resume_id" value="id cv" />

				   			<input 
			                    id="resume_id"
			                    type="text"
			                    class="mt-1 block w-full"
			                    v-model="form.resume_id"
			                    required
			                    readonly 
			                />
				   		</div>
				   	</div>

				</div>


				<div class="flex-auto w-66 ">
				   	<div class="p-1 m-1">
						<InputLabel for="job_description" value="Descripción" />

		                <textarea
		                    id="job_description"
		                    
		                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full"
		                    v-model="form.job_description"
		                    required
		                    autofocus
		                    autocomplete="job_description"
		                ></textarea>

		                <InputError class="mt-2" :message="form.errors.job_description" />
				   	</div>

				   	<div>
				   		<div class="flex items-center justify-start pt-3 m-2 row-start-4">
	                        <PrimaryButton v-if="props.experience.id == 0" class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
	                            Añadir al Currículum
	                        </PrimaryButton>

	                        <div v-if="props.experience.id > 0" class="flex">
	                        	<SecondaryButton  class="ms-4" type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
		                            Actualizar
		                        </SecondaryButton>

		                        <div style="float: right;" >
		                        	<button 
								        type="button"
								        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
								        @click="deleteExp"
								    >
								        Quitar
								    </button>
		                        </div>	                        
	                        </div>
	                        
	                    </div>

	                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
	                      {{ form.progress.percentage }}%
	                    </progress>
				   	</div>
				</div>
			</div>

		</form>
	</div>
</template>