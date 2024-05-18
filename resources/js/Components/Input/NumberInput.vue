<script setup lang="ts">
import PlusIcon from 'vue-material-design-icons/Plus.vue';
import MinusIcon from 'vue-material-design-icons/Minus.vue';
import { onMounted, watch } from 'vue';

const model = defineModel<number>({ default: 0 });

const emit = defineEmits<{
    change: [vOld: number, vNew: number]
}>();

const props = withDefaults(
    defineProps<{
        step?: number,
        max?: number,
        min?: number,
    }>(), {
    step: 1,
    max: 99999,
    min: -99999,
}
);

onMounted(() => {
    if (model.value >= props.max || model.value < props.min) {
        model.value = props.min;
    }
});

watch([props, model], () => {
    if (props.max == props.min) {
        model.value = props.min;
        return;
    }

    if (model.value >= props.max) {
        model.value = props.max - props.step;
    }
    if (model.value < props.min) {
        model.value = props.min;
    }
});

const handlePlus = () => {
    if (model.value + props.step < props.max) {
        emit('change', model.value, model.value + props.step);
        model.value += props.step;
    }
}

const handleMinus = () => {
    if (model.value - props.step >= props.min) {
        emit('change', model.value, model.value - props.step);
        model.value -= props.step;
    }
}
</script>


<template>
    <div class="w-fit flex select-none">
        <div @click="handleMinus"
            class="bg-surface-200 p-1 rounded-l-lg flex justify-center items-center hover:scale-95 cursor-pointer">
            <MinusIcon />
        </div>
        <div class="bg-surface-100 flex-grow">
            <p class="font-bold text-lg p-1">{{ model }}</p>
        </div>
        <div @click="handlePlus"
            class="bg-surface-200 p-1 rounded-r-lg flex justify-center items-center hover:scale-95 cursor-pointer">
            <PlusIcon />
        </div>
    </div>
</template>