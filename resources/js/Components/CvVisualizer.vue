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
	route.value = '/viewcv/' + props.cv_id;
});

</script>

<template>
	<iframe :src="route"
			id="cvframe"
			width="100%" 
			height="600"
	>
		
	</iframe>
</template>