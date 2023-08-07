<template>
    <div class="flex items-center flex-col mukta">
        <div class="text-5xl text-center font-semibold antialiased my-6">
            <div v-if="$route.name == 'Dashboard'">All Task List</div>
            <div v-else-if="$route.name == 'EditTask'">Edit Task</div>
            <div v-else>Add Task</div>
        </div>

        <div class="my-10 flex space-x-4">
            <RouterLink
                v-if="$route.name == 'Dashboard'"
                :to="{ name: 'CreateTask' }"
                class="px-6 py-2 bg-sky-900 hover:bg-sky-200 hover:text-black text-white rounded text-lg"
            >
                Add new task
            </RouterLink>

            <RouterLink
                v-else
                :to="{ name: 'Dashboard' }"
                class="px-6 py-2 bg-sky-900 hover:bg-sky-200 hover:text-black text-white rounded text-lg"
            >
                View task list
            </RouterLink>
        </div>
    </div>
</template>

<script setup>
import { RouterLink, RouterView } from "vue-router";
import useTasks from "../repositories/task";

const { getTasks } = useTasks();
</script>

<style scoped></style>
