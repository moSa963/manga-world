<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import InputLabel from '../../InputLabel.vue';

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

const props = defineProps<{
    label?: string,
    placeholder?: string,
    type?: string,
    error?: string | null,
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

const inputClass = computed(() => {
    var res = "w-full border-divider rounded-md shadow-sm bg-inherit ";

    if (props.error) {
        return res + "border-red-700 focus:border-red-700 focus:ring-red-700"
    }

    return res + "focus:border-primary-900 focus:ring-primary-900";
});

</script>

<template>
    <div class="bg-inherit border-none">
        <InputLabel v-if="label" :value="label" />
        <input :placeholder="placeholder" :type="type" :class="inputClass" v-model="model" ref="input"
            @keypress="handelKey" />
        <p v-if="error" class="text-xs text-red-500">
            {{ error }}
        </p>
    </div>
</template>
