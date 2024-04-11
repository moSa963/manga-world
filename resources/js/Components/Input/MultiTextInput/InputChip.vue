<script setup lang="ts">
import Chip from '@/Components/Chip.vue';

defineProps<{
    text: string,
}>();

defineEmits<{
    click: [string],
}>();

</script>


<template>
    <Chip @click="$emit('click', text)" class="root flex pl-0">
        <p class="pl-1">{{ text }}</p>
    </Chip>
</template>


<style scoped>
.root::before {
    content: 'x';
    background-color: rgba(255, 0, 0, 0.5);
    top: 0;
    bottom: 0;
    left: 0;
    width: 0px;
    overflow: hidden;
    transition: 100ms;
}

.root:hover::before {
    width: 20px;
}
</style>