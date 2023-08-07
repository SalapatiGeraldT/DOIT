<script setup>
import { RouterLink, RouterView } from "vue-router";
import { computed, ref } from "vue";

const token = ref(localStorage.getItem("token"));
const name = ref(localStorage.getItem("firstName"));

const hasToken = computed(() => {
    return token.value !== null;
});

const logout = async () => {
    localStorage.removeItem("token");
    localStorage.removeItem("firstName");
    token.value = null;
    name.value = null;
    window.location.reload();
};
</script>

<template>
    <div class="flex flex-col justify-between h-screen">
        <div class="flex">
            <div class="grow">
                <div
                    class="py-8 mx-[min(5vw,7rem)] flex justify-between mulish"
                >
                    <RouterLink
                        class="hover:text-blue-500"
                        :to="{ name: 'Home' }"
                        >Doit
                    </RouterLink>
                    <nav class="text-sm">
                        <ul class="flex space-x-3">
                            <li v-if="!hasToken">
                                <RouterLink
                                    :class="{
                                        'text-blue-500': $route.name == 'Home',
                                    }"
                                    class="hover:text-blue-500"
                                    :to="{ name: 'Home' }"
                                    >Home
                                </RouterLink>
                            </li>
                            <li v-if="!hasToken">
                                <RouterLink
                                    :class="{
                                        'text-blue-500': $route.name == 'Login',
                                    }"
                                    class="hover:text-blue-500"
                                    :to="{ name: 'Login' }"
                                    >Login
                                </RouterLink>
                            </li>
                            <li v-if="!hasToken">
                                <RouterLink
                                    :class="{
                                        'text-blue-500':
                                            $route.name == 'Register',
                                    }"
                                    class="hover:text-blue-500"
                                    :to="{ name: 'Register' }"
                                    >Register
                                </RouterLink>
                            </li>

                            <li>
                                <div v-if="hasToken" :value="name">
                                    Hi {{ name }}
                                </div>
                            </li>

                            <li v-if="hasToken">
                                <RouterLink
                                    :class="{
                                        'text-blue-500':
                                            $route.name == 'Dashboard',
                                    }"
                                    class="hover:text-blue-500"
                                    :to="{ name: 'Dashboard' }"
                                    >Dashboard
                                </RouterLink>
                            </li>
                            <li v-if="hasToken">
                                <div
                                    @click="logout"
                                    class="text-black hover:text-indigo-400 cursor-pointer"
                                >
                                    Logout
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="mx-[min(5vw,7rem)]">
                    <main>
                        <RouterView />
                    </main>
                </div>
            </div>
        </div>

        <footer class="mt-16">
            <div class="p-6 text-center">&#169; 2023 Gerald Salapati.</div>
        </footer>
    </div>
</template>

<style scoped></style>
