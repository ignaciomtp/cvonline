<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TerciaryButton from '@/Components/TerciaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, reactive } from "vue";


const props = defineProps({
    resume_id: String,
}); 

const skill = reactive({
    resume_id: props.resume_id || '',
    name: '',
    level: 0,
});

const emit = defineEmits(['skill-added', 'bd-updated']);

const form = useForm({
    resume_id: props.resume_id || 0,
    name: skill.name || '',
    level: skill.level || 0,
    
});

const submit = () => {
    const formRoute = 'addskill';

    let skill = {
        name: form.name,
        resume_id: form.resume_id,
        level: form.level,
    };


    axios.post(formRoute, skill)
    .then(function (response) {

        emit('skill-added', response.data);
        emit('bd-updated');
        form.name = '';
        form.level = 0;

    })
    .catch(function (error) {
        console.log(error);
    });
    
};


</script>


<template>
    <div class="m-1">
        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-auto w-1/4 ">
                    <div class="p-1 m-1">
                        <InputLabel for="name" value="Habilidad" />

                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            id="name"
                            type="text"
                            v-model="form.name"
                            min="0"
                            max="5"
                            required
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                </div>


                <div class="flex-auto w-1/4 ">
                    <div class="p-1 m-1">
                        <InputLabel for="level" value="Nivel" />

                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            id="level"
                            type="number"
                            v-model="form.level"
                            min="0"
                            max="5"
                        />


                        <InputError class="mt-2" :message="form.errors.level" />
                    </div>
                </div>

                <div class="flex-auto w-1/4 invisible">
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


                <div class="flex-auto w-1/4 ">
                    <div >
                        <div class="flex items-center justify-start pt-5 m-2 row-start-4 ">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Añadir al Currículum
                            </PrimaryButton>                            
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