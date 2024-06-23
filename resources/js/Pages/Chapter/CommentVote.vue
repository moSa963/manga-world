<script setup lang="ts">
import ArrowUpBold from "vue-material-design-icons/ArrowUpBold.vue";
import ArrowUpBoldOutline from "vue-material-design-icons/ArrowUpBoldOutline.vue";
import ArrowDownBold from "vue-material-design-icons/ArrowDownBold.vue";
import ArrowDownBoldOutline from "vue-material-design-icons/ArrowDownBoldOutline.vue";
import { ref } from "vue";
import ClickScale from "@/Components/Effects/ClickScale.vue";
import apiRequest from "@/utils/ApiRequest";
import { Comment } from "@/types";

const props = defineProps<{
    comment: Comment
}>();

const voted = ref(props.comment.voted)

const handleVote = async (val: -1 | 1) => {
    if (voted.value == val) {
        return handleDelete();
    }

    const res = await apiRequest(route('api.chapter.comments.vote.store', {
        "comment": props.comment.id,
        "value": val
    }), "POST");

    if (res.ok) {
        voted.value = val;
    }
}

const handleDelete = async () => {
    const res = await apiRequest(route('api.chapter.comments.vote.delete', {
        "comment": props.comment.id,
    }), "DELETE");

    if (res.ok) {
        voted.value = 0;
    }
}
</script>

<template>
    <div class="flex flex-col justify-center">
        <ClickScale @click="() => handleVote(1)" no-hover>
            <ArrowUpBold v-if="voted == 1" size="35"
                class="text-primary/60 stroke-1 cursor-pointer hover:text-surface-900" />
            <ArrowUpBoldOutline v-else size="35"
                class="text-primary/60 stroke-1 cursor-pointer hover:text-surface-900" />
        </ClickScale>

        <div class="w-full  text-center">
            <p>{{ comment.vote + voted }}</p>
        </div>

        <ClickScale @click="() => handleVote(-1)" no-hover>
            <ArrowDownBold v-if="voted == -1" size="35"
                class="text-primary/60 stroke-1 cursor-pointer hover:text-surface-900" />
            <ArrowDownBoldOutline v-else size="35"
                class="text-primary/60 stroke-1 cursor-pointer hover:text-surface-900" />
        </ClickScale>
    </div>
</template>