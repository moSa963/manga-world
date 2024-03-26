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
    <div @click="handleClick" class="h-full aspect-square p-1 sm:p-3 cursor-pointer hover:bg-divider/15 rounded-t-lg">
        <LightbulbOn10 v-if="mode !== 'dark'" size="100%" />
        <MoonWaningCrescent v-else size="100%" />
    </div>
</template>
