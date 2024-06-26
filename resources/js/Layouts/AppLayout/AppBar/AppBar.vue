<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import WindowScroll, { ScrollType } from '@/Components/WindowScroll.vue';
import { interpolate } from '@/utils/Interpolator';
import { ref } from 'vue';
import AppBarTools from './AppBarTools.vue';
import AppBarAuthItem from './AppBarAuthItem.vue';
import ThemeButton from '@/Components/ThemeButton.vue';
import { inject } from 'vue';
import { ScreenInfo } from '@/types';
import Search from './Search.vue';


const p = ref<ScrollType>({
    value: 0,
    ratio: 0,
    innerHeight: 0,
});

const searchOpen = ref(false);

const props = defineProps<{
    themeMode: "dark" | "light",
    hidden?: boolean,
}>();

const emits = defineEmits<{
    "themeChange": [mode: string],
}>();

const handleChange = (scroll: ScrollType) => {
    p.value = scroll;

}
const handleThemeChange = () => {
    emits("themeChange", props.themeMode);
}

const handleOpenChange = (v: boolean) => {
    searchOpen.value = v;
}

const screen = inject<ScreenInfo>("screenInfo");

</script>



<template>
    <WindowScroll @change="handleChange">
        <div class="sticky top-0 flex w-full h-24 sm:h-32 z-50 pointer-events-none transition-transform"
            :style="{ transform: `translateY(${hidden ? -100 : 0}%)`, }">
            <div :class="`w-full h-10 sm:h-14 flex justify-center items-center border-primary border-b-[1px] pointer-events-auto ${p.value > 150 ? '' : ''}`"
                :style="{
                    margin: `${interpolate(p.value, [0, 150], [screen?.size == 'sm' ? 15 : 30, 0])}px`,
                    borderColor: `rgb(var(--border-primary) / ${interpolate(p.value, [0, 150], [1, 0])}`,
                    backgroundColor: `rgb(var(--surface-0) / ${interpolate(p.value, [0, 150], [0, 1])}`
                }">

                <AppBarTools v-if="!searchOpen || (screen?.size !== 'sm')"
                    :ratio="interpolate(p.value, [0, 150], [1, 0])" />

                <div class="h-32 sm:h-56 pointer-events-none"
                    :style="{ transform: `scale(${interpolate(p.value, [0, 150], [1, 0.5])})`, }">
                    <ApplicationLogo class="w-full h-full text-primary-500 fill-current" />
                </div>

                <div class="h-full flex flex-1 justify-end border-inherit">

                    <Search :open="searchOpen" @open-change="handleOpenChange" />

                    <ThemeButton v-if="!searchOpen" :mode="themeMode" @change="handleThemeChange" />
                    <AppBarAuthItem v-if="!searchOpen" />
                </div>
            </div>
        </div>
    </WindowScroll>
</template>