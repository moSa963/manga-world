<script setup lang="ts">
import AppBarItem from './AppBarItem.vue';
import ViewListIcon from 'vue-material-design-icons/ViewList.vue';
import HomeIcon from 'vue-material-design-icons/Home.vue';
import InformationVariant from 'vue-material-design-icons/InformationVariant.vue';

defineProps<{
    ratio: number,
}>();

</script>

<template>
    <div class="h-full flex flex-1 border-inherit">
        <AppBarItem :href="route('index')">
            <template #icon>
                <HomeIcon #icon />
            </template>
            <p class="text-primary hidden md:block"> Home</p>
        </AppBarItem>
        <AppBarItem :href="route('series.list')">

            <template #icon>
                <ViewListIcon #icon />
            </template>
            <p class="hidden md:block">List</p>
        </AppBarItem>
        <AppBarItem>

            <template #icon>
                <InformationVariant #icon />
            </template>
            <p class="hidden md:block">About us</p>
        </AppBarItem>
    </div>
</template>