<script setup>
import { ref, onMounted, onUpdated } from "vue";


let props = defineProps({
    updated: Boolean,
    cv_id: String,
});

const emit = defineEmits(['view-updated']);

const route = ref('');

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
	<iframe :src="route"
			id="cvframe"
			width="100%" 
			height="600"
			class="scaled-iframe" 
	>
		
	</iframe>
</template>

<style>
.scaled-iframe {
    width: 140%;
    height: 100%;
    border: none;
    transform: scale(0.75);
    transform-origin: top left; /* Asegura que el escalado comience desde la esquina superior izquierda */
}
</style>