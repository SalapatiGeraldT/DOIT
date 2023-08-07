<template>
    <DashboardHeader />

    <div class="text-black text-sm flex justify-center my-2 mukta">
        <TaskList />
    </div>
</template>

<script setup>
import TaskList from "../components/TaskList.vue";
import DashboardHeader from "../components/DashboardHeader.vue";
</script>

<style lang="scss" scoped></style>

