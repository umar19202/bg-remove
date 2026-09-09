<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import PageHero from '@/Components/landing/PageHero.vue';

const lastUpdated = 'September 9, 2026';

const sections = [
    {
        id: 'introduction',
        title: '1. Introduction',
        content: [
            'BGRemover ("we", "our", or "us") operates the bgremover.com website and associated tools. This Privacy Policy explains how we handle information when you use our background removal tools.',
            'Because BGRemover processes images entirely in your browser, the way we handle privacy is fundamentally different from most online tools. We do not collect, store, or transmit your images to any server.',
        ],
    },
    {
        id: 'information-collected',
        title: '2. Information We Collect',
        subsections: [
            {
                heading: '2.1 Image Data',
                content: ['All image processing happens locally in your web browser using WebAssembly and ONNX Runtime Web. Your images are never uploaded to or stored on any server. Once you close the browser tab, all processed data is gone.'],
            },
            {
                heading: '2.2 Usage Analytics',
                content: ['We may collect anonymous, aggregated usage data such as page views, referral sources, and general device information (browser type, screen resolution). This data cannot be used to identify you personally.'],
            },
            {
                heading: '2.3 Cookies',
                content: ['BGRemover uses only essential cookies required for the website to function. We do not use tracking cookies, advertising cookies, or third-party analytics cookies that build user profiles.'],
            },
        ],
    },
    {
        id: 'how-we-use',
        title: '3. How We Use Information',
        content: ['We do not use your images for any purpose — they never leave your device. Anonymous analytics data is used solely to improve our website performance and user experience.'],
    },
    {
        id: 'information-sharing',
        title: '4. Information Sharing and Disclosure',
        content: [
            'We do not sell, trade, or share your information with third parties. Your image data is never transmitted to any server, so there is nothing to share.',
            'Anonymous, aggregated analytics data may be processed by privacy-respecting analytics providers to help us understand site usage patterns.',
        ],
    },
    {
        id: 'data-security',
        title: '5. Data Security',
        content: [
            'Since all image processing happens locally in your browser, there is no server-side data to secure. Your images remain on your device at all times.',
            'We implement standard web security practices including HTTPS encryption for all page loads and regular security reviews of our codebase.',
        ],
    },
    {
        id: 'your-rights',
        title: '6. Your Rights',
        content: [
            'You have full control over your data. Since we do not collect or store any personal information or images, there is nothing to access, modify, or delete.',
            'You can clear any processed data at any time by closing the browser tab or clearing your browser storage.',
        ],
    },
    {
        id: 'children',
        title: '7. Children\'s Privacy',
        content: ['BGRemover does not knowingly collect any personal information from children under 13. Our tool processes images locally and does not require account creation or personal data entry.'],
    },
    {
        id: 'changes',
        title: '8. Changes to This Policy',
        content: ['We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated effective date. Continued use of BGRemover after changes constitutes acceptance of the updated policy.'],
    },
    {
        id: 'contact',
        title: '9. Contact Us',
        content: ['If you have questions about this Privacy Policy, please contact us at privacy@bgremover.com.'],
    },
];
</script>

<template>
    <AppLayout title="Privacy Policy — BGRemover">
        <PageHero
            title="Privacy Policy"
            subtitle="Your privacy is our priority. Here's how we protect it."
        />

        <section class="section-padding bg-white">
            <div class="container-wide">
                <div class="mx-auto max-w-3xl">
                    <div class="mb-8 rounded-xl bg-surface-alt px-6 py-4">
                        <p class="text-sm text-muted">
                            <i class="bi bi-calendar3 mr-1.5"></i>
                            Effective Date: {{ lastUpdated }}
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

                            <template v-if="section.subsections">
                                <div v-for="sub in section.subsections" :key="sub.heading" class="mb-6">
                                    <h3 class="mb-2 text-base font-semibold text-heading">{{ sub.heading }}</h3>
                                    <p
                                        v-for="(para, i) in sub.content"
                                        :key="i"
                                        class="leading-relaxed text-muted"
                                    >
                                        {{ para }}
                                    </p>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="mt-12 rounded-xl bg-primary/5 p-6 ring-1 ring-primary/10">
                        <div class="flex items-start gap-3">
                            <i class="bi bi-shield-check mt-0.5 text-xl text-primary"></i>
                            <div>
                                <p class="mb-1 font-semibold text-heading">Our Promise</p>
                                <p class="text-sm leading-relaxed text-muted">
                                    Your images are processed entirely in your browser. Nothing is uploaded to any server. This is not just a policy — it's how the technology is built.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
