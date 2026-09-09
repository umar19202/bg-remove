<script setup>
import { ref, onMounted } from 'vue';

const loaded = ref(false);
const activeStep = ref(0);

const steps = [
    { icon: 'bi-cloud-arrow-up', label: 'Upload' },
    { icon: 'bi-cpu', label: 'Process' },
    { icon: 'bi-download', label: 'Download' },
];

onMounted(() => {
    setTimeout(() => { loaded.value = true; }, 100);
    setInterval(() => {
        activeStep.value = (activeStep.value + 1) % 3;
    }, 2400);
});
</script>

<template>
    <section id="hero" class="relative min-h-screen overflow-hidden bg-dark-bg pt-24 lg:pt-0">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 h-72 w-72 rounded-full bg-primary blur-[120px]"></div>
            <div class="absolute bottom-20 right-10 h-96 w-96 rounded-full bg-primary-light blur-[150px]"></div>
        </div>

        <div class="container-wide relative z-10 flex min-h-screen items-center py-20">
            <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">

                <div :class="loaded ? 'animate-slide-in-left' : 'opacity-0'">
                    <div class="mb-5 flex flex-wrap items-center gap-3">
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-4 py-1.5 text-xs font-medium text-white/90 backdrop-blur-sm">
                            <i class="bi bi-laptop text-primary-light"></i>
                            100% Browser-Based
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-primary/20 px-4 py-1.5 text-xs font-medium text-primary-light backdrop-blur-sm">
                            <i class="bi bi-lightning-charge-fill"></i>
                            Fast & Free
                        </span>
                    </div>

                    <h1 class="mb-4 text-4xl font-extrabold leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl">
                        Remove Background
                        <span class="block bg-gradient-to-r from-primary-light to-blue-300 bg-clip-text text-transparent">
                            From Any Image
                        </span>
                    </h1>

                    <p class="mb-8 max-w-lg text-lg leading-relaxed text-white/70">
                        Drop any image and get a clean, professional cutout in seconds.
                        Everything runs locally in your browser — nothing leaves your device.
                    </p>

                    <div class="mb-10 flex flex-wrap items-center gap-4">
                        <a href="#upload" class="btn-primary !px-8 !py-4 !text-base" @click.prevent="document.querySelector('#upload')?.scrollIntoView({ behavior: 'smooth' })">
                            <i class="bi bi-cloud-arrow-up text-lg"></i>
                            Start Removing — It's Free
                        </a>
                        <a href="#how-it-works" class="inline-flex items-center gap-2 text-sm font-medium text-white/70 transition-colors hover:text-white" @click.prevent="document.querySelector('#how-it-works')?.scrollIntoView({ behavior: 'smooth' })">
                            See How It Works
                            <i class="bi bi-arrow-down-short text-lg"></i>
                        </a>
                    </div>

                    <div class="flex items-center gap-6 text-sm text-white/50">
                        <div class="flex items-center gap-2">
                            <i class="bi bi-shield-check text-primary-light"></i>
                            <span>100% Private</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="bi bi-laptop text-primary-light"></i>
                            <span>Runs in browser</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="bi bi-image text-primary-light"></i>
                            <span>PNG output</span>
                        </div>
                    </div>
                </div>

                <div :class="loaded ? 'animate-slide-in-right' : 'opacity-0'" class="hidden lg:block">
                    <div class="relative flex items-center justify-center" style="height: 420px;">

                        <!-- Central hub -->
                        <div class="relative z-20 flex h-28 w-28 items-center justify-center rounded-full bg-gradient-to-br from-primary to-blue-600 shadow-2xl shadow-primary/40">
                            <div class="absolute inset-0 rounded-full bg-primary/20 animate-pulse-ring"></div>
                            <i class="bi bi-layers-fill text-4xl text-white"></i>
                        </div>

                        <!-- Orbit ring -->
                        <div class="absolute inset-8 rounded-full border border-white/10"></div>
                        <div class="absolute inset-16 rounded-full border border-white/5"></div>

                        <!-- Floating tool cards -->
                        <div
                            v-for="(tool, i) in [
                                { icon: 'bi-scissors', label: 'Remove BG', color: 'from-primary to-blue-600', angle: 0 },
                                { icon: 'bi-palette', label: 'Change BG', color: 'from-purple-500 to-violet-600', angle: 120 },
                                { icon: 'bi-layers', label: 'Bulk Remove', color: 'from-heading to-dark-surface', angle: 240 },
                            ]"
                            :key="tool.label"
                            class="absolute z-10"
                            :style="{
                                top: `calc(50% + ${Math.sin(tool.angle * Math.PI / 180) * 140}px - 32px)`,
                                left: `calc(50% + ${Math.cos(tool.angle * Math.PI / 180) * 140}px - 32px)`,
                                animation: `float ${3 + i * 0.5}s ease-in-out ${i * 0.8}s infinite`,
                            }"
                        >
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br text-white shadow-xl backdrop-blur-sm"
                                 :class="tool.color">
                                <i class="text-2xl" :class="tool.icon"></i>
                            </div>
                            <p class="mt-1.5 text-center text-[10px] font-medium text-white/60">{{ tool.label }}</p>
                        </div>

                        <!-- Processing steps indicator -->
                        <div class="absolute -bottom-2 left-1/2 z-30 -translate-x-1/2">
                            <div class="flex items-center gap-2 rounded-full bg-white/10 px-5 py-2.5 backdrop-blur-md">
                                <div
                                    v-for="(step, i) in steps"
                                    :key="step.label"
                                    class="flex items-center gap-1.5"
                                >
                                    <div
                                        class="flex h-6 w-6 items-center justify-center rounded-full text-[10px] transition-all duration-500"
                                        :class="activeStep === i
                                            ? 'bg-primary text-white shadow-lg shadow-primary/40'
                                            : 'bg-white/10 text-white/40'"
                                    >
                                        <i class="bi" :class="step.icon"></i>
                                    </div>
                                    <span
                                        class="text-[10px] font-medium transition-colors duration-500"
                                        :class="activeStep === i ? 'text-white' : 'text-white/30'"
                                    >
                                        {{ step.label }}
                                    </span>
                                    <i v-if="i < 2" class="bi bi-chevron-right text-[8px] text-white/20"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Floating badges -->
                        <div class="animate-float absolute top-4 right-4 z-20 rounded-xl bg-white px-3.5 py-2.5 shadow-xl">
                            <div class="flex items-center gap-2">
                                <div class="flex h-7 w-7 items-center justify-center rounded-full bg-green-100">
                                    <i class="bi bi-lightning-charge-fill text-xs text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold text-heading">Fast</p>
                                    <p class="text-[9px] text-muted">In-browser</p>
                                </div>
                            </div>
                        </div>

                        <div class="animate-float-delay absolute bottom-12 left-4 z-20 rounded-xl bg-white px-3.5 py-2.5 shadow-xl">
                            <div class="flex items-center gap-2">
                                <div class="flex h-7 w-7 items-center justify-center rounded-full bg-primary/10">
                                    <i class="bi bi-shield-check text-xs text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-[11px] font-bold text-heading">Private</p>
                                    <p class="text-[9px] text-muted">Never uploaded</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </section>
</template>
