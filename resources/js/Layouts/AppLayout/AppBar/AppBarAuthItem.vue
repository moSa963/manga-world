<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';


const user = usePage().props.auth.user;

</script>


<template>
    <div
        class="h-full hover:-translate-y-1 bg-opacity-5 flex justify-center items-center select-none cursor-pointer bg-slate-500 border-[1px] border-inherit border-b-0 rounded-t overflow-hidden">
        <p v-if="user != null" class="p-1 hidden sm:block">{{ user.username }}</p>
        <div v-if="user != null" class="aspect-square h-full">
            <img class="w-full h-full object-cover" :src="route('api.users.image.show', { user: user.username })" />
        </div>

        <Link v-if="user == null" :href="route('login')" class="px-3">
        Login
        </Link>
    </div>
</template>