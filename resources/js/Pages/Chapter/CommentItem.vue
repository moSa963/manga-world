<script setup lang="ts">
import { Comment } from '@/types';
import { getPeriod } from '@/utils/DateTime';

defineProps<{
    comment: Comment
}>();

</script>


<template>
    <div class="w-full max-w-4xl rounded-2xl bg-surface-300 flex p-2">
        <div class="w-24 flex flex-col items-center">
            <div class="w-24 h-24 rounded-full bg-slate-600 overflow-hidden">
                <img class="w-full h-full object-cover"
                    :src="route('api.users.image.show', { user: comment.username })" />
            </div>
            <p>{{ getPeriod(comment.created_at) }}</p>
        </div>

        <div class="flex-1 overflow-hidden">
            <p class="font-extrabold font-serif text-base sm:text-xl md:text-2xl p-1 md:p-3">{{ comment.username }}</p>
            <p class="p-3 pl-8 break-words">
                {{ comment.comment }}
            </p>
        </div>
    </div>
</template>