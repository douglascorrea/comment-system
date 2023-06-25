<script setup>
const emit = defineEmits(["getComments"]);
const props = defineProps({
    newParentId: {
        type: Number,
        default: null,
    },
});

import { ref } from "vue";
import { useAxios } from "@vueuse/integrations/useAxios";

let newComment = ref("");
let newName = ref("");

const createComment = async () => {
    const data = {
        body: newComment.value,
        name: newName.value,
    };
    if (props.newParentId) {
        data.parent_comment_id = props.newParentId;
    }
    console.log(newComment.value);
    const { execute } = useAxios(
        "/api/comment",
        {
            method: "POST",
            data,
        },
        {
            immediate: false,
        }
    );
    await execute();

    newName.value = "";
    newComment.value = "";
    emit("getComments");
};
</script>

<template>
    <form class="mb-6" @submit.prevent="createComment">
        <div
            class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700"
        >
            <label for="comment" class="sr-only">Your Name</label>
            <input
                id="comment"
                v-model="newName"
                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                placeholder="Your Name"
                required
            />
        </div>
        <div
            class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700"
        >
            <label for="comment" class="sr-only">Your comment</label>
            <textarea
                id="comment"
                v-model="newComment"
                rows="6"
                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                placeholder="Write a comment..."
                required
            ></textarea>
        </div>
        <button
            :disabled="newComment.length < 3 || newName.length < 3"
            type="submit"
            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800 disabled:opacity-50 disabled:cursor-not-allowed"
        >
            Post comment
        </button>
    </form>
</template>

<style scoped></style>
