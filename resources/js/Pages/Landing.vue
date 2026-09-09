<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Hero from '@/Components/landing/Hero.vue';
import HowItWorks from '@/Components/landing/HowItWorks.vue';
import ToolCards from '@/Components/landing/ToolCards.vue';
import Features from '@/Components/landing/Features.vue';
import CTA from '@/Components/landing/CTA.vue';
</script>

<template>
    <AppLayout title="Home">
        <Hero />
        <ToolCards />
        <HowItWorks />
        <Features />
        <CTA />
    </AppLayout>
</template>
