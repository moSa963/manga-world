<script setup lang="ts">
import { interpolate } from '@/utils/Interpolator';
import { computed, onMounted, ref, watch } from 'vue';

const num = ref(0);
const hover = ref(false);
const index = ref(0);
var key: number | undefined;

const props = defineProps<{
    data: Array<any>,
}>();

watch(index, () => {
    index.value %= props.data.length;

    animateTo(num.value, index.value * 100);
});

const animateTo = (c: number, n: number) => {
    var counter = 0;
    clearInterval(key);

    key = setInterval(() => {
        counter += 1;
        num.value = interpolate(counter, [0, 100], [c, n]);

        if (counter == 100) {
            clearInterval(key);
        }
    }, 10);
}

onMounted(() => {
    setInterval(() => {
        if (!hover.value) {
            index.value++;
        }
    }, 3000);
});

const animData = computed(() => {
    return {
        ratio: num.value % 100,
        currentIndex: (i: number) => (Math.floor(num.value / 100) + i) % props.data.length,
    };
});

const handleClick = (i: number) => {
    index.value = i;
}

const handleEnter = () => {
    hover.value = true;
}

const handleLeave = () => {
    hover.value = false;
}

const getOpacity = (i: number) => {
    if (!(i === 0 || i === 6)) {
        return 1;
    }

    return interpolate(
        animData.value.ratio,
        [0, 70],
        i === 0 ? [1, 0] : [0, 1]
    );
}
</script>



<template>
    <div class="relative w-full flex flex-col justify-center items-center overflow-hidden">
        <div class="w-full max-w-md aspect-square">
            <div class="relative w-full aspect-square" style="perspective: 800px;">

                <div v-for="(v, i) in [0, 1, 2, 3, 4, 5, 6]" @mouseenter="() => handleEnter()"
                    @mouseleave="() => handleLeave()" @click="() => handleClick(animData.currentIndex(i))"
                    class="absolute w-full h-40 border-[1px] border-divider shadow-xl rounded-xl overflow-hidden hover:after:absolute hover:after:inset-0 hover:after:bg-divider/15 cursor-pointer"
                    :style="{
                        zIndex: Math.abs(((animData.ratio) > 30 ? i - 1 : i) - 3),
                        opacity: getOpacity(i),
                        filter: `brightness(${interpolate(Math.abs(i - 3) + (((Math.abs(i - 4) > Math.abs(i - 3)) ? 1 : -1) * ((animData.ratio) / 100)), [0, 1, 2, 3], [0.4, 0.6, 0.8, 1])})`,
                        transform: `
                                    translateX(${interpolate(animData.ratio, [0, 100], [i == 6 ? 300 : i * 40, i === 0 ? -300 : (i - 1) * 40])}%) 
                                    translateY(${interpolate(animData.ratio, [0, 100], [i * 50, i == 0 ? 30 : (i - 1) * 50])}%) 
                                    translateZ(${-Math.abs(interpolate(animData.ratio, [0, 100], [i * -100, (i - 1) * -100]))}px)
                                `,

                        height: `${interpolate(i > 1 ? 0 : (i == 0 ? 100 - animData.ratio : animData.ratio), [0, 100], [35, 100])}%`,
                    }">

                    <div class="relative w-full h-full">
                        <slot :value="data[animData.currentIndex(i)]" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>