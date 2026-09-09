<script setup>
defineProps({ sections: { type: Array, default: () => [] } });

const accents = ['text-primary', 'text-heading', 'text-primary/70'];
</script>

<template>
    <section class="mx-auto max-w-4xl px-4 pb-16 pt-8 sm:px-6 sm:pt-10 md:pb-24">
        <div class="space-y-8">
            <template v-for="(section, index) in sections" :key="index">
                <!-- Paragraph -->
                <article v-if="section.type === 'paragraph'" class="rounded-3xl border border-border bg-white p-7 shadow-sm sm:p-8">
                    <h2 class="text-2xl font-bold tracking-tight text-heading sm:text-3xl">{{ section.heading }}</h2>
                    <p class="mt-3 text-pretty leading-relaxed text-muted">{{ section.content }}</p>
                </article>

                <!-- Steps -->
                <article v-else-if="section.type === 'steps'" class="rounded-3xl border border-border bg-white p-7 shadow-sm sm:p-8">
                    <h2 class="text-2xl font-bold tracking-tight text-heading sm:text-3xl">{{ section.heading }}</h2>
                    <ol class="mt-5 grid gap-4 sm:grid-cols-3">
                        <li v-for="(item, itemIndex) in section.items" :key="item.title" class="rounded-2xl bg-surface-alt p-5">
                            <span class="text-3xl font-extrabold" :class="accents[itemIndex % accents.length]">{{ itemIndex + 1 }}</span>
                            <h3 class="mt-2 font-semibold text-heading">{{ item.title }}</h3>
                            <p class="mt-1 text-sm text-muted">{{ item.description }}</p>
                        </li>
                    </ol>
                </article>

                <!-- Features -->
                <article v-else-if="section.type === 'features'" class="rounded-3xl border border-border bg-white p-7 shadow-sm sm:p-8">
                    <h2 class="text-2xl font-bold tracking-tight text-heading sm:text-3xl">{{ section.heading }}</h2>
                    <div class="mt-5 grid gap-5 sm:grid-cols-2">
                        <div v-for="item in section.items" :key="item.title" class="flex gap-3">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <i class="bi text-lg" :class="item.icon"></i>
                            </span>
                            <div>
                                <h3 class="font-semibold text-heading">{{ item.title }}</h3>
                                <p class="mt-1 text-sm leading-relaxed text-muted">{{ item.description }}</p>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- FAQ -->
                <article v-else-if="section.type === 'faq'" class="rounded-3xl border border-border bg-white p-7 shadow-sm sm:p-8">
                    <h2 class="text-2xl font-bold tracking-tight text-heading sm:text-3xl">{{ section.heading }}</h2>
                    <div class="mt-5 divide-y divide-border/60">
                        <details v-for="item in section.items" :key="item.question" class="group py-4">
                            <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-semibold text-heading">
                                {{ item.question }}
                                <i class="bi bi-chevron-down h-5 w-5 shrink-0 text-muted transition-transform duration-200 group-open:rotate-180"></i>
                            </summary>
                            <p class="mt-2 text-sm leading-relaxed text-muted">{{ item.answer }}</p>
                        </details>
                    </div>
                </article>
            </template>
        </div>
    </section>
</template>
