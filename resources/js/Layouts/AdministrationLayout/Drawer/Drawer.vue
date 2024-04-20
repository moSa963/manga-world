<script setup lang="ts">
import DrawerItem from './DrawerItem.vue';
import AccountMultipleIcon from 'vue-material-design-icons/AccountMultiple.vue';
import DatabaseIcon from 'vue-material-design-icons/Database.vue';

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
    </div>
</template>