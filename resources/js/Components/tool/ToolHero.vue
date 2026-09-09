<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    eyebrow: { type: String, default: 'Free Online Tool' },
    title: { type: String, required: true },
    highlight: { type: String, default: '' },
    description: { type: String, default: '' },
    ctaLabel: { type: String, default: 'Get Started' },
    ctaHref: { type: String, default: '#upload' },
    benefits: { type: Array, default: () => [] },
});

const loaded = ref(false);

function scrollTo(selector) {
    const el = document.querySelector(selector);
    if (el) el.scrollIntoView({ behavior: 'smooth' });
}

onMounted(() => {
    setTimeout(() => { loaded.value = true; }, 100);
});
</script>

<template>
    <section class="relative min-h-screen overflow-hidden bg-dark-bg pt-24 lg:pt-0">
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
                            {{ eyebrow }}
                        </span>
                    </div>

                    <h1 class="mb-4 text-4xl font-extrabold leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl">
                        {{ title }}
                        <span v-if="highlight" class="block bg-gradient-to-r from-primary-light to-blue-300 bg-clip-text text-transparent">
                            {{ highlight }}
                        </span>
                    </h1>

                    <p v-if="description" class="mb-8 max-w-lg text-lg leading-relaxed text-white/70">
                        {{ description }}
                    </p>

                    <div class="mb-10 flex flex-wrap items-center gap-4">
                        <a :href="ctaHref" class="btn-primary !px-8 !py-4 !text-base" @click.prevent="scrollTo(ctaHref)">
                            <i class="bi bi-cloud-arrow-up text-lg"></i>
                            {{ ctaLabel }}
                        </a>
                    </div>

                    <div v-if="benefits.length" class="flex flex-wrap items-center gap-6 text-sm text-white/50">
                        <div v-for="benefit in benefits" :key="benefit" class="flex items-center gap-2">
                            <i class="bi bi-check-circle-fill text-primary-light"></i>
                            <span>{{ benefit }}</span>
                        </div>
                    </div>
                </div>

                <div :class="loaded ? 'animate-slide-in-right' : 'opacity-0'" class="hidden lg:block">
                    <div class="relative">
                        <div class="relative z-10 overflow-hidden rounded-2xl bg-white/10 p-1.5 shadow-2xl backdrop-blur-sm">
                            <div class="overflow-hidden rounded-xl bg-white">
                                <slot />
                            </div>
                        </div>

                        <div class="animate-float absolute -top-3 -right-3 z-20 rounded-xl bg-white px-3.5 py-2.5 shadow-xl">
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

                        <div class="animate-float-delay absolute -bottom-3 -left-3 z-20 rounded-xl bg-white px-3.5 py-2.5 shadow-xl">
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
