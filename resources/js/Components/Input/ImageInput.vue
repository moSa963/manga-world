<script setup lang="ts">
import ImagePlusIcon from 'vue-material-design-icons/ImagePlus.vue';

const emit = defineEmits<{
    change: [file: string, url: string],
}>();


const handleClick = (e: MouseEvent) => {
    ((e.currentTarget as HTMLElement).children[0] as HTMLElement).click();
}

const handleChange = (e: Event) => {
    const file = (e.currentTarget as HTMLFormElement).files[0]

    if (!file) return;

    emit('change', file, URL.createObjectURL(file));
}
</script>

<template>
    <div @click.self="handleClick"
        class="flex justify-center items-center bg-gray-900/75 cursor-pointer text-white select-none">
        <input type="file" accept="Image/*" class="hidden" @change="handleChange" />
        <ImagePlusIcon size="100px" class="pointer-events-none" />
    </div>
</template>