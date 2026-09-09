<script setup>
import { ref, computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ToolHero from '@/Components/tool/ToolHero.vue';
import UploadZone from '@/Components/tool/UploadZone.vue';
import BackgroundGallery from '@/Components/tool/BackgroundGallery.vue';
import ToolSeo from '@/Components/tool/ToolSeo.vue';
import { changeBackground as seoContent } from '@/lib/bgSeoContent.js';

const files = ref([]);
const selectedBg = ref(null);
const error = ref(null);

const hasImage = computed(() => files.value.length > 0);

function onFilesSelected(selectedFiles) {
    files.value = selectedFiles;
    error.value = null;
}

function onError(msg) {
    error.value = msg;
}

function onBgSelect(bg) {
    selectedBg.value = bg.id;
}
</script>

<template>
    <AppLayout :title="seoContent.title">
        <ToolHero
            eyebrow="Free Online Tool"
            title="Change Image"
            highlight="Background"
            description="Replace the background of any photo with a new one. Pick from our gallery or upload your own. Everything runs locally in your browser."
            cta-label="Choose a Background"
            cta-href="#upload"
            :benefits="['100% Private', 'Preset Gallery', 'Custom Upload']"
        >
            <!-- Change Background Mockup -->
            <div class="p-5">
                <div class="mb-4 flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-red-400"></div>
                    <div class="h-3 w-3 rounded-full bg-yellow-400"></div>
                    <div class="h-3 w-3 rounded-full bg-green-400"></div>
                    <span class="ml-2 text-[10px] font-medium text-muted">BGRemover</span>
                </div>
                <div class="flex gap-3">
                    <div class="flex-1">
                        <p class="mb-2 flex items-center gap-1.5 text-[11px] font-medium text-muted">
                            <i class="bi bi-image text-primary"></i> Original
                        </p>
                        <div class="relative overflow-hidden rounded-lg bg-gradient-to-br from-sky-100 via-blue-50 to-indigo-100 p-4">
                            <div class="flex flex-col items-center gap-1">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-200/60">
                                    <i class="bi bi-person-fill text-2xl text-blue-500/70"></i>
                                </div>
                                <div class="h-2 w-14 rounded-full bg-blue-200/50"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex h-7 w-7 items-center justify-center rounded-full bg-primary shadow-md shadow-primary/30">
                            <i class="bi bi-arrow-right text-[10px] text-white"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="mb-2 flex items-center gap-1.5 text-[11px] font-medium text-green-600">
                            <i class="bi bi-check-circle-fill"></i> New Background
                        </p>
                        <div class="overflow-hidden rounded-lg bg-gradient-to-br from-emerald-400 via-teal-500 to-cyan-500 p-4">
                            <div class="flex flex-col items-center gap-1">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white/90 shadow-sm">
                                    <i class="bi bi-person-fill text-2xl text-primary"></i>
                                </div>
                                <div class="h-2 w-14 rounded-full bg-white/40"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-center gap-1.5 rounded-lg bg-green-50 py-1.5 text-[11px] font-medium text-green-700">
                    <i class="bi bi-check-circle-fill text-xs"></i>
                    Background replaced — pick from gallery below
                </div>
            </div>
        </ToolHero>

        <section id="upload" class="section-padding !py-12 bg-surface-alt sm:!py-16">
            <div class="container-wide">
                <div class="mx-auto max-w-4xl space-y-8">
                    <UploadZone
                        :multiple="false"
                        :max-size="20"
                        label="Drag & drop your photo here"
                        sublabel="Upload the photo you want to change the background of"
                        @files-selected="onFilesSelected"
                        @error="onError"
                    />

                    <div v-if="error" class="rounded-xl bg-red-50 p-4 text-center text-sm text-red-700">
                        <i class="bi bi-exclamation-triangle mr-1"></i>
                        {{ error }}
                    </div>

                    <div v-if="hasImage" class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-border sm:p-8">
                        <BackgroundGallery :selected-bg="selectedBg" @select="onBgSelect" />

                        <div v-if="selectedBg" class="mt-6 text-center">
                            <button class="btn-primary !px-10" disabled>
                                <i class="bi bi-magic"></i>
                                Apply Background — Coming Soon
                            </button>
                            <p class="mt-3 text-xs text-muted">
                                <i class="bi bi-info-circle mr-1"></i>
                                Canvas compositing will be wired here in the next phase.
                            </p>
                        </div>
                    </div>

                    <div v-if="!hasImage" class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-border text-center">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/10">
                            <i class="bi bi-image text-3xl text-primary/40"></i>
                        </div>
                        <p class="text-sm text-muted">Upload a photo above to see background options</p>
                    </div>
                </div>
            </div>
        </section>

        <ToolSeo :sections="seoContent.sections" />
    </AppLayout>
</template>
