<script setup lang="ts">
import ImgMask from '@/Components/Input/ImageInput.vue';
import { ref } from 'vue';

const url = ref<string | null>(null);

const model = defineModel<string>();

const handleChange = (file: string, u: string) => {
    url.value = u;
    model.value = file;
}

</script>

<template>
    <div
        class="relative aspect-[2/3] overflow-hidden rounded-xl sm:rounded-2xl rounded-e-none sm:rounded-e-none border-[1px] border-primary">
        <ImgMask :style="{ opacity: url == null ? 1 : 0 }" class="absolute hover:!opacity-100 inset-0"
            @change="handleChange" />
        <img v-if="url" :src="url"
            class="rounded-xl sm:rounded-2xl rounded-e-none sm:rounded-e-none border-[2px] md:border-[6px] !border-surface-50" />
    </div>
</template>