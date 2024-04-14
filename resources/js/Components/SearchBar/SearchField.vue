<script setup lang="ts">
import { ModelRef, ref, watch } from 'vue';

const model = defineModel<string>({ default: "" });
var key: number | undefined;

const emit = defineEmits<{
    change: [string],
}>();

watch(model, (val: string) => {
    clearInterval(key);
    key = setTimeout(() => {
        emit("change", val);
    }, 500);
});

</script>

<template>
    <div class="flex-1 w-full h-full overflow-hidden">
        <input type="text" placeholder="Search..." v-model="model"
            class="w-full h-full p-2 bg-inherit border-none -outline-offset-2 focus:outline-0 overflow-hidden" />
    </div>
</template>