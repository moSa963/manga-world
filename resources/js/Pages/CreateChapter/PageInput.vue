<script setup lang="ts">
import Button from '@/Components/ButtonGroup/Button.vue';
import ButtonGroup from '@/Components/ButtonGroup/ButtonGroup.vue';
import NumberInput from '@/Components/Input/NumberInput.vue';
import { ref } from 'vue';
import PlusIcon from 'vue-material-design-icons/Plus.vue';
import MinusIcon from 'vue-material-design-icons/Minus.vue';

const model = defineModel<string[]>({ default: [] });
const urls = ref<string[]>([]);
const index = ref<number>(0);

const handleClick = (e: MouseEvent) => {
    ((e.currentTarget as HTMLElement).querySelector('input') as HTMLElement).click();
}

const handleChange = (e: Event) => {
    const files = (e.currentTarget as HTMLFormElement).files;

    for (var file of files) {
        urls.value.push(URL.createObjectURL(file));
        model.value.push(file);
    }

    index.value = model.value.length - 1;
}

const handleIndexChange = (vOld: number, vNew: number) => {
    var hold = model.value[vNew];
    model.value[vNew] = model.value[vOld];
    model.value[vOld] = hold;

    hold = urls.value[vNew];
    urls.value[vNew] = urls.value[vOld];
    urls.value[vOld] = hold;

}

const handleRemove = () => {
    model.value = model.value.filter((_, i) => i !== index.value);
    urls.value = urls.value.filter((_, i) => i !== index.value);
}
</script>


<template>
    <div class="w-full h-[85vh] p-1 flex flex-col">
        <div class="w-full h-11 border-b-[1px] flex items-center">
            <ButtonGroup>
                <Button title="Add">
                    <div @click="handleClick">
                        <input type="file" accept="Image/*" class="hidden" multiple @change="handleChange" />
                        <PlusIcon />
                    </div>
                </Button>
                <Button title="Remove" @click="handleRemove">
                    <MinusIcon />
                </Button>
            </ButtonGroup>
            <div class="flex-grow flex justify-center items-center">
                <NumberInput :min="0" :max="urls.length" v-model="index" @change="handleIndexChange" />
            </div>
            <ButtonGroup>
                <Button @click="() => index--">
                    <p>Previous</p>
                </Button>
                <Button @click="() => index++">
                    <p>Next</p>
                </Button>
            </ButtonGroup>
        </div>
        <div class="w-full flex-1 flex justify-center items-center overflow-hidden bg-surface-100">
            <img v-if="urls.length" class="object-contain" :src="urls[index]" />
        </div>
    </div>
</template>
