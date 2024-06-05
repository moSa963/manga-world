<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import InputLabel from '../../InputLabel.vue';
import TextInputHintsCard from './TextInputHintsCard.vue';

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);
const focus = ref<boolean>();

const props = defineProps<{
    label?: string,
    placeholder?: string,
    type?: string,
    error?: string | null,
    hints?: string[],
    strict?: boolean,
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

const hints = computed(() => {
    const res = props?.hints?.filter(e => e.includes(model.value));
    const open = res && ((props.strict && focus.value) || (model.value.length > 0 && res.length > 0));

    return open ? res : null;
})

const handelKey = (e: KeyboardEvent) => {
    if (e.key !== "Enter") return;

    if (hints.value) {
        model.value = hints.value[0];
    }

    emit('enterPress');
}

const inputClass = computed(() => {
    var res = "w-full border-divider rounded-md shadow-sm bg-inherit focus:ring-[0.2px]";

    if (props.error) {
        res = res + " border-red-700 focus:border-red-700 focus:ring-red-700";
    } else {
        res = res + " focus:border-primary-900 focus:ring-primary-900";
    }

    if (hints.value) {
        res = res + " rounded-b-none border-b-0";
    }

    return res;
});

const handleHintClick = (hint: string) => {
    model.value = hint;
    input.value?.focus();
}

const handleFocus = () => {
    focus.value = true;
}

const handleFocusOut = () => {
    setTimeout(() => {
        focus.value = false;
    }, 100);
}
</script>

<template>
    <div class="relative bg-inherit border-none">
        <InputLabel v-if="label" :value="label" />
        <input :placeholder="placeholder" :type="type" :class="inputClass" v-model="model" ref="input"
            @keypress="handelKey" @focus="handleFocus" @focusout="handleFocusOut" />

        <p v-if="error" class="text-xs text-red-500">
            {{ error }}
        </p>

        <TextInputHintsCard v-if="hints" :hints="hints" @click="handleHintClick" />
    </div>
</template>
