<template>
    <div class="flex flex-col items-center teko">
        <div class="text-6xl">
            <slot name="title"></slot>
        </div>
        <div class="text-4xl text-slate-700">
            <slot name="desc"></slot>
        </div>
    </div>
</template>

<script setup></script>

<style lang="scss" scoped></style>
