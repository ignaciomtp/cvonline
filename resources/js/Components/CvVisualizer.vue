<script setup>
import { ref, onMounted, onUpdated } from "vue";
import CvSettingsEditor from '@/Components/CvSettingsEditor.vue';


let props = defineProps({
    updated: Boolean,
    cv_id: String,
    settings: Object,
});

const cvSettings = [
	{
		label: 'Tamaño Nombre',
		field: 'name_size',
	},
	{
		label: 'Tamaño línea Nombre',
		field: 'name_line_height',
	},
	{
		label: 'Tamaño Profesión',
		field: 'job_size',
	},
	{
		label: 'Tamaño línea Profesión',
		field: 'job_line_height',
	},
	{
		label: 'Tamaño Fuente',
		field: 'base_font_size',
	},
	{
		label: 'Tamaño línea',
		field: 'base_line_height',
	},
	{
		label: 'Tamaño Contacto',
		field: 'address_size',
	},
	{
		label: 'Tamaño línea Contacto',
		field: 'address_line_height',
	},
	{
		label: 'Tamaño Nombre Sección',
		field: 'section_size',
	},
	{
		label: 'Tamaño fuente Sidebar',
		field: 'sidebar_font_size',
	},
	{
		label: 'Tamaño línea Sidebar',
		field: 'sidebar_line_height',
	},
	{
		label: 'Tamaño Nombre Sección Sidebar',
		field: 'sidebar_section_size',
	},
	{
		label: 'Alto Foto',
		field: 'photo_height',
	},
	{
		label: 'Separación Secciones',
		field: 'section_separation',
	}
];

const emit = defineEmits(['view-updated']);

const route = ref('');

const selectedSetting = ref(null);

const routedown = '/viewcv/' + props.cv_id;

const settingSelected = (field) => {
	const value = props.settings[field];
	selectedSetting.value = value;
}

const newValue = (newVal) => {
	console.log('Old value: ', selectedSetting.value);
	console.log('New value: ', newVal);
}

onUpdated(() => {

	if(props.updated) {
		document.getElementById('cvframe').contentWindow.location.reload(true);
		emit('view-updated');
	}
});

onMounted(() => {
	route.value = '/viewcv2/' + props.cv_id;

});

</script>

<template>
	<div >

		<CvSettingsEditor 
			:cvSettings="cvSettings" 
			@setting-selected="settingSelected" 
			@setting-changed="newValue"
			:value="selectedSetting" />

		
		<div class=" mt-2 mb-4">
			<a :href="routedown" download="CustomFileName.pdf" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:disabled:bg-blue-700">Descargar</a>
		</div>
	</div>

		

		<iframe :src="route"
				id="cvframe"
				width="95%" 
				height="430"
				class="scaled-iframe overflow-hidden" 
		>		
		</iframe>		

</template>

<style>
.scaled-iframe {
    width: 160%;
    height: 100%;
    border: none;
    transform: scale(0.62);
    transform-origin: top left; /* Asegura que el escalado comience desde la esquina superior izquierda */
}
</style>