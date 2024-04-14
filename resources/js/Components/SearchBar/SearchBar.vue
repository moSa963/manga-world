<script setup lang="ts">
import Magnify from 'vue-material-design-icons/Magnify.vue';
import Close from 'vue-material-design-icons/Close.vue';
import { ref } from 'vue';
import SearchField from './SearchField.vue';

const input = ref("");

const props = defineProps<{
    open: boolean,
}>();

const emits = defineEmits<{
    statusChange: [value: boolean],
    change: [string]
}>();

const handleClick = () => {
    input.value = "";
    emits("statusChange", props.open);
}

const handelChange = (val: string) => {
    emits("change", val);
}

</script>

<template>
    <div :style="{ width: open ? '100%' : '0px', minWidth: 'fit-content' }"
        class="relative border-inherit transition-[width] w-full max-w-sm flex">
        <div :style="{ borderWidth: open ? '1px' : '0px' }"
            :class="`w-full flex bg-transparent border-inherit !border-b-0 rounded-t-lg select-none overflow-hidden`">

            <SearchField :style="{ width: open ? '100%' : '0px' }" @change="handelChange" v-model="input" />

            <div @click="handleClick" class="h-full aspect-square p-1 sm:p-3 cursor-pointer hover:bg-divider/15">
                <Magnify v-if="!open" size="100%" />
                <Close v-else size="100%" />
            </div>
        </div>

        <slot v-if="open" />
    </div>
</template>