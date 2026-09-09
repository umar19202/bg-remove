<script setup>
import { ref, computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ToolHero from '@/Components/tool/ToolHero.vue';
import UploadZone from '@/Components/tool/UploadZone.vue';
import ToolSeo from '@/Components/tool/ToolSeo.vue';
import { bulkRemove as seoContent } from '@/lib/bgSeoContent.js';

const files = ref([]);
const error = ref(null);
const processing = ref(false);
const paused = ref(false);
const processedCount = ref(0);

const fileList = computed(() =>
    files.value.map((f, i) => ({
        name: f.name,
        size: (f.size / 1024 / 1024).toFixed(2),
        status: i < processedCount.value ? 'done' : i === processedCount.value && processing.value ? 'processing' : 'pending',
    }))
);

const progress = computed(() =>
    files.value.length > 0 ? Math.round((processedCount.value / files.value.length) * 100) : 0
);

const totalSize = computed(() =>
    (files.value.reduce((sum, f) => sum + f.size, 0) / 1024 / 1024).toFixed(0)
);

function onFilesSelected(selectedFiles) {
    files.value = selectedFiles;
    processedCount.value = 0;
    processing.value = false;
    paused.value = false;
    error.value = null;
}

function onError(msg) {
    error.value = msg;
}
</script>

<template>
    <AppLayout :title="seoContent.title">
        <ToolHero
            eyebrow="Free Online Tool"
            title="Bulk Background"
            highlight="Remover"
            description="Remove backgrounds from up to 50 images at once. Process them all in your browser with real-time progress tracking."
            cta-label="Start Bulk Processing"
            cta-href="#upload"
            :benefits="['50 Images at Once', 'Progress Tracking', 'ZIP Download']"
        >
            <!-- Bulk Remove Mockup -->
            <div class="p-5">
                <div class="mb-4 flex items-center gap-2">
                    <div class="h-3 w-3 rounded-full bg-red-400"></div>
                    <div class="h-3 w-3 rounded-full bg-yellow-400"></div>
                    <div class="h-3 w-3 rounded-full bg-green-400"></div>
                    <span class="ml-2 text-[10px] font-medium text-muted">BGRemover — Bulk</span>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 rounded-lg bg-surface-alt p-2.5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-green-100">
                            <i class="bi bi-check-lg text-sm text-green-600"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-[11px] font-medium text-heading">product-photo-1.jpg</p>
                            <p class="text-[9px] text-muted">2.4 MB</p>
                        </div>
                        <span class="shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-[9px] font-medium text-green-700">Done</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-lg bg-primary/5 p-2.5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-primary/10">
                            <i class="bi bi-hourglass-split text-sm text-primary"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-[11px] font-medium text-heading">team-headshot-3.png</p>
                            <p class="text-[9px] text-muted">1.8 MB</p>
                        </div>
                        <span class="shrink-0 rounded-full bg-primary/10 px-2 py-0.5 text-[9px] font-medium text-primary">Processing</span>
                    </div>
                    <div class="flex items-center gap-3 rounded-lg bg-surface-alt p-2.5">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-gray-100">
                            <i class="bi bi-clock text-sm text-gray-400"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-[11px] font-medium text-heading">catalog-item-7.webp</p>
                            <p class="text-[9px] text-muted">3.1 MB</p>
                        </div>
                        <span class="shrink-0 rounded-full bg-gray-100 px-2 py-0.5 text-[9px] font-medium text-gray-500">Pending</span>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="mb-1 flex items-center justify-between text-[9px] text-muted">
                        <span>Progress</span>
                        <span>12 / 50 (24%)</span>
                    </div>
                    <div class="h-1.5 overflow-hidden rounded-full bg-surface-alt">
                        <div class="h-full w-[24%] rounded-full bg-primary"></div>
                    </div>
                </div>
            </div>
        </ToolHero>

        <section id="upload" class="section-padding !py-12 bg-surface-alt sm:!py-16">
            <div class="container-wide">
                <div class="mx-auto max-w-3xl space-y-8">
                    <UploadZone
                        :multiple="true"
                        :max-size="20"
                        label="Drag & drop your images here"
                        sublabel="Upload up to 50 images — JPG, PNG, WebP, max 20MB each"
                        @files-selected="onFilesSelected"
                        @error="onError"
                    />

                    <div v-if="error" class="rounded-xl bg-red-50 p-4 text-center text-sm text-red-700">
                        <i class="bi bi-exclamation-triangle mr-1"></i>
                        {{ error }}
                    </div>

                    <div v-if="files.length > 0" class="space-y-6">
                        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-border">
                            <div class="mb-4 flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-heading">{{ files.length }} images selected</p>
                                    <p class="text-xs text-muted">Total size: {{ totalSize }} MB</p>
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        v-if="!processing"
                                        class="btn-primary !px-5 !py-2 !text-xs"
                                        disabled
                                    >
                                        <i class="bi bi-play-fill"></i>
                                        Start Processing
                                    </button>
                                    <template v-else>
                                        <button class="btn-outline !px-4 !py-2 !text-xs" disabled>
                                            <i class="bi" :class="paused ? 'bi-play-fill' : 'bi-pause-fill'"></i>
                                            {{ paused ? 'Resume' : 'Pause' }}
                                        </button>
                                        <button class="cursor-pointer text-xs text-red-500 hover:text-red-700" disabled>
                                            Cancel
                                        </button>
                                    </template>
                                </div>
                            </div>

                            <div class="mb-2 flex items-center justify-between text-xs text-muted">
                                <span>Progress</span>
                                <span>{{ processedCount }} / {{ files.length }} ({{ progress }}%)</span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-surface-alt">
                                <div
                                    class="h-full rounded-full bg-primary transition-all duration-500"
                                    :style="{ width: `${progress}%` }"
                                ></div>
                            </div>
                        </div>

                        <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-border">
                            <h3 class="mb-4 text-sm font-semibold text-heading">File Status</h3>
                            <div class="max-h-64 space-y-2 overflow-y-auto">
                                <div
                                    v-for="(item, i) in fileList"
                                    :key="i"
                                    class="flex items-center gap-3 rounded-lg p-3 transition-colors"
                                    :class="item.status === 'processing' ? 'bg-primary/5' : 'bg-surface-alt'"
                                >
                                    <div
                                        class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full text-xs"
                                        :class="{
                                            'bg-green-100 text-green-600': item.status === 'done',
                                            'bg-primary/10 text-primary': item.status === 'processing',
                                            'bg-gray-100 text-gray-400': item.status === 'pending',
                                        }"
                                    >
                                        <i v-if="item.status === 'done'" class="bi bi-check-lg"></i>
                                        <i v-else-if="item.status === 'processing'" class="bi bi-hourglass-split"></i>
                                        <i v-else class="bi bi-clock"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="truncate text-xs font-medium text-heading">{{ item.name }}</p>
                                        <p class="text-[10px] text-muted">{{ item.size }} MB</p>
                                    </div>
                                    <span
                                        class="shrink-0 rounded-full px-2 py-0.5 text-[10px] font-medium"
                                        :class="{
                                            'bg-green-100 text-green-700': item.status === 'done',
                                            'bg-primary/10 text-primary': item.status === 'processing',
                                            'bg-gray-100 text-gray-500': item.status === 'pending',
                                        }"
                                    >
                                        {{ item.status === 'done' ? 'Complete' : item.status === 'processing' ? 'Processing...' : 'Pending' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <p class="text-center text-xs text-muted">
                            <i class="bi bi-laptop mr-1"></i>
                            All processing runs in your browser — nothing is uploaded.
                        </p>
                    </div>

                    <div v-else class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-border text-center">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/10">
                            <i class="bi bi-layers text-3xl text-primary/40"></i>
                        </div>
                        <p class="text-sm text-muted">Upload images above to start bulk processing</p>
                    </div>
                </div>
            </div>
        </section>

        <ToolSeo :sections="seoContent.sections" />
    </AppLayout>
</template>
