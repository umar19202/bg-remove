<script setup>
import { Link } from '@inertiajs/vue3';
import AppIcon from '@/Components/landing/AppIcon.vue';

const currentYear = new Date().getFullYear();

const footerLinks = {
    Product: [
        { label: 'Remove Background', href: '/remove-background' },
        { label: 'Change Background', href: '/change-background' },
        { label: 'Bulk Remove', href: '/bulk-remove' },
        { label: 'How It Works', href: '/#how-it-works' },
    ],
    Resources: [
        { label: 'About Us', href: '/about' },
        { label: 'Documentation', href: '#' },
        { label: 'API (Coming Soon)', href: '#' },
        { label: 'Blog', href: '#' },
    ],
    Legal: [
        { label: 'Privacy Policy', href: '/privacy' },
        { label: 'Terms of Service', href: '/terms' },
        { label: 'Contact Us', href: '/contact' },
    ],
};

const socialLinks = [
    { icon: 'bi-twitter-x', href: '#', label: 'Twitter' },
    { icon: 'bi-github', href: '#', label: 'GitHub' },
    { icon: 'bi-envelope', href: '#', label: 'Email' },
];
</script>

<template>
    <footer class="bg-heading pt-16 pb-8">
        <div class="container-wide">
            <div class="grid gap-12 pb-12 sm:grid-cols-2 lg:grid-cols-5 lg:gap-8">
                <div class="lg:col-span-2">
                    <Link href="/" class="mb-5 flex items-center gap-2.5">
                        <AppIcon :size="36" />
                        <span class="text-xl font-bold tracking-tight text-white">
                            BG<span class="text-primary-light">Remover</span>
                        </span>
                    </Link>
                    <p class="mb-6 max-w-xs text-sm leading-relaxed text-white/50">
                        Free AI-powered background removal tool. Upload any image and get a clean,
                        transparent cutout in seconds.
                    </p>
                    <div class="flex items-center gap-3">
                        <a
                            v-for="social in socialLinks"
                            :key="social.label"
                            :href="social.href"
                            :aria-label="social.label"
                            class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/5 text-white/50 transition-all duration-200 hover:bg-primary/20 hover:text-primary-light"
                        >
                            <i class="bi" :class="social.icon"></i>
                        </a>
                    </div>
                </div>

                <div v-for="(links, category) in footerLinks" :key="category">
                    <h4 class="mb-5 text-sm font-semibold uppercase tracking-wider text-white/80">{{ category }}</h4>
                    <ul class="space-y-3">
                        <li v-for="link in links" :key="link.label">
                            <Link
                                :href="link.href"
                                class="text-sm text-white/40 transition-colors duration-200 hover:text-white"
                            >
                                {{ link.label }}
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 pt-8">
                <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                    <p class="text-sm text-white/40">
                        &copy; {{ currentYear }} BGRemover. All rights reserved.
                    </p>
                    <p class="text-xs text-white/30">
                        Powered by BiRefNet AI &middot; MIT Licensed
                    </p>
                </div>
            </div>
        </div>
    </footer>
</template>
