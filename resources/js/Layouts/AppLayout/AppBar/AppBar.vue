<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import WindowScroll, { ScrollType } from '@/Components/WindowScroll.vue';
import { interpolate } from '@/utils/Interpolator';
import { ref } from 'vue';
import AppBarTools from './AppBarTools.vue';
import AppBarAuthItem from './AppBarAuthItem.vue';
import ThemeButton from '@/Components/ThemeButton.vue';
import SearchBar from '@/Components/SearchBar.vue';
import { inject } from 'vue';
import { ScreenInfo } from '@/types';


const p = ref<ScrollType>({
    value: 0,
    ratio: 0,
    innerHeight: 0,
});

const searchOpen = ref(false);

const props = defineProps<{
    "themeMode": "dark" | "light",
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

const handleSearchChange = () => {
    searchOpen.value = !searchOpen.value;
}

const screen = inject<ScreenInfo>("screenInfo");

</script>



<template>
    <WindowScroll @change="handleChange">
        <div class="sticky top-0 flex w-full h-24 sm:h-32 z-50">
            <div :class="`w-full h-10 sm:h-14 flex justify-center items-center border-primary border-b-[1px] ${p.value > 150 ? 'shadow-sm' : ''}`"
                :style="{
        margin: `${interpolate(p.value, [0, 150], [screen?.size == 'sm' ? 15 : 30, 0])}px`,
        borderColor: `rgb(var(--border-primary) / ${interpolate(p.value, [0, 150], [1, 0])}`,
        backgroundColor: `rgb(var(--surface-0) / ${interpolate(p.value, [0, 150], [0, 1])}`
    }">

                <AppBarTools v-if="!searchOpen || (screen?.size !== 'sm')"
                    :ratio="interpolate(p.value, [0, 150], [1, 0])" />

                <div class="h-[300%] sm:h-[400%] aspect-square"
                    :style="{ transform: `scale(${interpolate(p.value, [0, 150], [1, 0.5])})`, }">
                    <ApplicationLogo class="w-full h-full text-primary-500 fill-current" />
                </div>

                <div class="h-full flex flex-1 justify-end border-inherit">
                    <SearchBar :open="searchOpen" @change="handleSearchChange" />
                    <ThemeButton v-if="!searchOpen" :mode="themeMode" @change="handleThemeChange" />
                    <AppBarAuthItem v-if="!searchOpen" />
                </div>
            </div>
        </div>
    </WindowScroll>
</template>