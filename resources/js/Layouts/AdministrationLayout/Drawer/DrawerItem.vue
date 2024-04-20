<script setup lang="ts">
import ClickScale from '@/Components/Effects/ClickScale.vue';
import { ScreenInfo } from '@/types';
import { router } from '@inertiajs/vue3';
import { inject } from 'vue';

const props = defineProps<{
    title: string,
    selected?: boolean,
    href?: string,
}>();

const screen = inject<ScreenInfo>("screenInfo");

const handleClick = () => {
    if (props.href) {
        router.get(props.href);
    }
}

</script>



<template>
    <ClickScale @click="handleClick">
        <div :class="`w-full p-4 flex gap-2 ${selected ? 'bg-surface-0' : 'bg-surface-200'}`">
            <slot />
            <p v-if="screen?.size !== 'sm'">{{ title }}</p>
        </div>
    </ClickScale>
</template>