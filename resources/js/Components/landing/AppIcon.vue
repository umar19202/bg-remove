<script setup>
defineProps({
    size: { type: Number, default: 36 },
    light: { type: Boolean, default: false },
});
</script>

<template>
    <svg
        :width="size"
        :height="size"
        viewBox="0 0 40 40"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <rect width="40" height="40" rx="10" :fill="light ? 'rgba(255,255,255,0.15)' : '#175cdd'" />

        <!-- Image frame -->
        <rect x="9" y="11" width="22" height="18" rx="2.5" stroke="white" stroke-width="1.8" fill="none" />

        <!-- Mountain -->
        <path d="M9 25L15 18L19 22L25 15L31 25" stroke="white" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" fill="none" />

        <!-- Sun -->
        <circle cx="25" cy="16" r="2.5" fill="white" opacity="0.8" />

        <!-- Removal slash -->
        <line x1="29" y1="9" x2="11" y2="31" stroke="white" stroke-width="2" stroke-linecap="round" opacity="0.9" />
    </svg>
</template>
