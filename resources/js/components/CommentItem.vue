<script setup>
import CommentForm from "./CommentForm.vue";
import { ref } from "vue";

const emit = defineEmits(["getComments"]);
const props = defineProps({
    comment: {
        type: Object,
        required: true,
    },
    commentIndex: {
        type: Number,
        required: true,
    },
    isReply: {
        type: Boolean,
        required: false,
        default: false,
    },
    depth: {
        type: Number,
        required: false,
        default: 0,
    },
});
let replying = ref(false);
const getComments = () => {
    console.log("getComments emitido pelo form comment id" + props.comment.id);
    replying.value = false;
    emit("getComments");
};
</script>

<template>
    <article
        class="p-6 mb-6 text-base bg-white dark:bg-gray-900"
        :class="{
            'rounded-lg': commentIndex === 0,
            'border-t border-gray-200 dark:border-gray-700':
                commentIndex > 0 && !comment.isReply,
        }"
        :style="{
            marginLeft: depth * 1.5 + 'rem',
        }"
    >
        <footer class="flex justify-between items-center mb-2">
            <div class="flex items-center">
                <p
                    class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"
                >
                    <img
                        class="mr-2 w-6 h-6 rounded-full"
                        :src="
                            comment.pictureUrl ||
                            'http://i.pravatar.cc/100?u={{ comment.id }}'
                        "
                        :alt="comment.name"
                    />{{ comment.name }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <!--                    <time-->
                    <!--                        pubdate-->
                    <!--                        datetime="2022-02-12"-->
                    <!--                        title="February 12th, 2022"-->
                    <!--                    >Feb. 12, 2022-->
                    <!--                    </time>-->
                    <time
                        pubdate
                        :datetime="comment.created_at"
                        :title="comment.created_at"
                        >{{ comment.created_at }}
                    </time>
                </p>
            </div>
        </footer>
        <p class="text-gray-500 dark:text-gray-400">
            {{ comment.body }}
        </p>
        <div v-if="depth < 3" class="flex items-center mt-4 space-x-4">
            <button
                type="button"
                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400"
                @click="replying = !replying"
            >
                <svg
                    aria-hidden="true"
                    class="mr-1 w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"
                    ></path>
                </svg>
                Reply
            </button>
        </div>
    </article>
    <CommentForm
        v-if="replying"
        :new-parent-id="comment.id"
        :comment-index="commentIndex"
        @get-comments="getComments"
    />
    <CommentItem
        v-for="child in comment.child_comments"
        :key="child.id"
        :comment-index="0"
        :comment="child"
        :is-reply="true"
        :depth="depth + 1"
        @get-comments="getComments"
    />
</template>

<style scoped></style>
