<script setup lang="ts">
import { computed } from 'vue';
import InputLabel from '../InputLabel.vue';

const model = defineModel<string>();

const props = defineProps<{
    label?: string,
    placeholder?: string,
    resize?: 'none' | 'x' | 'y',
    error?: string | null,
}>();

const inputClass = computed(() => {
    var res = `w-full h-full bg-inherit flex-1`;

    res += props.error ? ' border-red-700 focus:border-red-700 focus:ring-red-700' : ' focus:border-primary-900 focus:ring-primary-900';

    res += props.resize ? ' resize-' + props.resize : '';

    return res;
});
</script>



<template>
    <div class="bg-inherit flex flex-col">
        <InputLabel v-if="label" :value="label" />
        <textarea v-model="model" :placeholder="placeholder" :class="inputClass" />
        <p v-if="error" class="text-xs text-red-500">
            {{ error }}
        </p>
    </div>
</template>