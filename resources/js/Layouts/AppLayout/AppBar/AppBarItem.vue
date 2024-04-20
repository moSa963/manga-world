<script setup lang="ts">
import { Link } from '@inertiajs/vue3';


withDefaults(
    defineProps<{
        href?: string | undefined,
        simple?: boolean,
    }>(),
    {
        href: undefined,
        simple: false
    }
)

</script>

<template>
    <Link :href="href || ''" :class="`h-full hover:-translate-y-1 bg-opacity-5 flex justify-center items-center p-1 select-none cursor-pointer bg-slate-500 border-t-[1px] border-inherit
                    first:rounded-tl-md first:border-l-[1px] last:rounded-tr-md last:border-r-[1px] `">
    <slot name="icon" />
    <slot v-if="!simple" />
    </Link>
</template>