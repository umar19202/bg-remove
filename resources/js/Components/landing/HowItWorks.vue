<script setup>
const steps = [
    {
        icon: 'bi-cloud-arrow-up',
        title: 'Upload Your Image',
        description: 'Drag and drop or click to select any JPG, PNG, or WebP image up to 15MB.',
        color: 'bg-primary/10 text-primary',
    },
    {
        icon: 'bi-cpu',
        title: 'AI Processes It',
        description: 'Our BiRefNet AI model analyzes your image and identifies the subject in just a few seconds, right in your browser.',
        color: 'bg-heading/5 text-heading',
    },
    {
        icon: 'bi-download',
        title: 'Download Result',
        description: 'Get a clean, transparent PNG cutout ready for any use — design, e-commerce, or social.',
        color: 'bg-primary/10 text-primary',
    },
];
</script>

<template>
    <section id="how-it-works" class="section-padding bg-surface">
        <div class="container-wide">
            <div class="section-title">
                <span class="mb-3 inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
                    Simple Process
                </span>
                <h2>How It Works</h2>
                <p>Three simple steps to get a professional-quality cutout from any image</p>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                <div
                    v-for="(step, index) in steps"
                    :key="index"
                    class="group relative text-center"
                >
                    <div v-if="index < steps.length - 1" class="absolute top-12 left-[60%] hidden h-px w-[80%] border-t-2 border-dashed border-border md:block"></div>

                    <div class="relative z-10 mx-auto mb-6 flex h-24 w-24 items-center justify-center rounded-2xl transition-all duration-300 group-hover:scale-110"
                         :class="step.color">
                        <i class="text-4xl" :class="step.icon"></i>
                    </div>

                    <div class="absolute -top-3 left-1/2 flex h-7 w-7 -translate-x-1/2 items-center justify-center rounded-full bg-heading text-xs font-bold text-white shadow-lg">
                        {{ index + 1 }}
                    </div>

                    <h3 class="mb-3 text-xl font-bold text-heading">{{ step.title }}</h3>
                    <p class="mx-auto max-w-xs text-sm leading-relaxed text-muted">{{ step.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>
