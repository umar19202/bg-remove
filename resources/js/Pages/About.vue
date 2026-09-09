<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PageHero from '@/Components/landing/PageHero.vue';

const values = [
    {
        icon: 'bi-shield-check',
        title: 'Privacy First',
        description: 'Your images never leave your browser. All processing happens locally on your device — no servers, no uploads, no risk.',
    },
    {
        icon: 'bi-lightning-charge',
        title: 'Fast & Free',
        description: 'Get professional-quality cutouts in seconds. No sign-up, no watermarks, no hidden fees. Just drop an image and go.',
    },
    {
        icon: 'bi-cpu',
        title: 'AI-Powered',
        description: 'Built on BiRefNet, a state-of-the-art deep learning model trained to detect and separate foreground subjects from any background.',
    },
    {
        icon: 'bi-laptop',
        title: 'Works Everywhere',
        description: 'No downloads, no installs. Works in any modern browser on desktop, tablet, or mobile — Chrome, Firefox, Safari, and Edge.',
    },
];

const stats = [
    { value: '100%', label: 'Client-Side' },
    { value: '0', label: 'Data Stored' },
    { value: 'Free', label: 'Forever' },
];
</script>

<template>
    <AppLayout title="About — BGRemover">
        <PageHero
            title="About BGRemover"
            subtitle="Free, private, AI-powered background removal that runs entirely in your browser."
        />

        <section class="section-padding bg-white">
            <div class="container-wide">
                <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
                    <div class="fade-in">
                        <h2 class="mb-4 text-3xl font-bold tracking-tight sm:text-4xl">
                            Background Removal
                            <span class="text-primary">Without the Hassle</span>
                        </h2>
                        <p class="mb-5 text-lg leading-relaxed text-muted">
                            BGRemover was built to solve a simple problem: removing backgrounds from images should be fast, free, and private. Most online tools require you to upload your images to their servers — we thought that was unnecessary.
                        </p>
                        <p class="mb-8 leading-relaxed text-muted">
                            Using BiRefNet, a cutting-edge AI model for image segmentation, we run the entire background removal process right in your browser. Your images are processed locally using WebAssembly and ONNX Runtime — nothing is ever sent to a server.
                        </p>

                        <div class="flex items-center gap-8">
                            <div v-for="stat in stats" :key="stat.label">
                                <p class="text-2xl font-bold text-primary">{{ stat.value }}</p>
                                <p class="text-sm text-muted">{{ stat.label }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="fade-in fade-in-delay-2">
                        <div class="relative overflow-hidden rounded-2xl bg-surface-alt p-8">
                            <div class="flex items-center gap-4 rounded-xl bg-white p-5 shadow-sm ring-1 ring-border">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary/10">
                                    <i class="bi bi-laptop text-xl text-primary"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-heading">100% Browser-Based</p>
                                    <p class="text-sm text-muted">No upload required. Processing happens on your device.</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center gap-4 rounded-xl bg-white p-5 shadow-sm ring-1 ring-border">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-green-50">
                                    <i class="bi bi-shield-check text-xl text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-heading">Zero Data Collection</p>
                                    <p class="text-sm text-muted">We don't store, log, or analyze your images.</p>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center gap-4 rounded-xl bg-white p-5 shadow-sm ring-1 ring-border">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-50">
                                    <i class="bi bi-code-slash text-xl text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-heading">Open Source Model</p>
                                    <p class="text-sm text-muted">Powered by BiRefNet — transparent, auditable AI.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding bg-surface-alt">
            <div class="container-wide">
                <div class="section-title">
                    <h2>Why BGRemover?</h2>
                    <p>Built with a focus on what matters most to users.</p>
                </div>

                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div
                        v-for="(value, i) in values"
                        :key="value.title"
                        class="card text-center fade-in"
                        :class="`fade-in-delay-${i + 1}`"
                    >
                        <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10">
                            <i class="bi text-2xl text-primary" :class="value.icon"></i>
                        </div>
                        <h3 class="mb-3 text-lg font-bold text-heading">{{ value.title }}</h3>
                        <p class="text-sm leading-relaxed text-muted">{{ value.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding bg-white">
            <div class="container-wide">
                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="mb-4 text-3xl font-bold tracking-tight sm:text-4xl">
                        The Technology Behind It
                    </h2>
                    <p class="mb-8 text-lg text-muted">
                        BGRemover uses BiRefNet (Bilateral Reference Network), a deep learning model designed for high-precision image segmentation. It identifies the main subject in any photo and creates a clean cutout with smooth edges — even around complex areas like hair and fur.
                    </p>

                    <div class="grid gap-6 sm:grid-cols-3">
                        <div class="rounded-xl bg-surface-alt p-6">
                            <p class="mb-1 text-sm font-medium text-primary">Step 1</p>
                            <p class="font-semibold text-heading">Upload</p>
                            <p class="mt-1 text-sm text-muted">Drop any image into the browser</p>
                        </div>
                        <div class="rounded-xl bg-surface-alt p-6">
                            <p class="mb-1 text-sm font-medium text-primary">Step 2</p>
                            <p class="font-semibold text-heading">AI Processing</p>
                            <p class="mt-1 text-sm text-muted">BiRefNet runs locally via ONNX Runtime Web</p>
                        </div>
                        <div class="rounded-xl bg-surface-alt p-6">
                            <p class="mb-1 text-sm font-medium text-primary">Step 3</p>
                            <p class="font-semibold text-heading">Download</p>
                            <p class="mt-1 text-sm text-muted">Get your clean PNG cutout instantly</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
