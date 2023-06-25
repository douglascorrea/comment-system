<script setup>
import CommentForm from "./CommentForm.vue";
import CommentItem from "./CommentItem.vue";
import { useAxios } from "@vueuse/integrations/useAxios";

const { data: comments, execute } = useAxios(
    "/api/comment",
    { method: "GET" },
    { immediate: false }
);
execute();
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
            <CommentForm @get-comments="execute" />
            <CommentItem
                v-for="(comment, commentIndex) in comments"
                :key="comment.id"
                :comment="comment"
                :comment-index="commentIndex"
                :depth="0"
                :is-reply="false"
                @get-comments="execute"
            />
        </div>
    </section>
</template>

<style scoped></style>
