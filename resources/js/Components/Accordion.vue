<script setup lang="ts">
import { ref } from 'vue';
import ChevronDownIcon from 'vue-material-design-icons/ChevronDown.vue';
import ClickScale from './Effects/ClickScale.vue';

const open = ref<boolean>(false);

const handleClick = () => {
    open.value = !open.value;
}

</script>


<template>
    <div
        :class="`w-full transition-all duration-500 delay-200 overflow-hidden ${open ? 'my-4 rounded-xl' : 'm-0 rounded-none'}`">
        <ClickScale class="w-full flex items-center cursor-pointer" :scale="0.99" @click="handleClick">
            <div class="flex-1">
                <slot name="head" />
            </div>
            <ChevronDownIcon class="transition-transform" :style="{ transform: `rotate(${open ? 180 : 0}deg)` }" />
        </ClickScale>
        <div :class="`w-full pl-5 transition-all duration-300 h-fit ${open ? 'max-h-[999px]' : 'max-h-0'}`">
            <slot />
        </div>
    </div>
</template>