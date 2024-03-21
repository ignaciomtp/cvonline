<script setup>
const props = defineProps({
    skill: Object,
});

const emit = defineEmits(['element-deleted', 'bd-updated']);

const deleteSkill = () => {
    console.log(props.skill.id);

    axios.post('deleteskill/' + props.skill.id, {
      _method: 'DELETE'
    })
    .then( response => {
       console.log(response);

       const item = {
             section: 'skills',
             id: props.skill.id
        };

       emit('element-deleted', item);
       emit('bd-updated');
    })
    .catch( error => {
       console.log(error);
    })
}

</script>
<template>
	<div class="m-2 inline-block">
        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 ">{{ skill.name }} 
            <button type="button" class="btn-badge " @click="deleteSkill">
                <span class="t">Remove</span><svg viewBox="0 0 14 14" class="ns ru apn bqt"><path d="M4 4l6 6m0-6l-6 6"></path></svg><span class="aa af"></span>
            </button>
        </span>
    </div>
</template>


<style scoped>
    
.btn-badge{
    -webkit-appearance: button;
    background-color: transparent;
    background-image: none;
    position: relative;
    margin-right: -0.25rem;
    margin-left: 1rem;
    height: 1.5rem;
    width: 1.5rem;
    border-radius: 0.125rem;   

}

.btn-badge:hover{
    background-color: rgb(22 163 74 / 0.3);
}


.t {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
}

.apn {
    stroke: rgb(21 128 61 / 0.5);
}

.ru {
    width: 0.975rem;
}

.ns {
    height: 0.975rem;
}

svg {
    display: block;
    vertical-align: middle;
    margin-left: auto;
    margin-right: auto;
}

.af {
    inset: -0.25rem;
}
.aa {
    position: absolute;
}


</style>