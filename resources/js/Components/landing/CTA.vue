<script setup>
</script>

<template>
    <section class="section-padding bg-surface">
        <div class="container-wide">
            <div class="mx-auto max-w-3xl text-center">
                <span class="mb-4 inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
                    Open Source
                </span>
                <h2 class="mb-6 text-3xl font-extrabold tracking-tight text-heading sm:text-4xl">
                    Built with
                    <span class="bg-gradient-to-r from-primary to-blue-600 bg-clip-text text-transparent">BiRefNet AI</span>
                </h2>
                <p class="mb-10 text-lg leading-relaxed text-muted">
                    Powered by the BiRefNet Lite model — a state-of-the-art salient object segmentation
                    network. MIT licensed, runs entirely in your browser via WebAssembly.
                </p>

                <div class="grid gap-6 sm:grid-cols-3">
                    <div class="rounded-xl bg-surface-alt p-6">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                            <i class="bi bi-laptop text-xl text-primary"></i>
                        </div>
                        <h3 class="mb-1 text-sm font-bold text-heading">Local Processing</h3>
                        <p class="text-xs text-muted">Nothing leaves your device</p>
                    </div>
                    <div class="rounded-xl bg-surface-alt p-6">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                            <i class="bi bi-code-slash text-xl text-primary"></i>
                        </div>
                        <h3 class="mb-1 text-sm font-bold text-heading">MIT Licensed</h3>
                        <p class="text-xs text-muted">Free and open source</p>
                    </div>
                    <div class="rounded-xl bg-surface-alt p-6">
                        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10">
                            <i class="bi bi-globe text-xl text-primary"></i>
                        </div>
                        <h3 class="mb-1 text-sm font-bold text-heading">No Server Needed</h3>
                        <p class="text-xs text-muted">Runs via WebAssembly</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
