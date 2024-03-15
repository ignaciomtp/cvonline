<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    title: String
});

const form = useForm({
    title: props.title || '',

});

const submit = () => {
    form.post(route('savenewcv'));
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="grid grid-cols-2 ">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">                  

                   <div class="p-4 ">
                       <h1 class="text-2xl">Nuevo Currículum</h1>

                       <div class="my-2">
                          <form @submit.prevent="submit">
                              <div class="p-2 m-2">
                                <InputLabel for="title" value="Título" />

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

                            <div class="flex items-center justify-start pt-3 m-2 row-start-4">
                                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Guardar
                                </PrimaryButton>
                            </div>

                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                              {{ form.progress.percentage }}%
                            </progress>
                          </form>
                       </div>

                       
                   </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>