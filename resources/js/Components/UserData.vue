<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextTextarea from '@/Components/TextTextarea.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
});

//console.log('USER: ', props.user);

const form = useForm({
    name: props.user.name,
    surname: props.user.surname || '',
    email: props.user.email || '',
    job: props.user.job || '',

    address: props.user.address || '',
    phone: props.user.phone || '',
    city: props.user.city || '',
    zip: props.user.zip || '',
    province: props.user.province || '',
    country: props.user.country || '',
    photo: props.user.photo || null,
    web: props.user.web || '',
    profile: props.user.profile || '',
});

const submit = () => {
    form.post(route('personal.data'));
};

</script>

<template>

    <form @submit.prevent="submit" enctype="multipart/form-data">
        <div class="grid grid-cols-4 ">
            <div class="p-2 mx-2 mt-2 mb-1">
                <InputLabel for="name" value="Nombre" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="nombre"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="p-2 mx-2 mt-2 mb-1">
                <InputLabel for="surname" value="Apellidos" />

                <TextInput
                    id="surname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.surname"
                    required
                    autocomplete="apellidos"
                />

                <InputError class="mt-2" :message="form.errors.surname" />
            </div>

            <div class="p-2 mx-2 mt-2 mb-1">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="p-2 mx-2 mt-2 mb-1">
                <InputLabel for="phone" value="Teléfono" />

                <TextInput
                    id="phone"
                    type="tel"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    required
                    autocomplete="telefono"
                />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="px-2 pt-0 mx-2 mt-2 mb-1">
                <InputLabel for="address" value="Dirección" />

                <TextInput
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    required
                    autocomplete="address"
                />

                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div class="px-2 pt-0 mx-2 mt-2 mb-1">
                <InputLabel for="city" value="Localidad" />

                <TextInput
                    id="city"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.city"
                    required
                    autocomplete="localidad"
                />

                <InputError class="mt-2" :message="form.errors.city" />
            </div>

            <div class="px-2 pt-0 mx-2 mt-2 mb-1">
                <InputLabel for="zip" value="Código Postal" />

                <TextInput
                    id="zip"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.zip"
                    
                    autocomplete="zip"
                />

                <InputError class="mt-2" :message="form.errors.zip" />
            </div>

            <div class="px-2 pt-0 mx-2 mt-2 mb-1">
                <InputLabel for="province" value="Provincia" />

                <TextInput
                    id="province"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.province"
                    
                    autocomplete="province"
                />

                <InputError class="mt-2" :message="form.errors.province" />
            </div>

            <div class="px-2 pt-2 pb-0 m-2 mb-0">
                <InputLabel for="country" value="País" />

                <TextInput
                    id="country"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.country"
                    
                    autocomplete="country"
                />

            </div>

            <div class="px-2 pt-2 pb-0 m-2 mb-4 col-span-1 row-span-2 ">
                <InputLabel for="photo" value="Foto" />

                <div v-if="props.user.photo">
                    <img :src="'storage/images/' + props.user.photo" width="100">
                </div>

                <input type="file" 
                        id="photo" 
                        @input="form.photo = $event.target.files[0]" 
                        class="mt-1 block w-full rounded-lg bg-gray-50"
                >
            </div>

            <div class="px-2 pt-2 pb-0 m-2 mb-0 col-span-1 col-start-3 ">
                <InputLabel for="job" value="Título" />

                <TextInput
                    id="job_title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.job"
                    
                    autocomplete="job"
                />

                
            </div>

            <div class="px-2 pt-2 pb-0 m-2 mb-0 col-span-1 col-start-4 ">
                <InputLabel for="web" value="Web" />

                <TextInput
                    id="web"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.web"
                    
                    autocomplete="web"
                />
                
            </div>

            <div class="flex items-center justify-start pt-3 m-2 row-start-4 ">


                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Guardar
                </PrimaryButton>
            </div>

            <div class="px-2 pt-1 pb-2 m-2 col-span-2 col-start-3">
                <InputLabel for="profile" value="Perfil" />

                <textarea id="profile" v-model="form.profile" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mt-1 block w-full"></textarea>

            </div>

        </div>

        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
          {{ form.progress.percentage }}%
        </progress>
    </form>
    
</template>

<style>

.borde {
    border: 1px solid red;
}

.bordenegro {
    border: 1px solid black;
}

</style>