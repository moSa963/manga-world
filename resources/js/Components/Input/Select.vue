<script setup lang="ts">
import InputLabel from '../InputLabel.vue';


defineProps<{
    name?: string,
    options: string[],
    label?: string,
}>();

const model = defineModel<string>();

</script>

<template>
    <div class="flex-grow flex items-center gap-3">
        <InputLabel v-if="label" :value="label" />
        <select :name="name" class="bg-surface-100" v-model="model">
            <option v-for="(o, i) in options" :key="i" :value="o" class="p-4">{{ o }}</option>
        </select>
    </div>
</template>