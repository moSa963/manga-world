<script setup lang="ts">


defineProps<{
    src?: string,
}>();

</script>


<template>
    <div
        class="h-full aspect-[2/3] overflow-hidden rounded-xl sm:rounded-2xl rounded-e-none sm:rounded-e-none border-[1px] border-primary">
        <img :src="src"
            class="rounded-xl sm:rounded-2xl rounded-e-none sm:rounded-e-none border-[2px] md:border-[6px] !border-surface-50" />
    </div>
</template>