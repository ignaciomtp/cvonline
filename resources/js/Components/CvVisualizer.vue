<script setup>
import { ref, onMounted, onUpdated } from "vue";


let props = defineProps({
    updated: Boolean,
    cv_id: String,
});

const emit = defineEmits(['view-updated']);

const route = ref('');

const routedown = '/viewcv/' + props.cv_id;

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

		<div class=" p-3 ">
			<a :href="routedown" download="CustomFileName.pdf" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:disabled:bg-blue-700">Descargar</a>
		</div>

		<iframe :src="route"
				id="cvframe"
				width="100%" 
				height="600"
				class="scaled-iframe overflow-hidden" 
		>		
		</iframe>		

</template>

<style>
.scaled-iframe {
    width: 133%;
    height: 100%;
    border: none;
    transform: scale(0.75);
    transform-origin: top left; /* Asegura que el escalado comience desde la esquina superior izquierda */
}
</style>