<template>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl">
                <h2
                    class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
                >
                    Single Post Blog
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    An amazing blog with a single post.
                </p>
                <div
                    class="mt-10 space-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16"
                >
                    <div v-for="post in posts" :key="post.id">
                        <PostExcerpt :post="post" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import PostExcerpt from "../components/PostExcerpt.vue";

const posts = [
    {
        id: 1,
        title: "A single post to demonstrate comments",
        href: "/post",
        description:
            "Illo sint voluptas. Error voluptates culpa eligendi. Hic vel totam vitae illo. Non aliquid explicabo necessitatibus unde. Sed exercitationem placeat consectetur nulla deserunt vel iusto corrupti dicta laboris incididunt.",
        date: "Mar 25, 2023",
        datetime: "2023-03-25",
        category: { title: "Demonstration", href: "#" },
        author: {
            name: "Douglas Correa",
            role: "Senior Software Engineer",
            href: "#",
            imageUrl: "https://i.pravatar.cc/100",
        },
    },
];
</script>
