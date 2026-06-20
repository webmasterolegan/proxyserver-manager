<script setup>
import { defineModel } from 'vue'

const open = defineModel('open', {
    type: Boolean,
    required: true,
    default: false,
})

const close = () => {
    open.value = false
}
</script>

<template>
    <div v-if="open" @click="close" class="z-50 modal fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center opacity-75"></div>

    <div v-if="open" class="bg-white rounded-md px-8 pt-4 pb-8 z-100 fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <button type="button" class="absolute top-0 right-3 cursor-pointer text-2xl" @click="close">
            &times;
        </button>

        <div class="flex flex-col gap-2 mt-4">
            <slot></slot>
        </div>
    </div>
</template>