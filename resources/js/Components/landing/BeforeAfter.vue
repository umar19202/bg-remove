<script setup>
import { ref } from 'vue';

const samples = [
    { label: 'Portrait', icon: 'bi-person-bounding-box' },
    { label: 'Product', icon: 'bi-bag' },
    { label: 'Animal', icon: 'bi-heart' },
    { label: 'Object', icon: 'bi-box' },
];

const activeSample = ref(0);
</script>

<template>
    <section id="gallery" class="section-padding bg-surface">
        <div class="container-wide">
            <div class="section-title">
                <span class="mb-3 inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
                    Results
                </span>
                <h2>See the Difference</h2>
                <p>Professional-quality cutouts from any type of image</p>
            </div>

            <div class="mx-auto mb-10 flex max-w-lg flex-wrap items-center justify-center gap-3">
                <button
                    v-for="(sample, index) in samples"
                    :key="index"
                    class="flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-medium transition-all duration-200"
                    :class="activeSample === index
                        ? 'bg-primary text-white shadow-lg shadow-primary/25'
                        : 'bg-surface-alt text-muted hover:bg-primary/10 hover:text-primary'"
                    @click="activeSample = index"
                >
                    <i class="bi" :class="sample.icon"></i>
                    {{ sample.label }}
                </button>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div
                    v-for="i in 4"
                    :key="i"
                    class="group overflow-hidden rounded-2xl bg-surface-alt shadow-sm ring-1 ring-border transition-all duration-300 hover:shadow-lg"
                >
                    <div class="relative aspect-square overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-primary/5 to-primary/10">
                            <i class="bi bi-image text-5xl text-primary/20"></i>
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center bg-[repeating-conic-gradient(#e5e7eb_0%_25%,transparent_0%_50%)] bg-[length:12px_12px] opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            <div class="rounded-xl bg-white/90 px-4 py-2 shadow-lg backdrop-blur-sm">
                                <span class="text-xs font-semibold text-primary">Before → After</span>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 text-center">
                        <p class="text-sm font-medium text-heading">Sample {{ i }}</p>
                        <p class="text-xs text-muted">Clean transparent cutout</p>
                    </div>
                </div>
            </div>

            <p class="mt-8 text-center text-sm text-muted">
                <i class="bi bi-info-circle mr-1"></i>
                Sample results shown above. Upload your own image to see real results.
            </p>
        </div>
    </section>
</template>
