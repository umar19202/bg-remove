<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import PageHero from '@/Components/landing/PageHero.vue';

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

const submitted = ref(false);

function submit() {
    form.post('/contact', {
        onSuccess: () => {
            submitted.value = true;
            form.reset();
        },
    });
}

const contactInfo = [
    {
        icon: 'bi-envelope',
        title: 'Email',
        value: 'hello@bgremover.com',
        description: 'We typically respond within 24 hours.',
    },
    {
        icon: 'bi-github',
        title: 'GitHub',
        value: 'github.com/bgremover',
        description: 'Report issues or contribute to the project.',
    },
    {
        icon: 'bi-twitter-x',
        title: 'Twitter',
        value: '@bgremover',
        description: 'Follow us for updates and announcements.',
    },
];
</script>

<template>
    <AppLayout title="Contact Us — BGRemover">
        <PageHero
            title="Contact Us"
            subtitle="Have a question, suggestion, or issue? We'd love to hear from you."
        />

        <section class="section-padding bg-white">
            <div class="container-wide">
                <div class="grid gap-12 lg:grid-cols-5 lg:gap-16">

                    <div class="lg:col-span-2">
                        <h2 class="mb-2 text-2xl font-bold text-heading">Get in Touch</h2>
                        <p class="mb-8 text-muted">
                            Whether you found a bug, have a feature request, or just want to say hello — drop us a message.
                        </p>

                        <div class="space-y-5">
                            <div
                                v-for="info in contactInfo"
                                :key="info.title"
                                class="flex items-start gap-4 rounded-xl bg-surface-alt p-5"
                            >
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10">
                                    <i class="bi text-lg text-primary" :class="info.icon"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-heading">{{ info.title }}</p>
                                    <p class="text-sm text-primary">{{ info.value }}</p>
                                    <p class="mt-0.5 text-xs text-muted">{{ info.description }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 rounded-xl bg-surface-alt p-5">
                            <div class="flex items-start gap-3">
                                <i class="bi bi-info-circle mt-0.5 text-lg text-primary"></i>
                                <div>
                                    <p class="mb-1 font-semibold text-heading">Open Source</p>
                                    <p class="text-sm text-muted">
                                        BGRemover is built with open source technologies. Found an issue? Check our GitHub repository for known issues or to report bugs.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-3">
                        <div class="rounded-2xl bg-surface-alt p-8">
                            <h3 class="mb-6 text-xl font-bold text-heading">Send us a Message</h3>

                            <div v-if="$page.props.flash?.success" class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-600">
                                <i class="bi bi-check-circle mr-1.5"></i>
                                {{ $page.props.flash.success }}
                            </div>

                            <template v-if="!submitted">
                                <form @submit.prevent="submit" class="space-y-5">
                                    <div class="grid gap-5 sm:grid-cols-2">
                                        <div>
                                            <label for="name" class="mb-1.5 block text-sm font-medium text-heading">Name</label>
                                            <input
                                                id="name"
                                                v-model="form.name"
                                                type="text"
                                                required
                                                placeholder="Your name"
                                                class="w-full rounded-lg border border-border bg-white px-4 py-3 text-sm text-heading placeholder:text-muted/50 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                                            />
                                            <p v-if="form.errors.name" class="mt-1 text-xs text-red-500">{{ form.errors.name }}</p>
                                        </div>
                                        <div>
                                            <label for="email" class="mb-1.5 block text-sm font-medium text-heading">Email</label>
                                            <input
                                                id="email"
                                                v-model="form.email"
                                                type="email"
                                                required
                                                placeholder="you@example.com"
                                                class="w-full rounded-lg border border-border bg-white px-4 py-3 text-sm text-heading placeholder:text-muted/50 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                                            />
                                            <p v-if="form.errors.email" class="mt-1 text-xs text-red-500">{{ form.errors.email }}</p>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="subject" class="mb-1.5 block text-sm font-medium text-heading">Subject</label>
                                        <input
                                            id="subject"
                                            v-model="form.subject"
                                            type="text"
                                            required
                                            placeholder="How can we help?"
                                            class="w-full rounded-lg border border-border bg-white px-4 py-3 text-sm text-heading placeholder:text-muted/50 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                                        />
                                        <p v-if="form.errors.subject" class="mt-1 text-xs text-red-500">{{ form.errors.subject }}</p>
                                    </div>

                                    <div>
                                        <label for="message" class="mb-1.5 block text-sm font-medium text-heading">Message</label>
                                        <textarea
                                            id="message"
                                            v-model="form.message"
                                            rows="5"
                                            required
                                            placeholder="Tell us more..."
                                            class="w-full resize-none rounded-lg border border-border bg-white px-4 py-3 text-sm text-heading placeholder:text-muted/50 focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none"
                                        ></textarea>
                                        <p v-if="form.errors.message" class="mt-1 text-xs text-red-500">{{ form.errors.message }}</p>
                                    </div>

                                    <button
                                        type="submit"
                                        :disabled="form.processing"
                                        class="btn-primary w-full justify-center"
                                    >
                                        <i v-if="form.processing" class="bi bi-arrow-repeat animate-spin"></i>
                                        <i v-else class="bi bi-send"></i>
                                        {{ form.processing ? 'Sending...' : 'Send Message' }}
                                    </button>
                                </form>
                            </template>

                            <template v-else>
                                <div class="flex flex-col items-center py-12 text-center">
                                    <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                                        <i class="bi bi-check-lg text-3xl text-green-600"></i>
                                    </div>
                                    <h4 class="mb-2 text-xl font-bold text-heading">Message Sent!</h4>
                                    <p class="mb-6 text-muted">
                                        Thanks for reaching out. We'll get back to you within 24 hours.
                                    </p>
                                    <button
                                        class="btn-ghost"
                                        @click="submitted = false"
                                    >
                                        <i class="bi bi-arrow-left"></i>
                                        Send Another Message
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
