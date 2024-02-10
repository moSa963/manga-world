<script setup lang="ts">

withDefaults(
    defineProps<{
        first: boolean,
        last: boolean,
        href: string | undefined,
        simple: boolean,
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
    <a :href="href" :class="`h-full hover:-translate-y-1 bg-opacity-5 flex justify-center items-center p-1 select-none cursor-pointer bg-slate-500 border-t-[1px] border-inherit
                    ${first ? 'rounded-tl-md border-l-[1px]' : ''} ${last ? 'rounded-tr-md border-r-[1px]' : ''}`">
        <slot name="icon" />
        <slot v-if="!simple" />
    </a>
</template>