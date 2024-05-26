<script setup lang="ts">
import ClickRipple from '../Effects/ClickRipple.vue';


defineProps<{
    disabled?: boolean | null,
    border?: boolean,
    value?: string
}>();

defineEmits<{
    click: [MouseEvent],
}>();

</script>


<template>
    <ClickRipple @click="(e) => $emit('click', e)" class="rounded-xl" :disabled="disabled">
        <div
            :class="`relative flex justify-center items-center cursor-pointer p-1 py-2 hover:bg-primary-400/10 transition-colors border-surface-900 select-none overflow-hidden ${border ? 'rounded-xl border-[1px]' : ''}`">
            <p v-if="value" class="font-bold text-xl">{{ value }}</p>
            <slot v-else />
        </div>
    </ClickRipple>
</template>
