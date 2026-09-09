<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppIcon from '@/Components/landing/AppIcon.vue';

const props = defineProps({
    auth: { type: Object, default: () => ({ user: null }) },
});

const scrolled = ref(false);
const mobileOpen = ref(false);
const dropdownOpen = ref(false);
const dropdownRef = ref(null);

const navLinks = [
    { label: 'Home', href: '/' },
    { label: 'Remove BG', href: '/remove-background' },
    { label: 'Change BG', href: '/change-background' },
    { label: 'Bulk Remove', href: '/bulk-remove' },
    { label: 'About', href: '/about' },
    { label: 'Contact', href: '/contact' },
];

function handleScroll() {
    scrolled.value = window.scrollY > 20;
}

function handleClickOutside(e) {
    if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
        dropdownOpen.value = false;
    }
}

function logout() {
    dropdownOpen.value = false;
    router.post('/logout');
}

function getInitial(name) {
    return name ? name.charAt(0).toUpperCase() : '?';
}

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    document.addEventListener('click', handleClickOutside);
});
onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <header
        class="fixed top-0 right-0 left-0 z-50 transition-all duration-300"
        :class="scrolled ? 'bg-white/95 shadow-lg shadow-black/5 backdrop-blur-md' : 'bg-transparent'"
    >
        <div class="container-wide flex h-18 items-center justify-between lg:h-20">
            <Link href="/" class="flex items-center gap-2.5">
                <AppIcon :size="36" />
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
                <template v-if="auth?.user">
                    <div ref="dropdownRef" class="relative">
                        <button
                            @click="dropdownOpen = !dropdownOpen"
                            class="flex cursor-pointer items-center gap-2.5 rounded-lg py-1.5 pl-1.5 pr-3 transition-colors duration-200"
                            :class="scrolled
                                ? 'hover:bg-surface-alt'
                                : 'hover:bg-white/10'"
                        >
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-primary text-sm font-bold text-white">
                                {{ getInitial(auth.user.name) }}
                            </div>
                            <span
                                class="text-sm font-medium"
                                :class="scrolled ? 'text-body' : 'text-white/90'"
                            >
                                {{ auth.user.name }}
                            </span>
                            <i
                                class="bi text-xs transition-transform duration-200"
                                :class="dropdownOpen ? 'bi-chevron-up' : 'bi-chevron-down'"
                                :style="scrolled ? '' : 'color: rgba(255,255,255,0.5)'"
                            ></i>
                        </button>

                        <Transition
                            enter-active-class="transition duration-150 ease-out"
                            enter-from-class="opacity-0 -translate-y-1 scale-95"
                            enter-to-class="opacity-100 translate-y-0 scale-100"
                            leave-active-class="transition duration-100 ease-in"
                            leave-from-class="opacity-100 translate-y-0 scale-100"
                            leave-to-class="opacity-0 -translate-y-1 scale-95"
                        >
                            <div
                                v-if="dropdownOpen"
                                class="absolute right-0 top-full mt-2 w-56 overflow-hidden rounded-xl bg-white shadow-xl ring-1 ring-black/5"
                            >
                                <div class="border-b border-border px-4 py-3">
                                    <p class="text-sm font-semibold text-heading">{{ auth.user.name }}</p>
                                    <p class="text-xs text-muted">{{ auth.user.email }}</p>
                                </div>
                                <div class="py-1">
                                    <button
                                        @click="logout"
                                        class="flex w-full cursor-pointer items-center gap-2.5 px-4 py-2.5 text-sm text-red-600 transition-colors hover:bg-red-50"
                                    >
                                        <i class="bi bi-box-arrow-right"></i>
                                        Sign Out
                                    </button>
                                </div>
                            </div>
                        </Transition>
                    </div>
                </template>
                <template v-else>
                    <Link
                        href="/login"
                        class="rounded-lg px-4 py-2 text-sm font-medium transition-colors duration-200"
                        :class="scrolled
                            ? 'text-body hover:bg-surface-alt hover:text-primary'
                            : 'text-white/80 hover:text-white hover:bg-white/10'"
                    >
                        Sign In
                    </Link>
                    <Link
                        href="/register"
                        class="btn-primary !py-2.5 !px-5 !text-sm"
                    >
                        Get Started
                    </Link>
                </template>
            </div>

            <button
                class="flex h-10 w-10 cursor-pointer items-center justify-center rounded-lg transition-colors lg:hidden"
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

                    <div class="my-2 border-t border-border"></div>

                    <template v-if="auth?.user">
                        <div class="flex items-center gap-3 px-4 py-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary text-sm font-bold text-white">
                                {{ getInitial(auth.user.name) }}
                            </div>
                            <div>
                                <p class="text-sm font-medium text-heading">{{ auth.user.name }}</p>
                                <p class="text-xs text-muted">{{ auth.user.email }}</p>
                            </div>
                        </div>
                        <button
                            @click="logout(); mobileOpen = false"
                            class="flex cursor-pointer items-center gap-2 rounded-lg px-4 py-3 text-sm font-medium text-red-600 transition-colors hover:bg-red-50"
                        >
                            <i class="bi bi-box-arrow-right"></i>
                            Sign Out
                        </button>
                    </template>
                    <template v-else>
                        <Link
                            href="/login"
                            class="rounded-lg px-4 py-3 text-sm font-medium text-body transition-colors hover:bg-surface-alt hover:text-primary"
                            @click="mobileOpen = false"
                        >
                            Sign In
                        </Link>
                        <Link
                            href="/register"
                            class="btn-primary mt-2 justify-center !text-sm"
                            @click="mobileOpen = false"
                        >
                            Get Started
                        </Link>
                    </template>
                </nav>
            </div>
        </Transition>
    </header>
</template>
