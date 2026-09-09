<script setup>
import { ref } from 'vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import AppIcon from '@/Components/landing/AppIcon.vue';

const page = usePage();
const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);

function submit() {
    form.post('/login', {
        preserveState: true,
        onFinish: () => form.reset('password'),
    });
}
</script>

<template>
    <div class="flex min-h-screen bg-surface-alt">
        <!-- Left Panel -->
        <div class="hidden w-1/2 bg-dark-bg lg:flex lg:items-center lg:justify-center">
            <div class="px-12 text-center">
                <Link href="/" class="mb-8 inline-flex items-center gap-2.5">
                    <AppIcon :size="44" />
                    <span class="text-3xl font-bold tracking-tight text-white">
                        BG<span class="text-primary-light">Remover</span>
                    </span>
                </Link>
                <p class="mb-8 max-w-sm text-lg text-white/60">
                    Sign in to track your usage and manage your account.
                </p>
                <div class="flex items-center justify-center gap-6 text-sm text-white/40">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-shield-check text-primary-light"></i>
                        <span>Secure Login</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="bi bi-laptop text-primary-light"></i>
                        <span>100% Private</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="flex w-full items-center justify-center px-5 py-12 lg:w-1/2">
            <div class="w-full max-w-md">
                <div class="mb-8 text-center lg:hidden">
                    <Link href="/" class="inline-flex items-center gap-2.5">
                        <AppIcon :size="36" />
                        <span class="text-xl font-bold tracking-tight text-heading">
                            BG<span class="text-primary">Remover</span>
                        </span>
                    </Link>
                </div>

                <h1 class="mb-2 text-2xl font-bold text-heading">Welcome Back</h1>
                <p class="mb-8 text-muted">Sign in to your account to continue.</p>

                <div v-if="page.props.errors?.email" class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-600">
                    {{ page.props.errors.email }}
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label for="email" class="mb-1.5 block text-sm font-medium text-heading">Email</label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
                            autocomplete="email"
                            placeholder="you@example.com"
                            class="w-full rounded-lg border border-border bg-white px-4 py-3 text-sm text-heading placeholder:text-muted/50 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                        />
                        <p v-if="form.errors.email" class="mt-1 text-xs text-red-500">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-medium text-heading">Password</label>
                        <div class="relative">
                            <input
                                id="password"
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                                class="w-full rounded-lg border border-border bg-white px-4 py-3 pr-11 text-sm text-heading placeholder:text-muted/50 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                            />
                            <button
                                type="button"
                                class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-muted hover:text-heading"
                                @click="showPassword = !showPassword"
                            >
                                <i :class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                            </button>
                        </div>
                        <p v-if="form.errors.password" class="mt-1 text-xs text-red-500">{{ form.errors.password }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <input
                            id="remember"
                            v-model="form.remember"
                            type="checkbox"
                            class="h-4 w-4 rounded border-border text-primary focus:ring-primary/20"
                        />
                        <label for="remember" class="text-sm text-muted">Remember me</label>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="btn-primary w-full justify-center"
                    >
                        <i v-if="form.processing" class="bi bi-arrow-repeat animate-spin"></i>
                        {{ form.processing ? 'Signing in...' : 'Sign In' }}
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-muted">
                    Don't have an account?
                    <Link href="/register" class="font-medium text-primary hover:text-primary-dark">
                        Create one
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>
