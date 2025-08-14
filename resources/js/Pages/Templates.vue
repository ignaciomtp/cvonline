<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TemplateCard from '@/Components/TemplateCard.vue';
import { Head } from '@inertiajs/vue3';
import { initFlowbite, Modal } from 'flowbite';
import { ref, onMounted } from "vue";	


let props = defineProps({ templates: Array });

onMounted(() => {
	console.log(props.templates);
});


</script>

<template>
	<Head title="Dashboard" />

	<AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Plantillas</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-row flex-wrap bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                   
					<TemplateCard
                        title="Nueva Plantilla"
                        id="0"
                        color="green"
                        
                        
                    ></TemplateCard>                                
              
                    <div v-for="(template, index) in templates" :key="template.id" >
                        <TemplateCard
                            :name="template.title"
                            :id="template.id"
                            :num="index + 1"
                            :img="template.image"
                            color="blue"
                        ></TemplateCard>
                    </div>
                  
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>