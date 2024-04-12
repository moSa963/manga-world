<script setup lang="ts">
import { onMounted, ref } from 'vue';
import InputLabel from './InputLabel.vue';

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

defineProps<{
    label?: string,
    placeholder?: string,
    type?: string,
}>();

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });

const emit = defineEmits<{
    enterPress: [],
}>();

const handelKey = (e: KeyboardEvent) => {
    if (e.key !== "Enter") return;

    emit('enterPress');
}
</script>

<template>
    <div class="bg-inherit border-none">
        <InputLabel v-if="label" :value="label" />
        <input :placeholder="placeholder" :type="type"
            class="w-full border-divider focus:border-primary-900 focus:ring-primary-900 rounded-md shadow-sm bg-inherit"
            v-model="model" ref="input" @keypress="handelKey" />
    </div>
</template>
