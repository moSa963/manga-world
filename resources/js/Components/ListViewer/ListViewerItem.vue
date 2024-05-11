<script setup lang="ts">
import { interpolate } from '@/utils/Interpolator';

const props = defineProps<{
    index: number,
    animeRatio: number,
}>();

const emits = defineEmits<{
    mouseChange: [hovering: boolean],

}>();


const mouseChange = (v: boolean) => {
    emits('mouseChange', v);
}

const getZIndex = () => {
    return Math.abs((props.animeRatio > 30 ? props.index - 1 : props.index) - 3);
}

const getOpacity = () => {
    if (!(props.index === 0 || props.index === 6)) {
        return 1;
    }

    return interpolate(
        props.animeRatio,
        [0, 70],
        props.index === 0 ? [1, 0] : [0, 1]
    );
}

const getBrightness = () => {

    return `brightness(${interpolate(
        Math.abs(props.index - 3) + (((Math.abs(props.index - 4) > Math.abs(props.index - 3)) ? 1 : -1) * (props.animeRatio / 100)),
        [0, 1, 2, 3],
        [0.4, 0.6, 0.8, 1]
    )})`;
}

const getHeight = () => {
    return `${interpolate(
        props.index > 1 ? 0 : (props.index == 0 ? 100 - props.animeRatio : props.animeRatio),
        [0, 100], [35, 100]
    )}%`;
}

const translateX = () => {
    return `${interpolate(
        props.animeRatio,
        [0, 100],
        [props.index == 6 ? 300 : props.index * 40, props.index === 0 ? -300 : (props.index - 1) * 40]
    )}%`;
}

const translateY = () => {
    return `${interpolate(
        props.animeRatio,
        [0, 100],
        [props.index * 50, props.index == 0 ? 30 : (props.index - 1) * 50]
    )}%`
}

const translateZ = () => {
    return `${-Math.abs(interpolate(
        props.animeRatio,
        [0, 100],
        [props.index * -100, (props.index - 1) * -100]
    ))}px`
}
</script>



<template>
    <div @mouseenter="() => mouseChange(true)" @mouseleave="() => mouseChange(false)"
        class="absolute w-full h-40 border-[1px] border-divider shadow-xl rounded-xl overflow-hidden hover:after:absolute hover:after:inset-0 hover:after:bg-divider/15 hover:after:pointer-events-none cursor-pointer"
        :style="{
            zIndex: getZIndex(),
            opacity: getOpacity(),
            filter: getBrightness(),
            transform: `translateX(${translateX()}) translateY(${translateY()}) translateZ(${translateZ()})`,
            height: getHeight(),
        }">

        <div class="relative w-full h-full">
            <slot />
        </div>
    </div>
</template>