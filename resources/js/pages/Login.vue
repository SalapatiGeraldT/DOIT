<template>
    <main>
        <div class="my-5 flex items-center flex-col justify-center">
            <Title>
                <template #title> DOIT </template>
                <template #desc> Login </template>
            </Title>

            <transition
                name="view"
                appear
                mode="out-in"
                class="bg-white px-6 py-8  rounded my-8 md:w-3/6 w-full"
            >
                <form @submit.prevent="loginUser(form)">
                    <div class="my-5">
                        <CustomLabel for="email"> Email </CustomLabel>
                        <CustomInput
                            class="w-full"
                            name="email"
                            placeholder="Enter email"
                            type="text"
                            @input-value="
                                (input) => {
                                    form.email = input;
                                }
                            "
                        />
                        <div class="error-effect" v-if="errors.email">
                            <span class="text-sm text-red-400">{{
                                errors.email[0]
                            }}</span>
                        </div>
                    </div>
                    <div class="my-5">
                        <CustomLabel for="password"> Password </CustomLabel>
                        <CustomInput
                            class="w-full"
                            name="password"
                            placeholder="Enter password"
                            type="password"
                            @input-value="
                                (input) => {
                                    form.password = input;
                                }
                            "
                        />
                        <div class="error-effect" v-if="errors.password">
                            <span class="text-sm text-red-400">{{
                                errors.password[0]
                            }}</span>
                        </div>
                    </div>

                    <br />
                    <CustomButton type="submit">
                        Login with email
                    </CustomButton>

                    <div class="error-effect" v-if="message">
                        <span class="text-sm text-red-400">{{ message }}</span>
                    </div>

                    <div class="my-3 text-center">
                        Not registered yet?

                        <RouterLink
                            class="text-blue-700"
                            :to="{ name: 'Register' }"
                        >
                            Create an Account
                        </RouterLink>
                    </div>
                </form>
            </transition>
        </div>
    </main>
</template>

<script setup>
import Title from "../components/Title.vue";
import CustomInput from "../components/CustomInput.vue";
import { reactive } from "vue";
import CustomLabel from "../components/CustomLabel.vue";
import CustomButton from "../components/CustomButton.vue";
import useUsers from "../repositories/user";
import { RouterLink } from "vue-router";

const { loginUser, errors, message } = useUsers();

const form = reactive({
    email: "",
    password: "",
});
</script>
<style scoped>
.view-enter-from {
    opacity: 0;
    transform: translateY(80px);
}

.view-enter-active {
    transition: all 0.8s ease-out;
}

.view-leave-to {
    opacity: 0;
    transform: translateY(-80px);
}

.view-leave-active {
    transition: all 0.3s ease-in;
}
</style>
