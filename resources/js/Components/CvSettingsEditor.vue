<script setup>
import { ref, onUpdated, watch } from "vue";

let props = defineProps({
	cvSettings: Array,
	value: Number,
	templateChanged: Boolean,
});

const emit = defineEmits(['setting-selected', 'setting-changed']);

const selectId = ref(null);
const quantInput = ref(null);
const localValue = ref(props.value); // Variable reactiva para el valor del input

// Sincroniza localValue con props.value cuando props.value cambia
watch(() => props.value, (newValue) => {
	console.log('local value changed');
  localValue.value = newValue;
});

const settingSelected = () => {
  emit("setting-selected", selectId.value.value);
};

const applyNewValue = () => {
  emit("setting-changed", {
    field: selectId.value.value,
    value: quantInput.value.value,
  });
};

onUpdated(() => {
  if (props.templateChanged) {
    selectId.value.value = "null";
    localValue.value = null; // Limpia el valor del input
    quantInput.value.value = null; // Limpia el valor del elemento DOM
    
  }
});
</script>

<template>


<div class="flex">
  <div class="w-40 flex-none my-2">
  	<select id="selectId" ref="selectId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" @change="settingSelected">
  		<option value="null">--</option>
		<option v-for="(set, index) in cvSettings" :key="index" :value="set.field">{{ set.label }}</option>
	</select>	
  </div>
  <div class="w-30 flex-auto my-2 px-2">
		<div class="relative flex items-center max-w-[8rem]">
	        <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
	            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
	                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
	            </svg>
	        </button>
	        <input type="text" id="quantity-input" ref="quantInput" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" :value="localValue" @input="localValue = $event.target.value" />
	        <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
	            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
	                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
	            </svg>
	        </button>
	    </div>
  </div>
  <div class="w-10 flex-auto my-2 text-right">
  	<button type="button" class="text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 dark:disabled:bg-green-700" @click="applyNewValue">Aplicar</button>
  </div>
</div>




</template>