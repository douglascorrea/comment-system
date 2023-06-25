<script setup>
import CommentForm from "./CommentForm.vue";
import CommentItem from "./CommentItem.vue";

const comments = [
    {
        id: 1,
        isReply: false,
        user: "Michael Gough",
        date: "Mar 16, 2021",
        pictureUrl: "https://i.pravatar.cc/100?u=1",
        content: `
            Very straight-to-point article. Really worth time reading. Thank
            you! But tools are just the instruments for the UX designers. The
            knowledge of the design tools are as important as the creation of
            the design strategy.
        `,
    },
    {
        id: 2,
        isReply: true,
        user: "Jese Leos",
        pictureUrl: "https://i.pravatar.cc/100?u=2",
        date: "Feb. 12, 2022",
        content: `
            Much appreciated! Glad you liked it ☺️
        `,
    },
    {
        id: 3,
        isReply: false,
        user: "John Doe",
        pictureUrl: "https://i.pravatar.cc/100?u=3",
        date: "Aug. 12, 2021",
        content: `
        One more comment for testing.
        The article covers the essentials, challenges, myths and
        `,
    },
    {
        id: 4,
        isReply: false,
        user: "Bonnie Green",
        pictureUrl: "https://i.pravatar.cc/100?u=4",
        date: "Aug. 25, 2021",
        content: `
            The article covers the essentials, challenges, myths and
            stages the UX designer should consider while creating the
            design strategy.
        `,
    },
    {
        id: 5,
        isReply: false,
        user: "Jennifer Dean",
        pictureUrl: "https://i.pravatar.cc/100?u=4",
        date: "Nov. 25, 2021",
        content: `
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam quod.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam quod.
        `,
    },
];
</script>

<template>
    <section class="bg-white dark:bg-gray-900 py-8 lg:py-12 mt-5">
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2
                    class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white"
                >
                    Discussion (20)
                </h2>
            </div>
            <CommentForm />
            <CommentItem
                v-for="(comment, commentIndex) in comments"
                :key="comment.id"
                :comment="comment"
                :comment-index="commentIndex"
            />
        </div>
    </section>
</template>

<style scoped></style>
