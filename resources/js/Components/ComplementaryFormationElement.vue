<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TerciaryButton from '@/Components/TerciaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextTextArea from '@/Components/TextTextArea.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    formation: Object,
});

const emit = defineEmits(['complementary_formation-deleted', 'bd-updated']);

const form = useForm({
    id: props.formation.id || 0,
    resume_id: props.formation.resume_id || 0,
    title: props.formation.title || '',
    institution: props.formation.institution || '',
    institution_city: props.formation.institution_city || '',
    year: props.formation.year || 0,
    hours: props.formation.hours || 0,
    type: props.formation.type || '',
});

const submit = () => {
    const formRoute = props.formation.id == 0 ? 'addformation' : 'updateformation';

    let formation = {
        title: form.title,
        resume_id: form.resume_id,
        institution: form.institution,
        institution_city: form.institution_city,
        year: form.year,
        hours: form.hours,
        type: form.type,
    };

    if(props.formation.id > 0) formation.id = form.id;

    axios.post(formRoute, formation)
    .then(function (response) {
        console.log(response);

        props.formation.id = response.data.id;
        form.id = response.data.id;

        emit('bd-updated');

    })
    .catch(function (error) {
        console.log(error);
    });
    
};

const deleteExp = () => {
    console.log(props.formation.id);

    axios.post('deleteformation/' + props.formation.id, {
      _method: 'DELETE'
    })
    .then( response => {
       console.log(response);

       emit('complementary_formation-deleted', response.data);
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
                        <InputLabel for="title" value="Curso" />

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
                        <InputLabel for="institution" value="Centro" />

                        <TextInput
                            id="institution"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.institution"
                            required
                            autofocus
                            autocomplete="institution"
                        />

                        <InputError class="mt-2" :message="form.errors.institution" />
                    </div>
                </div>

                <div class="flex-auto w-33 ">
                    <div class="p-1 m-1">
                        <InputLabel for="institution_city" value="Localidad" />

                        <TextInput
                            id="institution_city"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.institution_city"
                            required
                            autofocus
                            autocomplete="institution_city"
                        />

                        <InputError class="mt-2" :message="form.errors.institution_city" />
                    </div>
                </div>

            </div>

            <div class="flex">
                <div class="flex-auto w-33 ">
                    <div class="flex">
                        <div class="p-1 m-1 flex-auto w-1/5">
                            <InputLabel for="year" value="Año" />

                            <TextInput
                                id="year"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.year"
                                autofocus
                                autocomplete="year"
                            />

                            <InputError class="mt-2" :message="form.errors.year" />
                        </div>

                        <div class="p-1 m-1 flex-auto w-1/5">
                            <InputLabel for="hours" value="Horas" />

                            <TextInput
                                id="hours"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.hours"
                                autofocus
                                autocomplete="hours"
                            />

                            <InputError class="mt-2" :message="form.errors.hours" />
                        </div>     

                        <div class="p-1 m-1 flex-auto w-1/5 invisible">
                            <InputLabel for="type" value="Tipo" />

                            <TextInput
                                id="type"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.type"
                                autofocus
                                autocomplete="type"
                            />
                            <InputError class="mt-2" :message="form.errors.type" />
                        </div>             

                        <div class="flex-auto w-1/5 invisible" v-if="formation.id != 0">
                            <InputLabel for="id" value="id" />

                            <TextInput
                                id="id"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.id"
                                autofocus
                                autocomplete="id"
                                readonly
                            />
                        </div>
                        <div class="flex-auto w-1/5 invisible">
                            <InputLabel for="resume_id" value="id cv" />

                            <input 
                                id="resume_id"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.resume_id"
                                required
                                readonly 
                            />
                        </div>
                    </div>

                </div>


                <div class="flex-auto w-66 ">


                    <div>
                        <div class="flex items-center justify-start pt-3 m-2 row-start-4">
                            <PrimaryButton v-if="props.formation.id == 0" class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Añadir al Currículum
                            </PrimaryButton>

                            <div v-if="props.formation.id > 0" class="flex">
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