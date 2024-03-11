<script setup lang="ts">
import ChevronDownIcon from 'vue-material-design-icons/ChevronDown.vue';
import ChevronUpIcon from 'vue-material-design-icons/ChevronUp.vue';
import GroupButton from '@/Components/ButtonGroup/ButtonGroup.vue';
import Button from '@/Components/ButtonGroup/Button.vue';
import CircularProgress from '@/Components/CircularProgress.vue';

defineProps<{
    progress: boolean,
    newDisabled?: boolean | null,
    oldDisabled?: boolean | null,
}>();

defineEmits<{
    loadNew: [],
    loadOld: [],
}>();

</script>

<template>
    <div class="drawer-root shadow-surface-400 overflow-hidden flex items-center">
        <div class="drawer flex justify-center items-center overflow-hidden">
            <CircularProgress v-if="progress" class="size-8" />

            <GroupButton v-else>
                <Button title="new" @click="$emit('loadNew')" :disabled="newDisabled">
                    <ChevronDownIcon size="30px" />
                </Button>
                <Button title="old" @click="$emit('loadOld')" :disabled="oldDisabled">
                    <ChevronUpIcon size="30px" />
                </Button>
            </GroupButton>
        </div>
    </div>
</template>

<style scoped>
.drawer-root {
    height: 10px;
    box-shadow: inset 0px 0px 7px -4px;
    transition: 200ms all;
}

.drawer {
    width: 0%;
    transition: 200ms all;
}

.root:hover .drawer {
    width: 100%;
}

.root:hover .drawer-root {
    height: 60px;
}
</style>