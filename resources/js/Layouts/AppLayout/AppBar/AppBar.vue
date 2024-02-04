<script setup lang="ts" >
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import WindowScroll, { ScrollType } from '@/Components/WindowScroll.vue';
import { interpolate } from '@/utils/Interpolator';
import { ref } from 'vue';
import AppBarTools from './AppBarTools.vue';


const p = ref<ScrollType>({
    value: 0,
    ratio: 0,
    innerHeight: 0,
});

const handleChange = (scroscroll: ScrollType) => {
    p.value = scroscroll;
}

</script>



<template>
    <WindowScroll @change="handleChange">
        <div class="sticky top-0 flex w-full h-32 ">
            <div class="w-full h-12 flex justify-center items-center border-black border-b-[1px]"
                :style="{ margin: `${interpolate(p.value, [0, 150], [30, 0])}px` }">

                <AppBarTools />

                <ApplicationLogo class="h-48 fill-current text-primary-500"
                    :style="{ transform: `scale(${interpolate(p.value, [0, 150], [1, 0.5])})`, }" />

                <div class="h-full flex flex-1 justify-end">

                </div>
            </div>
        </div>
    </WindowScroll>
</template>