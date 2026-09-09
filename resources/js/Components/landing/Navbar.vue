<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const scrolled = ref(false);
const mobileOpen = ref(false);

const navLinks = [
    { label: 'Home', href: '/' },
    { label: 'Remove BG', href: '/remove-background' },
    { label: 'Change BG', href: '/change-background' },
    { label: 'Bulk Remove', href: '/bulk-remove' },
];

function handleScroll() {
    scrolled.value = window.scrollY > 20;
}

onMounted(() => window.addEventListener('scroll', handleScroll));
onUnmounted(() => window.removeEventListener('scroll', handleScroll));
</script>

<template>
    <header
        class="fixed top-0 right-0 left-0 z-50 transition-all duration-300"
        :class="scrolled ? 'bg-white/95 shadow-lg shadow-black/5 backdrop-blur-md' : 'bg-transparent'"
    >
        <div class="container-wide flex h-18 items-center justify-between lg:h-20">
            <Link href="/" class="flex items-center gap-2.5">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-primary">
                    <i class="bi bi-layers-fill text-lg text-white"></i>
                </div>
                <span
                    class="text-xl font-bold tracking-tight"
                    :class="scrolled ? 'text-heading' : 'text-white'"
                >
                    BG<span class="text-primary">Remover</span>
                </span>
            </Link>

            <nav class="hidden items-center gap-1 lg:flex">
                <Link
                    v-for="link in navLinks"
                    :key="link.href"
                    :href="link.href"
                    class="rounded-lg px-4 py-2 text-sm font-medium transition-colors duration-200"
                    :class="scrolled
                        ? 'text-body hover:bg-surface-alt hover:text-primary'
                        : 'text-white/80 hover:text-white hover:bg-white/10'"
                >
                    {{ link.label }}
                </Link>
            </nav>

            <div class="hidden items-center gap-3 lg:flex">
                <Link
                    href="/remove-background"
                    class="btn-primary !py-2.5 !px-5 !text-sm"
                >
                    <i class="bi bi-cloud-arrow-up"></i>
                    Remove Background
                </Link>
            </div>

            <button
                class="flex h-10 w-10 items-center justify-center rounded-lg transition-colors lg:hidden"
                :class="scrolled ? 'text-heading hover:bg-surface-alt' : 'text-white hover:bg-white/10'"
                @click="mobileOpen = !mobileOpen"
            >
                <i :class="mobileOpen ? 'bi bi-x-lg text-xl' : 'bi bi-list text-2xl'"></i>
            </button>
        </div>

        <Transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0 -translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-2"
        >
            <div
                v-if="mobileOpen"
                class="border-t border-border bg-white px-5 py-4 shadow-xl lg:hidden"
            >
                <nav class="flex flex-col gap-1">
                    <Link
                        v-for="link in navLinks"
                        :key="link.href"
                        :href="link.href"
                        class="rounded-lg px-4 py-3 text-sm font-medium text-body transition-colors hover:bg-surface-alt hover:text-primary"
                        @click="mobileOpen = false"
                    >
                        {{ link.label }}
                    </Link>

                    <Link
                        href="/remove-background"
                        class="btn-primary mt-2 justify-center !text-sm"
                        @click="mobileOpen = false"
                    >
                        <i class="bi bi-cloud-arrow-up"></i>
                        Remove Background
                    </Link>
                </nav>
            </div>
        </Transition>
    </header>
</template>
