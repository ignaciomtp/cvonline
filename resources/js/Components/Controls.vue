<script setup>

const props = defineProps({
	active_color: String,
});

const emit = defineEmits(['color-changed']);

const changeColor = (color) => {
	emit('color-changed', color);
}

const currentColor = (color) => {
	return props.active_color == color;
}

</script>

<template>
	<button type="button" @click="changeColor('blue')" class="text-white bg-[#168BA3] disabled:bg-[#037388] hover:bg-[#037388] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-[#168BA3] dark:disabled:bg-[#037388] dark:hover:bg-[#037388] focus:outline-none dark:focus:ring-blue-800" :disabled="currentColor('blue')">Azul</button>

	<button type="button" @click="changeColor('gold')" class="text-white bg-[#AA9739] disabled:bg-[#806E16] hover:bg-[#806E16] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-[#AA9739] dark:disabled:bg-[#806E16] dark:hover:bg-[#806E16] focus:outline-none dark:focus:ring-blue-800" :disabled="currentColor('gold')">Oro</button>

	<button type="button" @click="changeColor('grey')" class="text-white bg-[#AAB0B4] diabled:bg-[#838E96] hover:bg-[#838E96] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-[#AAB0B4] dark:disabled:bg-[#838E96] dark:hover:bg-[#838E96] focus:outline-none dark:focus:ring-blue-800" :disabled="currentColor('grey')">Gris</button>
</template>

<style>
	
</style>