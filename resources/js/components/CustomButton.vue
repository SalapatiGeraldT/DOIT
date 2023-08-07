<script setup></script>
<template>
    <div class="flex flex-col">
        <button
            class="bg-sky-900  hover:bg-sky-200 hover:text-black text-white rounded-md px-5 py-2 antialiased text-lg tracking-wider mukta"
            v-bind="$attrs"
        >
            <slot></slot>
        </button>
    </div>
</template>

<style lang="scss" scoped></style>
