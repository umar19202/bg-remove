<script setup>
import { ref } from 'vue';

defineProps({
    selectedBg: { type: String, default: null },
});

const emit = defineEmits(['select']);

const categories = [
    { id: 'nature', label: 'Nature', icon: 'bi-tree' },
    { id: 'office', label: 'Office', icon: 'bi-building' },
    { id: 'abstract', label: 'Abstract', icon: 'bi-stars' },
    { id: 'solid', label: 'Solid Colors', icon: 'bi-palette' },
    { id: 'custom', label: 'Custom', icon: 'bi-upload' },
];

const activeCategory = ref('nature');

const backgrounds = {
    nature: [
        { id: 'beach', label: 'Beach', color: '#87CEEB', gradient: 'linear-gradient(135deg, #87CEEB 0%, #F4A460 100%)' },
        { id: 'mountain', label: 'Mountain', color: '#4A7C59', gradient: 'linear-gradient(135deg, #2E8B57 0%, #87CEEB 100%)' },
        { id: 'forest', label: 'Forest', color: '#228B22', gradient: 'linear-gradient(135deg, #006400 0%, #228B22 100%)' },
        { id: 'sunset', label: 'Sunset', color: '#FF6B35', gradient: 'linear-gradient(135deg, #FF4500 0%, #FFD700 100%)' },
        { id: 'lake', label: 'Lake', color: '#4682B4', gradient: 'linear-gradient(135deg, #1E90FF 0%, #87CEEB 100%)' },
        { id: 'desert', label: 'Desert', color: '#C2B280', gradient: 'linear-gradient(135deg, #DEB887 0%, #F4A460 100%)' },
    ],
    office: [
        { id: 'desk', label: 'Desk', color: '#8B7355', gradient: 'linear-gradient(135deg, #8B7355 0%, #D2B48C 100%)' },
        { id: 'meeting', label: 'Meeting Room', color: '#708090', gradient: 'linear-gradient(135deg, #2F4F4F 0%, #708090 100%)' },
        { id: 'modern', label: 'Modern Office', color: '#B0C4DE', gradient: 'linear-gradient(135deg, #4682B4 0%, #B0C4DE 100%)' },
        { id: 'studio', label: 'Studio', color: '#2F2F2F', gradient: 'linear-gradient(135deg, #1a1a2e 0%, #16213e 100%)' },
    ],
    abstract: [
        { id: 'gradient-blue', label: 'Blue Gradient', color: '#667eea', gradient: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' },
        { id: 'gradient-sunset', label: 'Sunset Gradient', color: '#f093fb', gradient: 'linear-gradient(135deg, #f5576c 0%, #f093fb 100%)' },
        { id: 'gradient-ocean', label: 'Ocean Gradient', color: '#4facfe', gradient: 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)' },
        { id: 'gradient-forest', label: 'Forest Gradient', color: '#43e97b', gradient: 'linear-gradient(135deg, #38f9d7 0%, #43e97b 100%)' },
        { id: 'bokeh', label: 'Bokeh', color: '#a18cd1', gradient: 'linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%)' },
        { id: 'geometric', label: 'Geometric', color: '#ffecd2', gradient: 'linear-gradient(135deg, #fcb69f 0%, #ffecd2 100%)' },
    ],
    solid: [
        { id: 'white', label: 'White', color: '#FFFFFF', gradient: '#FFFFFF' },
        { id: 'black', label: 'Black', color: '#000000', gradient: '#000000' },
        { id: 'light-gray', label: 'Light Gray', color: '#F3F4F6', gradient: '#F3F4F6' },
        { id: 'blue', label: 'Blue', color: '#3B82F6', gradient: '#3B82F6' },
        { id: 'green', label: 'Green', color: '#22C55E', gradient: '#22C55E' },
        { id: 'red', label: 'Red', color: '#EF4444', gradient: '#EF4444' },
    ],
    custom: [],
};

const customFile = ref(null);
const customPreview = ref(null);

function onCustomUpload(e) {
    const f = e.target.files[0];
    if (f) {
        customFile.value = f;
        customPreview.value = URL.createObjectURL(f);
        emit('select', { id: 'custom', gradient: customPreview.value, type: 'image' });
    }
}
</script>

<template>
    <div class="space-y-5">
        <h3 class="text-lg font-bold text-heading">Choose a Background</h3>

        <div class="flex flex-wrap gap-2">
            <button
                v-for="cat in categories"
                :key="cat.id"
                class="flex items-center gap-1.5 rounded-full px-4 py-2 text-xs font-medium transition-all duration-200"
                :class="activeCategory === cat.id
                    ? 'bg-primary text-white shadow-md shadow-primary/25'
                    : 'bg-surface-alt text-muted hover:bg-primary/10 hover:text-primary'"
                @click="activeCategory = cat.id"
            >
                <i class="bi" :class="cat.icon"></i>
                {{ cat.label }}
            </button>
        </div>

        <div v-if="activeCategory === 'custom'" class="space-y-3">
            <label class="flex cursor-pointer flex-col items-center gap-3 rounded-xl border-2 border-dashed border-border p-8 transition-colors hover:border-primary/50 hover:bg-primary/[0.02]">
                <input type="file" accept="image/*" class="hidden" @change="onCustomUpload" />
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                    <i class="bi bi-plus-lg text-xl text-primary"></i>
                </div>
                <span class="text-sm font-medium text-muted">Upload your own background</span>
            </label>
            <div v-if="customPreview" class="relative">
                <img :src="customPreview" alt="Custom background" class="h-24 w-full rounded-xl object-cover shadow-sm" />
                <button
                    class="absolute top-2 right-2 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-white shadow"
                    @click="customPreview = null; customFile = null"
                >
                    <i class="bi bi-x text-xs"></i>
                </button>
            </div>
        </div>

        <div v-else class="grid grid-cols-3 gap-3 sm:grid-cols-4 lg:grid-cols-6">
            <button
                v-for="bg in backgrounds[activeCategory]"
                :key="bg.id"
                class="group relative aspect-square overflow-hidden rounded-xl shadow-sm transition-all duration-200 hover:ring-2 hover:ring-primary hover:ring-offset-2"
                :class="selectedBg === bg.id ? 'ring-2 ring-primary ring-offset-2' : ''"
                @click="emit('select', bg)"
            >
                <div
                    class="absolute inset-0"
                    :style="{ background: bg.gradient }"
                ></div>
                <div class="absolute inset-0 flex items-end bg-gradient-to-t from-black/50 to-transparent p-2 opacity-0 transition-opacity group-hover:opacity-100">
                    <span class="text-[10px] font-medium text-white">{{ bg.label }}</span>
                </div>
                <div v-if="selectedBg === bg.id" class="absolute top-1.5 right-1.5 flex h-5 w-5 items-center justify-center rounded-full bg-primary shadow">
                    <i class="bi bi-check-lg text-[10px] text-white"></i>
                </div>
            </button>
        </div>
    </div>
</template>
