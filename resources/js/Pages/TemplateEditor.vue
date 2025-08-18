<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import NumberInput from '@/Components/NumberInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { initFlowbite, Modal } from 'flowbite';
import { ref, onMounted } from "vue";	

const props = defineProps({ 
    template: Object,
    settings: Object,
});


const form = useForm({
    name: props.template.name,

});

const form2 = useForm({
    id: props.settings.id,
    template_id: props.settings.template_id,
    base_font_size: props.settings.base_font_size,
    base_line_height: props.settings.base_line_height,
    name_size: props.settings.name_size,
    name_line_height: props.settings.name_line_height,
    job_size: props.settings.job_size,
    job_line_height: props.settings.job_line_height,
    section_size: props.settings.section_size,
    sidebar_section_size: props.settings.sidebar_section_size,
    sidebar_font_size: props.settings.sidebar_font_size,
    sidebar_line_height: props.settings.sidebar_line_height,
    address_size: props.settings.address_size,
    address_line_height: props.settings.address_line_height,
    section_separation: props.settings.section_separation,
    photo_height: props.settings.photo_height,
});

const updateSettings = () => {

    const formRoute = 'updatesettings';

    let settings = form2;

    axios.post(formRoute, settings)
        .then(function (response) {
            console.log(response);

        })
        .catch(function (error) {
            console.log(error);
        });

}


</script>

<template>
	<Head title="Dashboard" />

	<AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Editar Plantilla</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-row flex-wrap bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class=" bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="grid grid-cols-2 ">
                            <div>
                                <form @submit.prevent="submit" enctype="multipart/form-data">                    
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
                                    
                                </form>                                
                            </div>

                            <div>
                                <form @submit.prevent="submit" enctype="multipart/form-data">
                                    <div class="grid grid-cols-3 ">
                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="base_font_size" value="Base Font Size" />
                                            <NumberInput
                                                id="base_font_size"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.base_font_size"
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="base_line_height" value="Base Line Height" />
                                            <NumberInput
                                                id="base_line_height"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.base_line_height"
                                                autofocus
                                               
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="name_size" value="Name Size" />
                                            <NumberInput
                                                id="name_size"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.name_size"
                                                
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="name_line_height" value="Name Line Height" />
                                            <NumberInput
                                                id="name_line_height"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.name_line_height"
                                                
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="job_size" value="Job Size" />
                                            <NumberInput
                                                id="job_size"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.job_size"
                                                
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="job_line_height" value="Job Line Height" />
                                            <NumberInput
                                                id="job_line_height"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.job_line_height"
                                                
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="section_size" value="Section Size" />
                                            <NumberInput
                                                id="section_size"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.section_size"                                               
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="sidebar_section_size" value="Sidebar Section Size" />
                                            <NumberInput
                                                id="sidebar_section_size"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.sidebar_section_size"                                               
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="sidebar_font_size" value="Sidebar Font Size" />
                                            <NumberInput
                                                id="sidebar_font_size"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.sidebar_font_size"                                               
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="sidebar_line_height" value="Sidebar Line Height" />
                                            <NumberInput
                                                id="sidebar_line_height"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.sidebar_line_height"                                               
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="address_size" value="Address Size" />
                                            <NumberInput
                                                id="address_size"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.address_size"                                               
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="address_line_height" value="Address Line Height" />
                                            <NumberInput
                                                id="address_line_height"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.address_line_height"                                               
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="section_separation" value="Section Separation" />
                                            <NumberInput
                                                id="section_separation"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.section_separation"                                               
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="photo_height" value="Photo Height" />
                                            <NumberInput
                                                id="photo_height"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.photo_height"                                               
                                                autofocus
                                                
                                            />                                   
                                        </div>

                                        <div class="p-2 mx-2 mt-2 mb-1">
                                            <InputLabel for="id_set" value="Id" />
                                            <NumberInput
                                                id="id_set"
                                                type="number"
                                                class="mt-1 block w-full"
                                                v-model="form2.id"
                                                disabled                                       
                                                autofocus
                                                
                                            />                                   
                                        </div>
                                    </div>

                                    <div class="p-2 mx-2 mt-2 mb-1">
                                        <button data-tooltip-placement="bottom" @click="updateSettings" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-3 py-2.5 mx-1 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Actualizar
                                        </button>
                                    </div>
                                </form>                                
                            </div>

                        </div>

                    </div>
                  
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>