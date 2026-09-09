<script setup>
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    title: { type: String, required: true },
    subtitle: { type: String, default: '' },
});

const loaded = ref(false);
onMounted(() => { setTimeout(() => { loaded.value = true; }, 100); });
</script>

<template>
    <section class="relative overflow-hidden bg-dark-bg pt-28 pb-20 lg:pt-32 lg:pb-24">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 h-64 w-64 rounded-full bg-primary blur-[120px]"></div>
            <div class="absolute bottom-10 right-10 h-80 w-80 rounded-full bg-primary-light blur-[150px]"></div>
        </div>

        <div class="container-wide relative z-10">
            <div :class="loaded ? 'animate-slide-in-left' : 'opacity-0'">
                <nav class="mb-6 flex items-center gap-2 text-sm text-white/50">
                    <Link href="/" class="transition-colors hover:text-white">Home</Link>
                    <i class="bi bi-chevron-right text-xs"></i>
                    <span class="text-white/80">{{ title }}</span>
                </nav>

                <h1 class="mb-3 text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                    {{ title }}
                </h1>

                <p v-if="subtitle" class="max-w-xl text-lg text-white/60">
                    {{ subtitle }}
                </p>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </section>
</template>
