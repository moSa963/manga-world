<script setup lang="ts">
import ClickScale from './Effects/ClickScale.vue';


//string for 'single item selection' or array for 'multiple item selection'
const model = defineModel<string | Array<string>>({ default: '' });

const props = defineProps<{
    values: Array<string>,
    allowEmpty?: boolean,
    disabled?: boolean,
}>();

const emit = defineEmits<{
    click: [string],
}>();

const selected = (value: string) => {
    if (typeof (model.value) === "string") {
        return model.value == value;
    }

    return model.value.findIndex(e => e == value) != -1;
}


const handleClick = (value: string) => {
    emit('click', value);

    if (props.disabled) {
        return;
    }

    //type string means specifying 'single item selection' mode
    if (typeof (model.value) === "string") {
        //if the clicked item is already selected and allowed to be empty, set it to empty
        if (model.value == value) {
            if (props.allowEmpty) {
                model.value = "";
            }
            return;
        }

        //otherwise the item is not selected so select it
        model.value = value;
        return;
    }

    //otherwise type array means specifying 'multiple item selection' mode

    if (selected(value)) {
        if (model.value.length > 1 || props.allowEmpty) {
            model.value = model.value?.filter(e => e != value);
        }
        return;
    }

    model.value.push(value);
}

</script>


<template>
    <div class="flex">
        <ClickScale v-for="value in values" @click="() => handleClick(value)"
            :class="`${selected(value) ? 'bg-primary-300/20' : ''} p-2 border-divider/20 border-[1px] border-l-0 first:rounded-l-md first:border-l-[1px] last:rounded-r-md`">
            <p class="text-lg">{{ value }}</p>
        </ClickScale>
    </div>
</template>