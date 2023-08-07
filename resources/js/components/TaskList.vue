<template>
    <div class="grow">
        <transition-group
            tag="ul"
            appear
            @before-enter="beforeEnter"
            @enter="enter"
            class="relative flex flex-wrap gap-6 py-4 justify-center"
        >
            <li
                class="group p-4 rounded h-46 w-60 bg-white text-black drop-shadow-md"
                :class="{
                    'hover:drop-shadow-xl hover:-translate-y-6 transition ease-in-out delay-75   hover:scale-110  duration-300 border-orange-700 rounded-md border-t-4 ':
                        task.status == 'TODO',
                    'hover:drop-shadow-xl hover:-translate-y-6 transition ease-in-out delay-75   hover:scale-110  duration-300 border-green-700 rounded-md border-t-4 ':
                        task.status == 'DONE',
                    'hover:drop-shadow-xl hover:-translate-y-6 transition ease-in-out delay-75   hover:scale-110  duration-300 border-blue-700 rounded-md border-t-4 ':
                        task.status == 'DOING',
                }"
                v-for="(task, index) in tasks"
                :key="task.id"
                :data-index="index"
            >
                <div class="flex space-x-3 h-full">
                    <div class="flex flex-col space-y-3 justify-between w-full">
                        <div class="flex flex-col space-y-2">
                            <div
                                @click="updateTaskStatus(task.id, task.status)"
                                class="px-4 w-fit font-semibold cursor-pointer mb-1"
                                :class="{
                                    'text-orange-700 rounded bg-orange-100':
                                        task.status == 'TODO',
                                    'text-green-700 rounded bg-green-100':
                                        task.status == 'DONE',
                                    'text-blue-700 rounded bg-blue-100':
                                        task.status == 'DOING',
                                }"
                            >
                                {{ task.status }}
                            </div>
                            <div
                                class="font-bold text-lg line-clamp-1 group-hover:line-clamp-none"
                            >
                                {{ task.title }}
                            </div>
                            <div
                                class="line-clamp-3 group-hover:line-clamp-none text-slate-500 text-ellipsis"
                            >
                                {{ task.description }}
                            </div>
                            <div
                                v-if="task.due_date !== null"
                                :class="{
                                    hidden: task.status == 'DONE',
                                }"
                                class="w-fit text-red-600"
                            >
                                <b class="pe-1"> Due date:</b>{{ task.due }}
                            </div>
                            <div class="group-hover:flex hidden justify-end">
                                Updated:
                                <span class="ps-1">{{ task.updated_at }}</span>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <div class="group-hover:flex hidden space-x-3">
                                <div>
                                    <button
                                        class="bg-lime-900 text-white rounded hover:bg-lime-700 px-3 py-1"
                                    >
                                        <RouterLink
                                            :to="{
                                                name: 'EditTask',
                                                params: { id: task.id },
                                            }"
                                        >
                                            Edit
                                        </RouterLink>
                                    </button>
                                </div>

                                <div>
                                    <button
                                        @click="destroyTask(task.id)"
                                        class="bg-red-900 text-white rounded hover:bg-red-700 px-3 py-1"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </transition-group>
    </div>
</template>

<script setup>
import { gsap } from "gsap";
import useTasks from "../repositories/task";

import { onMounted } from "vue";
const { tasks, getTasks, destroyTask, updateTaskStatus } = useTasks();

onMounted(() => getTasks());

const beforeEnter = (el) => {
    el.style.opacity = 0;
    el.style.transform = "translateY(80px)";
};

const enter = (el, done) => {
    gsap.to(el, {
        opacity: 1,
        y: 0,
        duration: 0.1,
        onComplete: done,
        delay: el.dataset.index * 0.2,
    });
};
</script>

<style scoped>
.task-list-enter-from {
    opacity: 0;
    transform: scale(0);
}
.task-list-enter-to {
    opacity: 1;
    transform: scale(1);
}
.task-list-enter-active {
    transition: all 0.5s ease;
}
.task-list-leave-from {
    opacity: 1;
    transform: scale(1);
}
.task-list-leave-to {
    opacity: 0;
    transform: scale(0.6);
}
.task-list-leave-active {
    transition: all 0.5s ease;
    position: absolute;
}

.task-list-move {
    transition: all 0.5s ease;
}
</style>
