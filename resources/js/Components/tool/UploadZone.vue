<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
    multiple: { type: Boolean, default: false },
    maxSize: { type: Number, default: 20 },
    accept: { type: String, default: '.jpg,.jpeg,.png,.webp' },
    label: { type: String, default: 'Drag & drop your image here' },
    sublabel: { type: String, default: '' },
});

const emit = defineEmits(['files-selected', 'error']);

const dragOver = ref(false);
const files = ref([]);

const acceptTypes = computed(() => props.accept);
const maxSizeBytes = computed(() => props.maxSize * 1024 * 1024);

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
    handleFiles(e.dataTransfer.files);
}

function onFileChange(e) {
    handleFiles(e.target.files);
    e.target.value = '';
}

function handleFiles(fileList) {
    const validFiles = [];
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

    for (const f of fileList) {
        if (!allowedTypes.includes(f.type)) {
            emit('error', `"${f.name}" is not a supported format. Use JPG, PNG, or WebP.`);
            continue;
        }
        if (f.size > maxSizeBytes.value) {
            emit('error', `"${f.name}" exceeds ${props.maxSize}MB limit.`);
            continue;
        }
        validFiles.push({
            file: f,
            preview: URL.createObjectURL(f),
            id: Math.random().toString(36).slice(2),
        });
    }

    if (validFiles.length === 0) return;

    if (props.multiple) {
        files.value = [...files.value, ...validFiles];
    } else {
        files.value.forEach(f => URL.revokeObjectURL(f.preview));
        files.value = validFiles.slice(0, 1);
    }

    emit('files-selected', files.value.map(f => f.file));
}

function removeFile(id) {
    const idx = files.value.findIndex(f => f.id === id);
    if (idx !== -1) {
        URL.revokeObjectURL(files.value[idx].preview);
        files.value.splice(idx, 1);
        emit('files-selected', files.value.map(f => f.file));
    }
}

function clearAll() {
    files.value.forEach(f => URL.revokeObjectURL(f.preview));
    files.value = [];
    emit('files-selected', []);
}
</script>

<template>
    <div class="space-y-4">
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
                :accept="acceptTypes"
                :multiple="multiple"
                class="absolute inset-0 cursor-pointer opacity-0"
                @change="onFileChange"
            />

            <div v-if="files.length === 0" class="space-y-4">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/10">
                    <i class="bi bi-cloud-arrow-up text-3xl text-primary"></i>
                </div>
                <div>
                    <p class="text-lg font-semibold text-heading">{{ label }}</p>
                    <p v-if="sublabel" class="mt-1 text-sm text-muted">{{ sublabel }}</p>
                    <p v-else class="mt-1 text-sm text-muted">
                        or <span class="font-medium text-primary">click to browse</span>
                    </p>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-2 text-xs text-muted">
                    <span class="inline-flex items-center gap-1 rounded-full bg-surface-alt px-3 py-1">
                        <i class="bi bi-file-image"></i> JPG, PNG, WebP
                    </span>
                    <span class="inline-flex items-center gap-1 rounded-full bg-surface-alt px-3 py-1">
                        <i class="bi bi-hdd"></i> Max {{ maxSize }}MB
                    </span>
                    <span v-if="multiple" class="inline-flex items-center gap-1 rounded-full bg-surface-alt px-3 py-1">
                        <i class="bi bi-collection"></i> Up to 50 files
                    </span>
                </div>
            </div>

            <div v-else-if="!multiple" class="space-y-4">
                <div class="relative mx-auto w-full max-w-sm">
                    <img :src="files[0].preview" alt="Preview" class="mx-auto max-h-64 rounded-xl object-contain shadow-md" />
                    <button
                        class="absolute -top-2 -right-2 flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-red-500 text-white shadow-lg transition-transform hover:scale-110"
                        @click.stop="removeFile(files[0].id)"
                    >
                        <i class="bi bi-x-lg text-sm"></i>
                    </button>
                </div>
                <div>
                    <p class="font-medium text-heading">{{ files[0].file.name }}</p>
                    <p class="text-sm text-muted">{{ (files[0].file.size / 1024 / 1024).toFixed(2) }} MB</p>
                </div>
                <slot name="action" />
            </div>

            <div v-else class="space-y-4">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-heading">{{ files.length }} file{{ files.length > 1 ? 's' : '' }} selected</p>
                    <button class="cursor-pointer text-xs text-red-500 hover:text-red-700" @click.stop="clearAll">Clear all</button>
                </div>
                <div class="mx-auto grid max-h-48 grid-cols-3 gap-2 overflow-y-auto sm:grid-cols-4">
                    <div v-for="f in files" :key="f.id" class="group relative">
                        <img :src="f.preview" :alt="f.file.name" class="aspect-square rounded-lg object-cover shadow-sm" />
                        <button
                            class="absolute -top-1 -right-1 flex h-5 w-5 cursor-pointer items-center justify-center rounded-full bg-red-500 text-white opacity-0 transition-opacity group-hover:opacity-100"
                            @click.stop="removeFile(f.id)"
                        >
                            <i class="bi bi-x text-[10px]"></i>
                        </button>
                    </div>
                </div>
                <slot name="action" />
            </div>
        </div>

        <p class="text-center text-xs text-muted">
            <i class="bi bi-laptop mr-1"></i>
            Runs entirely in your browser — nothing is uploaded, nothing is stored.
        </p>
    </div>
</template>
