<script setup>
import Navbar from '@/Components/landing/Navbar.vue';
import Footer from '@/Components/landing/Footer.vue';

defineProps({
    title: { type: String, default: '' },
});
</script>

<template>
    <div class="flex min-h-screen flex-col">
        <Navbar :auth="$page.props.auth" />
        <main class="flex-1">
            <slot />
        </main>
        <Footer />
    </div>
</template>
