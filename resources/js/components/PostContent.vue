<script setup>
defineProps({
    post: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="bg-white px-6 pt-10 pb-4 lg:px-8">
        <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">
            <p class="text-base font-semibold leading-7 text-indigo-600">
                {{ post.category.title }}
            </p>
            <h1
                class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
            >
                {{ post.title }}
            </h1>
            <!-- eslint-disable-next-line vue/no-v-html -->
            <div v-html="post.content"></div>
        </div>
    </div>
</template>

<style scoped></style>
