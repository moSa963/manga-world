<script setup lang="ts">
import AppBarItem from './AppBarItem.vue';
import ViewListIcon from 'vue-material-design-icons/ViewList.vue';
import HomeIcon from 'vue-material-design-icons/Home.vue';
import InformationVariant from 'vue-material-design-icons/InformationVariant.vue';


</script>

<template>
    <div class="h-full flex flex-1">
        <AppBarItem first>
            <template #icon>
                <HomeIcon #icon />
            </template>
            <p>Home</p>
        </AppBarItem>
        <AppBarItem>
            <template #icon>
                <ViewListIcon #icon />
            </template>
            <p>List</p>
        </AppBarItem>
        <AppBarItem last>
            <template #icon>
                <InformationVariant #icon />
            </template>
            <p>About us</p>
        </AppBarItem>
    </div>
</template>