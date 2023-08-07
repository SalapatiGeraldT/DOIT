<template>
    <div class="mx-[min(1vw,7rem)]">
        <div class="relative">
            <div class=" ">
                <div class="absolute my-16 h-full w-full" style="z-index: -1">
                    <div
                        class="flex flex-col justify-around outline-stroke text-[min(10vw,10rem)] w-full h-5/6"
                    >
                        <div class="flex justify-start">YOUR OWN</div>
                        <div class="flex justify-end">TODO LIST</div>
                    </div>
                </div>
            </div>
            <div
                class="flex justify-center items-center headerSpace teko text-[min(10vw,8rem)] font-bold leading-none"
            >
                <div class=" ">
                    <div>
                        <div class="text-slate-600">
                            <div>Let's</div>
                            <!-- <div>
                            D
                        </div> -->
                        </div>
                    </div>
                    <div class=" ">
                        <div class="flex justify-between">
                            <div class="text-blue-950">DOIT</div>
                            <div class="rounded px-4 flex items-center">
                                <transition
                                    appear
                                    @before-enter="beforeEnter"
                                    @enter="enter"
                                    @after-enter="afterEnter"
                                    @before-leave="beforeLeave"
                                    @leave="leave"
                                    @after-leave="afterLeave"
                                >
                                    <img
                                        class="skillsLogo w-[min(6vw,5rem)] md:pb-3 sm:pb-2 pb-1 change"
                                        alt="Gerald's Skills Logo"
                                        :key="currentImageIndex.value"
                                        ref="image"
                                        src="img/check.png"
                                        v-if="title"
                                    />
                                </transition>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="flex justify-between">
                            <div class="text-slate-600">& Make It</div>
                        </div>
                    </div>

                    <div
                        v-if="hasToken"
                        class="flex justify-center items-center mt-8"
                    >
                        <RouterLink
                            class="text-[min(5vw,2rem)] px-8 py-2 bg-blue-950 text-white rounded hover:bg-sky-200 hover:text-black"
                            :to="{ name: 'Dashboard' }"
                            >Dashboard
                        </RouterLink>
                    </div>
                    <div v-else class="flex justify-center items-center mt-8">
                        <RouterLink
                            class="text-[min(5vw,2rem)] px-8 py-2 bg-blue-950 text-white rounded hover:bg-sky-200 hover:text-black"
                            :to="{ name: 'Login' }"
                            >Login
                        </RouterLink>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import gsap from "gsap";
const title = ref(true);

const token = ref(localStorage.getItem("token"));
const name = ref(localStorage.getItem("firstName"));

const hasToken = computed(() => {
    return token.value !== null;
});

const images = ref(["img/sync.png", "img/checklist.png", "img/check.png"]);
const currentImageIndex = ref(0);

const beforeEnter = (el) => {
    el.style.opacity = 1;
    el.src = images.value[currentImageIndex.value];
};

const enter = (el, done) => {
    gsap.to(el, {
        opacity: 1,
        rotate: 360,
        duration: 0.2,
        onComplete: () => {
            done();
            if (currentImageIndex.value === images.value.length - 1) {
                currentImageIndex.value = 0;
            } else {
                currentImageIndex.value++;
            }
        },
        ease: "power2.out",
    });
    el.src = images.value[currentImageIndex.value];
};
const afterEnter = (el) => {
    setTimeout(() => (title.value = false), 2000);
};
const beforeLeave = (el) => {
    el.style.opacity = 0.5;
};

const leave = (el) => {
    gsap.to(el, {
        opacity: 0,
        duration: 0.1,
    });
};

const afterLeave = (el) => {
    el.style.opacity = 0.5;

    setTimeout(() => (title.value = true), 100);
};
</script>

<style lang="scss" scoped></style>
