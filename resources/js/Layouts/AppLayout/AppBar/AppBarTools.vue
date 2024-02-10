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
        <AppBarItem first>
            <template #icon>
                <HomeIcon #icon />
            </template>
            <p class="text-primary hidden sm:block"> Home</p>
        </AppBarItem>
        <AppBarItem>
            <template #icon>
                <ViewListIcon #icon />
            </template>
            <p class="hidden sm:block">List</p>
        </AppBarItem>
        <AppBarItem last>
            <template #icon>
                <InformationVariant #icon />
            </template>
            <p class="hidden sm:block">About us</p>
        </AppBarItem>
    </div>
</template>