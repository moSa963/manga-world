

<template>
    <div class="relative flex flex-wrap" style="perspective: 800px;">
        <div class="root delay1 w-1/2 bg-surface-200 aspect-square rounded-tl-2xl"></div>
        <div class="root delay2 w-1/2 bg-surface-200 aspect-square"></div>
        <div class="root delay3 w-1/2 bg-surface-200 aspect-square"></div>
        <div class="root delay4 w-1/2 bg-surface-200 aspect-square rounded-br-2xl"></div>
    </div>
</template>

<style scoped>
.root {
    animation: ani 1s linear 0s infinite;
    transform-origin: center;
}

.delay1 {
    animation-delay: 0s;
}

.delay2 {
    animation-delay: -200ms;
}

.delay3 {
    animation-delay: -300ms;
}

.delay4 {
    animation-delay: -400ms;
}

@keyframes ani {
    0% {
        box-shadow: inset 0 0 0px;
        transform: translateZ(0px);
    }

    20% {
        box-shadow: inset 0 0 0px;
        transform: translateZ(0px);
    }

    40% {
        box-shadow: inset 0px 0px 10px -4px;
        transform: translateZ(-10px);
    }

    60% {
        box-shadow: inset 0px 0px 10px -4px;
        transform: translateZ(-10px);
    }

    80% {
        box-shadow: inset 0 0 0px;
        transform: translateZ(0px);
    }

    100% {
        box-shadow: inset 0 0 0px;
        transform: translateZ(0px);
    }
}
</style>