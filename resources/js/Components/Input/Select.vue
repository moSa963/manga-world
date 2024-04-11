<script setup lang="ts">

defineProps<{
    name?: string,
    options: string[],
}>();

const model = defineModel<string>();

</script>

<template>
    <select :name="name" class="bg-surface-100" v-model="model">
        <option v-for="(o, i) in options" :key="i" :value="o" class="p-4">{{ o }}</option>
    </select>
</template>