<script setup>
import CheckedIcon from '@/Components/CheckedIcon.vue';
import { ref, onMounted } from "vue";

const props = defineProps({
	type_color: String,
	active_color: String,
});

const emit = defineEmits(['color-changed']);

const selectedColor = ref('');

const changeColor = (color) => {

	const colorElem = {
		color: color,
		type: props.type_color,
	};

	emit('color-changed', colorElem);

	selectedColor.value = color;
}

const currentColor = (color) => {
	return selectedColor.value == color;
}


onMounted(() => {
	selectedColor.value = props.active_color;
});

</script>

<template>

	<div class="m-2 p-2 inline-block minw">Color {{ type_color }}</div>

	<button type="button" @click="changeColor('dark')" class="text-white bg-[#131F2E] disabled:bg-[#131F2E] hover:bg-[#505C6E] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm p-2 me-2 mb-2 dark:bg-[#131F2E] dark:disabled:bg-[#131F2E] dark:hover:bg-[#505C6E] focus:outline-none dark:focus:ring-blue-800" :disabled="currentColor('dark')">
			<CheckedIcon v-if="currentColor('dark')" />
			<div v-else class="h20"></div>
	</button>

	<button type="button" @click="changeColor('blue')" class="text-white bg-[#168BA3] disabled:bg-[#037388] hover:bg-[#037388] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm p-2 me-2 mb-2 dark:bg-[#168BA3] dark:disabled:bg-[#037388] dark:hover:bg-[#037388] focus:outline-none dark:focus:ring-blue-800" :disabled="currentColor('blue')">
			<CheckedIcon v-if="currentColor('blue')" />
			<div v-else class="h20"></div>
	</button>

	<button type="button" @click="changeColor('gold')" class="text-white bg-[#AA9739] disabled:bg-[#806E16] hover:bg-[#806E16] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm p-2 me-2 mb-2 dark:bg-[#AA9739] dark:disabled:bg-[#806E16] dark:hover:bg-[#806E16] focus:outline-none dark:focus:ring-blue-800" :disabled="currentColor('gold')">
		<CheckedIcon v-if="currentColor('gold')" />
		<div v-else class="h20"></div>
	</button>

	<button type="button" @click="changeColor('grey')" class="text-white bg-[#AAB0B4] diabled:bg-[#838E96] hover:bg-[#838E96] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm p-2 me-2 mb-2 dark:bg-[#AAB0B4] dark:disabled:bg-[#838E96] dark:hover:bg-[#838E96] focus:outline-none dark:focus:ring-blue-800" :disabled="currentColor('grey')">
		<CheckedIcon v-if="currentColor('grey')" />
		<div v-else class="h20"></div>
	</button>

	<button type="button" @click="changeColor('black')" class="text-white bg-[#000000] diabled:bg-[#000000] hover:bg-[#838E96] focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm p-2 me-2 mb-2 dark:bg-[#000000] dark:disabled:bg-[#000000] dark:hover:bg-[#838E96] focus:outline-none dark:focus:ring-blue-800" :disabled="currentColor('black')">
		<CheckedIcon v-if="currentColor('black')" />
		<div v-else class="h20"></div>
	</button>
</template>

<style>
 .h20 {
 	height: 20px;
 	width: 20px;
 }	


 .minw{
 	min-width: 140px;
 }
</style>