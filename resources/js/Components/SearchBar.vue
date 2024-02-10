<script setup lang="ts">
import Magnify from 'vue-material-design-icons/Magnify.vue';
import Close from 'vue-material-design-icons/Close.vue';

const props = defineProps<{
    open: boolean,
}>();

const emits = defineEmits<{
    change: [value: boolean],
}>();

const handleClick = () => {
    emits("change", props.open);
}
</script>

<template>
    <div :style="{ width: open ? '100%' : '0px', minWidth: 'fit-content' }"
        class="relative border-inherit transition-[width] w-full max-w-sm flex">
        <div :style="{ borderWidth: open ? '1px' : '0px' }"
            :class="`w-full flex bg-transparent border-inherit !border-b-0 rounded-t-lg select-none overflow-hidden`">

            <div :style="{ width: open ? '100%' : '0px' }" class="flex-1 h-full overflow-hidden">
                <input type="text" placeholder="Serach..."
                    class="w-full h-full p-2 bg-inherit border-none -outline-offset-2 focus:outline-0 overflow-hidden" />
            </div>

            <div @click="handleClick"
                class="h-full aspect-square p-1 sm:p-3 cursor-pointer hover:bg-divider hover:bg-opacity-15">
                <Magnify v-if="!open" size="100%" />
                <Close v-else size="100%" />
            </div>

        </div>
    </div>
</template>