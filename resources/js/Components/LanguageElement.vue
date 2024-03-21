<script setup>
import ChevronDown from '@/Components/ChevronDown.vue';
import ChevronUp from '@/Components/ChevronUp.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TerciaryButton from '@/Components/TerciaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, reactive, onMounted } from "vue";

const props = defineProps({
    language: Object,
    resume_id: String,
});

const contentHidden = ref(true);

const toggleDeployed = () => {
    contentHidden.value = !contentHidden.value;
}

const emit = defineEmits(['language-added', 'element-deleted', 'bd-updated', 'cancel-add']);

const form = useForm({
    id: props.language.id || 0,
    resume_id: props.resume_id || '',
    name: props.language.name || '',
    level: props.language.level || '',
    certification: props.language.certification || '',
});

const submit = () => {
    const formRoute = 'addlanguage';

    let language = {
        name: form.name,
        level: form.level,
        resume_id: form.resume_id,
        certification: form.certification,
    };

    if(props.language.id > 0) language.id = form.id;

    axios.post(formRoute, language)
    .then(function (response) {
        console.log(response);

        props.language.id = response.data.id;
        form.id = response.data.id;

        emit('bd-updated');
        emit('language-added', 'languages');

    })
    .catch(function (error) {
        console.log(error);
    });
    
};

const deleteLanguage = () => {
    const item = {
         section: 'language',
         id: props.language.id
    };

   
   emit('element-deleted', item);
}

const cancelAdd = () => {
    emit('cancel-add', 'languages');
}


onMounted(() => {
    contentHidden.value = true;

});

</script>

<template>
<div id="accordion-collapse" data-accordion="collapse">
  <h2 id="accordion-collapse-heading-1">
    <button type="button" @click="toggleDeployed" class="flex items-center justify-between w-full p-4 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:bg-gray-700 gap-3" :class="{roundedtop: !contentHidden, roundedxl: contentHidden}" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
      <span>{{ form.name }}</span>
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
                        <InputLabel for="name" value="Idioma" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                </div>

                <div class="flex-auto w-33">
                    <div class="p-1 m-1">
                        <InputLabel for="level" value="Nivel" />

                        <TextInput
                            id="level"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.level"
                            autofocus
                            autocomplete="level"
                        />

                        <InputError class="mt-2" :message="form.errors.level" />
                    </div>                    
                </div>

                <div class="flex-auto w-33 ">
                    <div class="p-1 m-1">
                        <InputLabel for="certification" value="Certificado" />

                        <TextInput
                            id="certification"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.certification"
                            autofocus
                            autocomplete="certification"
                        />

                        <InputError class="mt-2" :message="form.errors.certification" />
                    </div>
                </div>
            </div>

            <div class="flex">
            	<div class="flex-auto flex w-66 invisible">
						<div class="flex-auto w-1/2 " v-if="language.id != 0">
                            <InputLabel for="id" value="id" />

                            <input
                                id="id"
                                type="text"
                                class="mt-1 block w-full text-black"
                                v-model="form.id"
                                readonly
                            />
                        </div>
                        <div class="flex-auto w-1/2 ">
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
                <div class="flex-auto w-33 text-right">
                        <div class="flex items-center  pt-3 m-2 ">
                            <div v-if="props.language.id == 0" class="flex justify-between w-full">                
                                <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Guardar y añadir al cv</button>
                                
                                <button 
                                    type="button"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                    @click="cancelAdd"
                                >
                                    Cancelar
                                </button>
                                
                            </div>

                            <div v-if="props.language.id > 0" class="flex justify-between w-full">

                                <button 
                                    type="button"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                    @click="deleteLanguage"
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