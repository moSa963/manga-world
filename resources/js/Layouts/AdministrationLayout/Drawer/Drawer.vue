<script setup lang="ts">
import DrawerItem from './DrawerItem.vue';
import AccountMultipleIcon from 'vue-material-design-icons/AccountMultiple.vue';
import DatabaseIcon from 'vue-material-design-icons/Database.vue';
import EvPlugType1Icon from 'vue-material-design-icons/EvPlugType1.vue';

defineProps<{
    selected: string,
}>();

</script>


<template>
    <div class="overflow-auto overflow-x-hidden w-fit">
        <DrawerItem title="Users" :selected="selected === 'users'" :href="route('admin.users.list')">
            <AccountMultipleIcon />
        </DrawerItem>
        <DrawerItem title="Series" :selected="selected === 'series'" :href="route('admin.series.list')">
            <DatabaseIcon />
        </DrawerItem>
        <DrawerItem title="Genres" :selected="selected === 'genres'" :href="route('admin.genres.list')">
            <EvPlugType1Icon />
        </DrawerItem>
    </div>
</template>