<script setup>
import { Link } from '@inertiajs/vue3';

const tools = [
    {
        title: 'Remove Background',
        description: 'Instantly remove the background from any image. Get a clean, transparent PNG cutout.',
        icon: 'bi-scissors',
        href: '/remove-background',
        gradient: 'from-primary to-blue-600',
        badge: 'Popular',
    },
    {
        title: 'Change Background',
        description: 'Replace the background of any photo. Pick from presets or upload your own.',
        icon: 'bi-palette',
        href: '/change-background',
        gradient: 'from-purple-500 to-violet-600',
        badge: 'New',
    },
    {
        title: 'Bulk Remove',
        description: 'Process up to 50 images at once. Real-time progress tracking and ZIP download.',
        icon: 'bi-layers',
        href: '/bulk-remove',
        gradient: 'from-heading to-dark-surface',
        badge: 'Pro',
    },
];
</script>

<template>
    <section class="section-padding bg-surface">
        <div class="container-wide">
            <div class="section-title">
                <span class="mb-3 inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
                    Our Tools
                </span>
                <h2>Everything You Need</h2>
                <p>Professional image editing tools that run entirely in your browser</p>
            </div>

            <div class="mx-auto grid max-w-5xl gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <Link
                    v-for="tool in tools"
                    :key="tool.href"
                    :href="tool.href"
                    class="group relative overflow-hidden rounded-2xl bg-white p-7 shadow-sm ring-1 ring-border transition-all duration-300 hover:shadow-xl hover:shadow-primary/5 hover:-translate-y-1"
                >
                    <div class="mb-5 flex items-center justify-between">
                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br text-white shadow-lg transition-transform duration-300 group-hover:scale-110"
                            :class="tool.gradient"
                        >
                            <i class="text-2xl" :class="tool.icon"></i>
                        </div>
                        <span class="rounded-full bg-primary/10 px-3 py-1 text-[10px] font-semibold text-primary">
                            {{ tool.badge }}
                        </span>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-heading group-hover:text-primary transition-colors">{{ tool.title }}</h3>
                    <p class="mb-4 text-sm leading-relaxed text-muted">{{ tool.description }}</p>
                    <div class="flex items-center gap-1.5 text-sm font-semibold text-primary">
                        Open tool
                        <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                    </div>
                </Link>
            </div>
        </div>
    </section>
</template>
