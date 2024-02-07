<script setup lang="ts">
import LightbulbOn10 from "vue-material-design-icons/LightbulbOn10.vue";
import MoonWaningCrescent from "vue-material-design-icons/MoonWaningCrescent.vue";

const props = defineProps<{
    mode: "dark" | "light",
}>();

const emits = defineEmits<{
    change: [mode: string]
}>();

const handleClick = () => {
    emits("change", props.mode);
}

</script>

<template>
    <div @click="handleClick"
        class="rounded-full w-fit p-2 hover:bg-gray-400 hover:bg-opacity-20 cursor-pointer aspect-square">
        <LightbulbOn10 v-if="mode !== 'dark'" size="100%" />
        <MoonWaningCrescent v-else size="100%" />
    </div>
</template>