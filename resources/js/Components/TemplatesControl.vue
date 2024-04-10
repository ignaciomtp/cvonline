<script setup>

const props = defineProps({
    templates: Array,
    selected: Number,
});

const emit = defineEmits(['template-changed']);

const changeTemplate = (id) => {
	emit('template-changed', id);
}

</script>

<template>
	<div class="p-3">
		
		<button type="button" v-for="temp in templates" @click="changeTemplate(temp.id)" class="inline-block text-center max-w-sm p-6 bg-white rounded-lg shadow hover:bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-700 mr-3 btn-template " :class="{'active': temp.id == selected}"  :disabled="temp.id == selected">

			<img :src="'../storage/templates/' + temp.image" width="120">


			<p class="font-normal text-gray-700 dark:text-gray-400 mt-2">
				<strong>{{ temp.name }}</strong>
			</p>
		</button>



	</div>

</template>

<style>

.btn-template {
	height: 190px;
	width: 140px;
}

.active {
	border: 1px solid #F08080;
}

</style>