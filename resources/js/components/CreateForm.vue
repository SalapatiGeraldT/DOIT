<template>
    <div class="px-6 py-8 my-4 rounded bg-white  md:w-4/6 w-full">
        <div class=" ">
            <div class="mb-3 text-xl antialiased font-bold text-center mukta">
                Add Task
            </div>
            <form @submit.prevent="storeTask(form)" class="">
                <div class="my-5">
                    <CustomLabel for="title"> Title </CustomLabel>
                    <CustomInput
                        class="w-full"
                        name="title"
                        placeholder="Enter your title"
                        type="text"
                        id="title"
                        @input-value="
                            (input) => {
                                form.title = input;
                            }
                        "
                    />
                    <div class="error-effect" v-if="errors.title">
                        <span class="text-sm text-red-400">{{
                            errors.title[0]
                        }}</span>
                    </div>
                </div>
                <div class="my-5">
                    <CustomLabel for="description"> Description </CustomLabel>

                    <textarea
                        v-model="form.description"
                        id="description"
                        name="description"
                        rows="4"
                        class="block p-2.5 w-full text-sm outline-none rounded hover:bg-sky-200 focus:ring-2 border-sky-800 border focus:ring-sky-900"
                        placeholder="Write your description here..."
                    ></textarea>
                    <div class="error-effect" v-if="errors.description">
                        <span class="text-sm text-red-400">{{
                            errors.description[0]
                        }}</span>
                    </div>
                </div>

                <div class="my-5">
                    <CustomLabel for="status"> Status </CustomLabel>
                    <select
                        class="w-full  my-1 p-2 outline-none rounded hover:bg-sky-200 focus:ring-2 border-sky-800 border focus:ring-sky-900"
                        name="status"
                        title="status"
                        v-model="form.status"
                        id="status"
                    >
                        <option value="TODO" name="TODO">TODO</option>
                        <option value="DOING" name="DOING">DOING</option>
                        <option value="DONE" name="DONE">DONE</option>
                    </select>

                    <div class="error-effect" v-if="errors.status">
                        <span class="text-sm text-red-400">{{
                            errors.status[0]
                        }}</span>
                    </div>
                </div>
                <div class="my-5">
                    <CustomLabel for="status"> Due Date </CustomLabel>
                    <input type="datetime-local" id="due_date" name="due_date" v-model="form.due_date" 
                        class="w-full  my-1 p-2 outline-none rounded hover:bg-sky-200 focus:ring-2 border-sky-800 border focus:ring-sky-900"
                                 
                    />
                    <div class="error-effect" v-if="errors.due_date">
                        <span class="text-sm text-red-400">{{
                            errors.due_date[0]
                        }}</span>
                    </div>
                </div>

                <CustomButton type="submit"> Add task</CustomButton>
            </form>
        </div>
    </div>
</template>

<script setup>
import CustomInput from "../components/CustomInput.vue";
import CustomButton from "../components/CustomButton.vue";
import CustomLabel from "../components/CustomLabel.vue";
import useTasks from "../repositories/task";
import { reactive } from "vue";

const { storeTask, errors } = useTasks();

const form = reactive({
    title: "",
    description: "",
    status: "",
});
</script>

<style lang="scss" scoped></style>
