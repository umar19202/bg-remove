<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ToolHero from '@/Components/tool/ToolHero.vue';
import UploadZone from '@/Components/tool/UploadZone.vue';
import ToolSeo from '@/Components/tool/ToolSeo.vue';
import { removeBackground as seoContent } from '@/lib/bgSeoContent.js';

const files = ref([]);
const processing = ref(false);
const result = ref(null);
const error = ref(null);

function onFilesSelected(selectedFiles) {
    files.value = selectedFiles;
    result.value = null;
    error.value = null;
}

function onError(msg) {
    error.value = msg;
}

function reset() {
    files.value = [];
    result.value = null;
    error.value = null;
    processing.value = false;
}
</script>

<template>
    <AppLayout :title="seoContent.title">
        <ToolHero
            eyebrow="Free Online Tool"
            title="Remove Background from"
            highlight="Any Image"
            description="Upload any image and get a clean, professional cutout in seconds. Everything runs locally in your browser — nothing leaves your device."
            cta-label="Start Removing — It's Free"
            cta-href="#upload"
            :benefits="['100% Private', 'No Upload', 'Instant Results']"
        >
            <!-- Remove Background Mockup -->
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
                                <div class="h-2 w-10 rounded-full bg-blue-200/30"></div>
                            </div>
                            <div class="absolute bottom-1.5 right-1.5 rounded bg-white/80 px-1.5 py-0.5 text-[9px] font-medium text-muted backdrop-blur-sm">
                                1024×768
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
                            <i class="bi bi-check-circle-fill"></i> Result
                        </p>
                        <div class="flex overflow-hidden rounded-lg bg-[repeating-conic-gradient(#e5e7eb_0%_25%,transparent_0%_50%)] bg-[length:10px_10px] p-4">
                            <div class="flex flex-col items-center gap-1">
                                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-white shadow-sm">
                                    <i class="bi bi-person-fill text-2xl text-primary"></i>
                                </div>
                                <div class="h-2 w-14 rounded-full bg-primary/20"></div>
                                <div class="h-2 w-10 rounded-full bg-primary/10"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-center gap-1.5 rounded-lg bg-green-50 py-1.5 text-[11px] font-medium text-green-700">
                    <i class="bi bi-check-circle-fill text-xs"></i>
                    Background removed — downloaded as PNG
                </div>
            </div>
        </ToolHero>

        <section id="upload" class="section-padding !py-12 bg-surface-alt sm:!py-16">
            <div class="container-wide">
                <div class="mx-auto max-w-2xl">
                    <UploadZone
                        :multiple="false"
                        :max-size="20"
                        label="Drag & drop your image here"
                        sublabel="or click to browse — JPG, PNG, WebP up to 20MB"
                        @files-selected="onFilesSelected"
                        @error="onError"
                    />

                    <div v-if="error" class="mt-4 rounded-xl bg-red-50 p-4 text-center text-sm text-red-700">
                        <i class="bi bi-exclamation-triangle mr-1"></i>
                        {{ error }}
                    </div>

                    <div v-if="files.length > 0 && !result" class="mt-8 text-center">
                        <button class="btn-primary !px-10" disabled>
                            <i class="bi bi-magic"></i>
                            Processing Coming Soon
                        </button>
                        <p class="mt-3 text-xs text-muted">
                            <i class="bi bi-info-circle mr-1"></i>
                            BiRefNet AI inference will be wired here in the next phase.
                        </p>
                    </div>

                    <div v-if="result" class="mt-8 space-y-6">
                        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-border">
                            <div class="flex items-center justify-center gap-4">
                                <div class="text-center">
                                    <p class="mb-2 text-xs font-medium text-muted">Original</p>
                                    <div class="h-40 w-40 overflow-hidden rounded-xl bg-surface-alt">
                                        <img :src="result.original" alt="Original" class="h-full w-full object-contain" />
                                    </div>
                                </div>
                                <i class="bi bi-arrow-right text-2xl text-primary"></i>
                                <div class="text-center">
                                    <p class="mb-2 text-xs font-medium text-muted">Result</p>
                                    <div class="h-40 w-40 overflow-hidden rounded-xl bg-[repeating-conic-gradient(#e5e7eb_0%_25%,transparent_0%_50%)] bg-[length:12px_12px]">
                                        <img :src="result.output" alt="Result" class="h-full w-full object-contain" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-center gap-4">
                            <a :href="result.output" download class="btn-primary">
                                <i class="bi bi-download"></i>
                                Download PNG
                            </a>
                            <button class="btn-outline" @click="reset">
                                <i class="bi bi-arrow-repeat"></i>
                                Upload Another
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <ToolSeo :sections="seoContent.sections" />
    </AppLayout>
</template>
