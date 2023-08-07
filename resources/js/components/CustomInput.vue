

<template>
    <input
        class="my-1 p-2 outline-none rounded hover:bg-sky-200 focus:ring-2 border-sky-800 border focus:ring-sky-900"
        @input="$emit('input-value', $event.target.value, index)"
        v-bind="$attrs"
    />
</template>


<script setup>
import { defineEmits } from "vue";

const emit = defineEmits(["input-value"]);
</script>

<style lang="scss" scoped></style>
