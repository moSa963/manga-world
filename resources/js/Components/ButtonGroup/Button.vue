<script setup lang="ts">
import ClickRipple from '../Effects/ClickRipple.vue';


const emits = defineEmits<{
    click: [],
}>();

</script>


<template>
    <ClickRipple>
        <div
            class="relative flex justify-center items-center cursor-pointer p-1 py-2 rounded-lg hover:bg-primary-400/10 transition-colors border-primary-100/75 select-none overflow-hidden ">

            <slot />
        </div>
    </ClickRipple>
</template>
