<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PageHero from '@/Components/landing/PageHero.vue';

const lastUpdated = 'September 9, 2026';

const sections = [
    {
        id: 'agreement',
        title: '1. Agreement to Terms',
        content: [
            'By accessing or using BGRemover ("the Service"), you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use the Service.',
        ],
    },
    {
        id: 'description',
        title: '2. Description of Service',
        content: [
            'BGRemover provides a free, browser-based image background removal tool. All image processing is performed locally on your device using client-side JavaScript and WebAssembly — no images are uploaded to any server.',
            'The Service is provided "as is" and is available for free use without registration or account creation.',
        ],
    },
    {
        id: 'usage',
        title: '3. Acceptable Use',
        content: [
            'You agree to use the Service only for lawful purposes. You are solely responsible for the images you process and any content you create using the Service.',
            'You may not use the Service to:',
        ],
        list: [
            'Process images that violate copyright or intellectual property rights',
            'Create content that is illegal, harmful, or violates the rights of others',
            'Attempt to reverse-engineer, decompile, or extract the AI model or source code',
            'Use automated tools to access or interact with the Service in unintended ways',
        ],
    },
    {
        id: 'ip',
        title: '4. Intellectual Property',
        content: [
            'The Service, including its design, code, and branding, is owned by BGRemover and protected by applicable intellectual property laws.',
            'The BiRefNet AI model used by the Service is developed by third parties and is subject to its own license terms.',
            'You retain full ownership of any images you process through the Service. We claim no rights over your content.',
        ],
    },
    {
        id: 'disclaimer',
        title: '5. Disclaimer of Warranties',
        content: [
            'The Service is provided on an "as is" and "as available" basis without warranties of any kind, either express or implied.',
            'We do not guarantee that the Service will be uninterrupted, error-free, or that the AI output will be accurate or suitable for any particular purpose.',
            'Results may vary depending on image quality, complexity, and the capabilities of your device and browser.',
        ],
    },
    {
        id: 'liability',
        title: '6. Limitation of Liability',
        content: [
            'To the maximum extent permitted by law, BGRemover shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of the Service.',
            'We are not responsible for any loss of data, business interruption, or damages resulting from reliance on the Service or its output.',
        ],
    },
    {
        id: 'third-party',
        title: '7. Third-Party Services',
        content: [
            'The Service may contain links to third-party websites or services. We are not responsible for the content, privacy practices, or availability of these third-party services.',
        ],
    },
    {
        id: 'termination',
        title: '8. Termination',
        content: [
            'We reserve the right to suspend or discontinue the Service at any time without notice. Since no account is required, there is no termination process for users.',
        ],
    },
    {
        id: 'changes',
        title: '9. Changes to These Terms',
        content: [
            'We may update these Terms of Service from time to time. Changes will be posted on this page with an updated effective date. Your continued use of the Service after changes are posted constitutes acceptance of the revised terms.',
        ],
    },
    {
        id: 'contact',
        title: '10. Contact Us',
        content: [
            'If you have questions about these Terms, please contact us at legal@bgremover.com.',
        ],
    },
];
</script>

<template>
    <AppLayout title="Terms of Service — BGRemover">
        <PageHero
            title="Terms of Service"
            subtitle="Please read these terms carefully before using BGRemover."
        />

        <section class="section-padding bg-white">
            <div class="container-wide">
                <div class="mx-auto max-w-3xl">
                    <div class="mb-8 rounded-xl bg-surface-alt px-6 py-4">
                        <p class="text-sm text-muted">
                            <i class="bi bi-calendar3 mr-1.5"></i>
                            Last Updated: {{ lastUpdated }}
                        </p>
                    </div>

                    <div class="space-y-10">
                        <div v-for="section in sections" :key="section.id">
                            <h2 class="mb-4 text-xl font-bold text-heading">{{ section.title }}</h2>

                            <template v-if="section.content">
                                <p
                                    v-for="(para, i) in section.content"
                                    :key="i"
                                    class="mb-3 leading-relaxed text-muted"
                                >
                                    {{ para }}
                                </p>
                            </template>

                            <ul v-if="section.list" class="mt-3 space-y-2 pl-5">
                                <li
                                    v-for="(item, i) in section.list"
                                    :key="i"
                                    class="relative pl-4 text-muted before:absolute before:left-0 before:top-2.5 before:h-1.5 before:w-1.5 before:rounded-full before:bg-primary/40"
                                >
                                    {{ item }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-12 rounded-xl bg-primary/5 p-6 ring-1 ring-primary/10">
                        <div class="flex items-start gap-3">
                            <i class="bi bi-question-circle mt-0.5 text-xl text-primary"></i>
                            <div>
                                <p class="mb-1 font-semibold text-heading">Questions About These Terms?</p>
                                <p class="text-sm leading-relaxed text-muted">
                                    Contact us at <span class="font-medium text-primary">legal@bgremover.com</span> and we'll be happy to help.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
