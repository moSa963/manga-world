<script setup lang="ts">
import InputLabel from '@/Components/InputLabel.vue';
import InputChip from './InputChip.vue';
import TextInput from '@/Components/Input/TextInput/TextInput.vue';
import { onMounted, ref } from 'vue';
import Button from '@/Components/ButtonGroup/Button.vue';
import ChipList from './ChipList.vue';

const v = ref("");
const model = defineModel<string[]>({ default: [] });

const props = defineProps<{
    label: string,
    error?: string | null,
    options?: string[],
    strict?: boolean,
}>();

onMounted(() => {
    if (props.strict && !Boolean(props.options)) {
        throw Error("Invalid props provided. In strict mode, 'options' is mandatory");
    }
});

const handleAdd = () => {
    const value = v.value.trim();

    if (value == "" || (props.strict && props.options?.findIndex(v => v == value) == -1)) {
        return;
    }

    model.value = [...model.value, v.value];
    v.value = "";
}

const handleRemove = (index: number) => {
    model.value = model.value.filter((_, i) => i != index);
}
</script>


<template>
    <div class="w-full">
        <InputLabel v-if="label" :value="label" />
        <div class="flex items-center gap-1">
            <TextInput type="text" class="mt-1 block w-full" v-model="v" placeholder="Name..." @enter-press="handleAdd"
                :hints="options" :strict="strict" />

            <Button class="h-full" border @click="handleAdd">
                <p class="px-3"> Add</p>
            </Button>
        </div>

        <ChipList :error="Boolean(error)" :data="modelValue" @click="handleRemove" />

        <p v-if="error" class="text-xs text-red-500">
            {{ error }}
        </p>
    </div>
</template>