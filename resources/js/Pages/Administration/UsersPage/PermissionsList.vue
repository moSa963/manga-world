<script setup lang="ts">
import Chip from '@/Components/Chip.vue';
import { Permission, User } from '@/types';
import request from '@/utils/ApiRequest';
import { hasPermission } from '@/utils/Permissions';

defineProps<{
    permissions: Array<Permission>,
    user: User,
}>();

const emit = defineEmits<{
    change: [user: User]
}>();

const handleChange = async (user: User, permission: Permission) => {

    if (!hasPermission(user, permission)) {
        addPermission(user, permission);
    } else {
        deletePermission(user, permission);
    }

    emit('change', user);
}

const addPermission = async (user: User, permission: Permission) => {
    const res = await request(route("api.permissions.store", {
        user: user.username,
        permission: permission,
    }), "POST");

    if (res.ok) {
        user.permissions?.push(permission);
    }
}

const deletePermission = async (user: User, permission: Permission) => {
    const res = await request(route("api.permissions.delete", {
        user: user.username,
        permission: permission,
    }), "DELETE");

    if (res.ok) {
        user.permissions = user.permissions?.filter(e => e != permission);
    }
}
</script>


<template>
    <div class="w-full flex gap-2">
        <p>Permissions: </p>
        <Chip v-for="permission in permissions" @click="() => handleChange(user, permission)"
            :class="`${hasPermission(user, permission) ? 'bg-primary-500/50' : ''}`" :key="permission">
            <p :class="`${hasPermission(user, permission) ? '' : 'opacity-25'}`">{{ permission }}</p>
        </Chip>
    </div>
</template>
