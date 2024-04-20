<script setup lang="ts">
import { onMounted, ref } from 'vue';
import Layout from '../Layout.vue';
import Drawer from './Drawer/Drawer.vue';
import { ScrollType } from '@/Components/WindowScroll.vue';
import ScrollableBox from '@/Components/ScrollableBox.vue';

const theme = ref<"light" | "dark">("dark");

defineProps<{
    selected: 'users' | 'series',
}>();

onMounted(() => {
    theme.value = window.localStorage.getItem("theme") == "light" ? "light" : "dark";
});

const emits = defineEmits<{
    "scroll": [scroll: ScrollType],
}>();

</script>

<template>
    <Layout>
        <div :class="`${theme} w-screen h-screen flex flex-col bg-surface-300 text-primary overflow-hidden`">
            <div class="w-full px-2 bg-surface-100">
                <p class="text-3xl p-2  font-serif text-divider">Administration</p>
            </div>
            <div class="flex flex-1 overflow-hidden">
                <Drawer :selected="selected" />
                <ScrollableBox class="flex-1 bg-surface-0 flex justify-center h-full overflow-auto px-4"
                    @scroll="(e) => $emit('scroll', e)">
                    <div class="w-full max-w-6xl ">
                        <slot />
                    </div>
                </ScrollableBox>
            </div>
        </div>
    </Layout>
</template>