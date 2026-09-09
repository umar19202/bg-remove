<script setup>
import { ref } from 'vue';

const dragOver = ref(false);
const file = ref(null);
const preview = ref(null);

function onDragOver(e) {
    e.preventDefault();
    dragOver.value = true;
}

function onDragLeave() {
    dragOver.value = false;
}

function onDrop(e) {
    e.preventDefault();
    dragOver.value = false;
    const f = e.dataTransfer.files[0];
    if (f) selectFile(f);
}

function onFileChange(e) {
    const f = e.target.files[0];
    if (f) selectFile(f);
}

function selectFile(f) {
    const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!validTypes.includes(f.type)) {
        alert('Please select a JPG, PNG, or WebP image.');
        return;
    }
    if (f.size > 15 * 1024 * 1024) {
        alert('File must be under 15MB.');
        return;
    }
    file.value = f;
    preview.value = URL.createObjectURL(f);
}

function removeFile() {
    file.value = null;
    preview.value = null;
}
</script>

<template>
    <section id="upload" class="section-padding !py-16 sm:!py-20 bg-surface-alt">
        <div class="container-wide">
            <div class="section-title">
                <span class="mb-3 inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
                    Try It Now
                </span>
                <h2>Remove Background</h2>
                <p>Upload an image and watch the AI do its magic</p>
            </div>

            <div class="mx-auto max-w-2xl">
                <div
                    class="relative overflow-hidden rounded-2xl border-2 border-dashed bg-white p-8 text-center transition-all duration-300 sm:p-12"
                    :class="dragOver
                        ? 'border-primary bg-primary/5 shadow-lg shadow-primary/10 scale-[1.01]'
                        : 'border-border hover:border-primary/50 hover:bg-primary/[0.02] hover:shadow-md'"
                    @dragover="onDragOver"
                    @dragleave="onDragLeave"
                    @drop="onDrop"
                >
                    <input
                        type="file"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="absolute inset-0 cursor-pointer opacity-0"
                        @change="onFileChange"
                    />

                    <div v-if="!preview" class="space-y-5">
                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-primary/10">
                            <i class="bi bi-cloud-arrow-up text-4xl text-primary"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-heading">
                                Drag & drop your image here
                            </p>
                            <p class="mt-1 text-sm text-muted">
                                or <span class="font-medium text-primary">click to browse</span>
                            </p>
                        </div>
                        <div class="flex flex-wrap items-center justify-center gap-3 text-xs text-muted">
                            <span class="inline-flex items-center gap-1 rounded-full bg-surface-alt px-3 py-1">
                                <i class="bi bi-file-image"></i> JPG, PNG, WebP
                            </span>
                            <span class="inline-flex items-center gap-1 rounded-full bg-surface-alt px-3 py-1">
                                <i class="bi bi-hdd"></i> Max 15MB
                            </span>
                        </div>
                    </div>

                    <div v-else class="space-y-5">
                        <div class="relative mx-auto w-full max-w-sm">
                            <img :src="preview" alt="Preview" class="mx-auto max-h-64 rounded-xl object-contain shadow-md" />
                            <button
                                class="absolute -top-2 -right-2 flex h-8 w-8 items-center justify-center rounded-full bg-red-500 text-white shadow-lg transition-transform hover:scale-110"
                                @click.stop="removeFile"
                            >
                                <i class="bi bi-x-lg text-sm"></i>
                            </button>
                        </div>
                        <div>
                            <p class="font-medium text-heading">{{ file?.name }}</p>
                            <p class="text-sm text-muted">{{ (file?.size / 1024 / 1024).toFixed(2) }} MB</p>
                        </div>
                        <button class="btn-primary !px-10" @click.stop>
                            <i class="bi bi-magic"></i>
                            Remove Background
                        </button>
                    </div>
                </div>

                <p class="mt-5 text-center text-xs text-muted">
                    <i class="bi bi-laptop mr-1"></i>
                    Runs entirely in your browser — nothing is uploaded, nothing is stored.
                </p>
            </div>
        </div>
    </section>
</template>
