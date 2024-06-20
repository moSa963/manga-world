<script setup lang="ts">
import Button from '@/Components/ButtonGroup/Button.vue';
import { Chapter, Comment, Series } from '@/types';
import apiRequest from '@/utils/ApiRequest';
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    series: Series,
    chapter: Chapter
}>();

const emits = defineEmits<{
    created: [Comment]
}>();


const input = ref<string>("");
const error = ref<string>("");
const page = usePage();

const handleSend = async () => {
    if (page.props.auth.user == null) {
        router.get(route('login'));
    }

    const res = await apiRequest(route('api.chapter.comments.store', {
        series: props.series.id,
        chapter: props.chapter.number,
    }), "POST", {
        "comment": input.value,
    });

    const js = await res.json();

    if (!res.ok) {
        error.value = js.message;
        return
    }

    input.value = "";
    error.value = "";
    emits('created', js.data);
}

</script>


<template>
    <div
        class="w-full flex max-w-4xl min-h-40 rounded-2xl border-[8px] border-surface-100 bg-surface-100 overflow-hidden">
        <div class="flex-1 overflow-hidden flex bg-surface-300 mr-2">
            <textarea class="flex-1 resize-none -m-2 p-6 bg-inherit border-none" v-model="input"
                placeholder="Comment..."></textarea>
        </div>

        <div class="flex justify-center items-center ">
            <Button :disabled="input.trim().length == 0" @click="handleSend">
                <p>Send</p>
            </Button>
        </div>
    </div>
    <p v-if="error.length" class="text-red-400">{{ error }}</p>
</template>