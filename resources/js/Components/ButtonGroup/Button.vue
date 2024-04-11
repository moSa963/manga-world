<script setup lang="ts">
import ClickRipple from '../Effects/ClickRipple.vue';


defineProps<{
    disabled?: boolean | null,
    border?: boolean
}>();

defineEmits<{
    click: [],
}>();

</script>


<template>
    <ClickRipple @click="$emit('click')" class="rounded-xl" :disabled="disabled">
        <div
            :class="`relative flex justify-center items-center cursor-pointer p-1 py-2 hover:bg-primary-400/10 transition-colors border-primary-100/75 select-none overflow-hidden ${border ? 'rounded-xl border-[1px]' : ''}`">

            <slot />
        </div>
    </ClickRipple>
</template>
