<script setup>
const features = [
    {
        icon: 'bi-lightning-charge',
        title: 'Lightning Fast',
        description: 'Get your result in seconds, right in your browser. No waiting, no queues — instant background removal.',
        gradient: 'from-primary to-blue-600',
    },
    {
        icon: 'bi-shield-check',
        title: 'Private & Secure',
        description: '100% local processing. Your photos never leave your device — there\'s no server to store or leak them.',
        gradient: 'from-primary/80 to-blue-500',
    },
    {
        icon: 'bi-cpu',
        title: 'AI-Powered Accuracy',
        description: 'BiRefNet Lite model delivers pixel-perfect cutouts, even with complex edges like hair and fur.',
        gradient: 'from-heading to-dark-surface',
    },
    {
        icon: 'bi-file-earmark-image',
        title: 'Multiple Formats',
        description: 'Supports JPG, PNG, and WebP input. Output is always a clean transparent PNG.',
        gradient: 'from-primary to-blue-700',
    },
    {
        icon: 'bi-phone',
        title: 'Works Everywhere',
        description: 'Fully responsive — works on desktop, tablet, and mobile. No app download needed.',
        gradient: 'from-primary/70 to-blue-400',
    },
    {
        icon: 'bi-gift',
        title: 'Completely Free',
        description: 'No sign-up, no watermarks, no limits. Remove backgrounds from unlimited images for free.',
        gradient: 'from-heading to-primary-dark',
    },
];
</script>

<template>
    <section id="features" class="section-padding bg-surface-alt">
        <div class="container-wide">
            <div class="section-title">
                <span class="mb-3 inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
                    Why Choose Us
                </span>
                <h2>Everything You Need</h2>
                <p>Built with the latest AI technology to deliver the best background removal experience</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="(feature, index) in features"
                    :key="index"
                    class="card group cursor-default"
                >
                    <div class="mb-5 flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br text-white shadow-lg transition-transform duration-300 group-hover:scale-110"
                         :class="feature.gradient">
                        <i class="text-2xl" :class="feature.icon"></i>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-heading">{{ feature.title }}</h3>
                    <p class="text-sm leading-relaxed text-muted">{{ feature.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>
