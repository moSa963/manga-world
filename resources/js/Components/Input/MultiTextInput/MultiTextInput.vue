<script setup lang="ts">
import InputLabel from '@/Components/InputLabel.vue';
import InputChip from './InputChip.vue';
import TextInput from '@/Components/Input/TextInput/TextInput.vue';
import { onMounted, ref } from 'vue';
import Button from '@/Components/ButtonGroup/Button.vue';

const v = ref("");
const model = defineModel<string[]>({ default: [] });

defineProps<{
    label: string,
    error?: string | null,
}>();

const handleAdd = () => {
    if (v.value.trim() == "") {
        return;
    }

    model.value = [...model.value, v.value];
    v.value = ""
}

const handleRemove = (index: number) => {
    model.value = model.value.filter((_, i) => i != index);
}
</script>


<template>
    <div class="w-full">
        <InputLabel v-if="label" :value="label" />
        <div class="flex items-center gap-1">
            <TextInput type="text" class="mt-1 block w-full" v-model="v" placeholder="Name..."
                @enter-press="handleAdd" />

            <Button class="h-full" border @click="handleAdd">
                <p class="px-3"> Add</p>
            </Button>
        </div>

        <div
            :class="`flex gap-1 flex-wrap m-3 p-3 border-[1px] border-t-0 ${error ? 'border-red-700' : 'border-divider/25'}`">
            <InputChip v-for="(text, i) in modelValue" :key="i" :text="text" @click="() => handleRemove(i)" />
        </div>

        <p v-if="error" class="text-xs text-red-500">
            {{ error }}
        </p>
    </div>
</template>