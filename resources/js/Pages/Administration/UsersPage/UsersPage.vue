<script setup lang="ts">
import CircularProgress from '@/Components/CircularProgress.vue';
import SearchField from '@/Components/SearchBar/SearchField.vue';
import { ScrollType } from '@/Components/WindowScroll.vue';
import AdministrationLayout from '@/Layouts/AdministrationLayout/AdministrationLayout.vue';
import { Permission, Response, User } from '@/types';
import fetchList from '@/utils/FetchList';
import { onMounted, ref } from 'vue';
import UserListItem from './UserListItem.vue';


const data = ref<Response<User> | null>(null);
const progress = ref<boolean>(false);
const circularProgress = ref<HTMLDivElement>();

defineProps<{
    permissions: Array<Permission>,
}>();

const getData = async (key: string, reset?: boolean) => {
    const url = (data.value && !reset) ? data.value.links.next : route("api.users.list", { key });
    await fetchList(data, url, progress, reset);
}

onMounted(async () => {
    await getData("");
});

const handleChange = (scroll: ScrollType) => {
    if ((circularProgress.value?.offsetTop || 0) - scroll.value < scroll.innerHeight) {
        getData("");
    }
}

const handleKeyChange = async (v: string) => {
    await getData(v, true);
}

const onUserUpdate = (user: User) => {
    const i = data.value?.data.findIndex(e => e.username == user.username);

    if (!i || i == -1 || data.value == null) return;

    data.value.data[i] = user;
}
</script>

<template>
    <AdministrationLayout @scroll="handleChange" selected="users">
        <div class="w-full h-16 bg-surface-300 mt-12 flex">
            <SearchField @change="handleKeyChange" />
        </div>

        <UserListItem v-for="user in data?.data" :key="user.username" @user-update="onUserUpdate"
            :permissions="permissions" :user="user" />

        <div v-if="data?.links.next" ref="circularProgress" class="flex justify-center my-4">
            <CircularProgress class="size-24" />
        </div>
    </AdministrationLayout>
</template>