<script setup lang="ts">

withDefaults(
    defineProps<{
        first: boolean,
        last: boolean,
        href: string | undefined,
        simple: boolean
    }>(),
    {
        first: false,
        last: false,
        href: undefined,
        simple: false
    }
)

</script>

<template>
    <a :href="href" :class="`h-full hover:-translate-y-1 bg-opacity-5 flex justify-center items-center p-1 select-none cursor-pointer bg-slate-500 border-t-2 
        ${first ? 'rounded-tl-md border-l-2' : ''} ${last ? 'rounded-tr-md border-r-2' : ''}`">
        <slot name="icon" />
        <slot v-if="!simple" />
    </a>
</template>