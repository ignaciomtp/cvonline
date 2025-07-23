<script setup>
import SkillElement from '@/Components/SkillElement.vue';
import SkillBadge from '@/Components/SkillBadge.vue';
import ToggleVisible from '@/Components/ToggleVisible.vue';

let props = defineProps({
	cv: Object,
	visible: Boolean,
	skills: Array
});

const emit = defineEmits([
	'toggled-section', 
	'bd-updated', 
	'skill-added',
	'skill-removed'
]);

const toggleSection = (section) => {
	emit('toggled-section', section);
}

const updateDB = () => {
	emit('bd-updated');
}

const addSkill = (skill) => {
	emit('skill-added', skill);
}

const removeSkill = (skill) => {
	emit('skill-removed', skill);
}

</script>

<template>
    <div class="p-6 text-gray-900 dark:text-gray-100">

        <div class="flex">
            <div class="flex-auto w-1/4">
                <ToggleVisible 
                    :visible="visible"
                    :section="'skills'"
                    @toggle-included-section="toggleSection"
                />  
            </div>
            <div class="flex-auto w-2/4">
                <p>Aquí puedes introducir tus habilidades relativas al puesto, y tu nivel en cada una.</p>
            </div>
            <div class="flex-auto w-1/4 text-right mb-4">


           </div>
        </div>  

        <div class="m-1">
            <SkillElement 
                :resume_id="cv.id"
                @skill-added="addSkill"
                @bd-updated="updateDB"
            />                   
        </div> 

        <div class="my-5 mx-2">
            <span v-for="(item, index) in skills" :key="index + 1">
                <SkillBadge 
                    :skill="item"
                    :resume_id="cv.id"
                    @element-deleted="removeSkill"
                    @bd-updated="updateDB"
                />
            </span>
        </div>                    

    </div>
</template>