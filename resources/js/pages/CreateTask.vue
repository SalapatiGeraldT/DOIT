<template>
    <DashboardHeader />

    <transition name="view" appear mode="out-in">
        <div class="text-black text-sm flex justify-center">
            <CreateForm />
        </div>
    </transition>
</template>

<script setup>
import CreateForm from "../components/CreateForm.vue";
import DashboardHeader from "../components/DashboardHeader.vue";
</script>

<style scoped>
.view-enter-from {
    opacity: 0;
    transform: translateY(-50px);
}
.view-enter-active {
    transition: all 0.3s ease-out;
    /* transition-delay: 1.5s; */
}

.view-leave-to {
    opacity: 0;
    transform: translateY(50);
}
.view-leave-active {
    transition: all 0.3s ease-in;
}
</style>

// , destroyPost
