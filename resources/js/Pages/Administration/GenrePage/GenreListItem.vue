<script setup lang="ts">

const p = defineProps<{
    genre: string,
}>();

const emits = defineEmits<{
    delete: [genre: string],
}>();

const handleDelete = () => {
    emits('delete', p.genre);
}
</script>
<template>
    <div class="root w-full flex hover:m-1 transition-all bg-surface-200 items-center overflow-hidden pl-5">
        <p>{{ genre }}</p>

        <div class="flex-grow"></div>

        <div class="delete-button hover:bg-surface-0 p-2 text-red-500 transition-transform bg-surface-50"
            @click="handleDelete">
            <p>Delete</p>
        </div>
    </div>
</template>

<style scoped>
.delete-button {
    cursor: pointer;
    height: 100%;
    transform: translateX(100%);
    display: flex;
    justify-content: center;
    align-items: center;
}

.root:hover .delete-button {
    transform: translateX(0);
}
</style>