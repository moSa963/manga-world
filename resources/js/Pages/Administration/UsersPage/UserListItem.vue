<script setup lang="ts">
import Accordion from '@/Components/Accordion.vue';
import ListItem from '@/Components/ListItem.vue';
import { Permission, User } from '@/types';
import PermissionsList from './PermissionsList.vue';
import { getDate } from '@/utils/DateTime';


defineProps<{
    user: User,
    permissions: Array<Permission>,
}>();


defineEmits<{
    userUpdate: [user: User],
}>();

</script>
<template>
    <Accordion :class="`${user.admin ? 'bg-primary-400/10' : 'bg-surface-100'}`">
        <template #head>
            <ListItem :src="route('api.users.image.show', { user: user.username })" disabled :title="user.name"
                :secondary="`@${user.username}`" />
        </template>
        <div class="w-full p-4 flex flex-col gap-3">
            <div class="flex gap-3 items-center">
                <p class="text-divider font-serif">Email: </p>
                <span class="text-primary">{{ user.email }} </span>
                <span class="p-1 bg-primary-200/20 rounded-xl"> {{ user.email_verified_at ?
                    getDate(user.email_verified_at) : 'not verified' }}</span>
            </div>

            <PermissionsList :user="user" :permissions="permissions" @change="(v) => $emit('userUpdate', v)" />
        </div>
    </Accordion>
</template>