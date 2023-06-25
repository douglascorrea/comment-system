<script setup>
import PostContent from "../components/PostContent.vue";
import CommentsSection from "../components/CommentsSection.vue";
//
const post = {
    id: 1,
    title: "A single post to demonstrate comments",
    href: "/post",
    content: `<p class='mt-6 text-xl leading-8'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget est non dui vestibulum venenatis eu id massa. Fusce ipsum nibh, vulputate ut tincidunt finibus, euismod sit amet augue. Aenean a tellus sapien. Aliquam nibh neque, tincidunt ac rhoncus blandit, semper sed augue. Maecenas ornare felis ex, non pretium arcu dapibus condimentum. Nunc rhoncus elementum magna nec iaculis. Ut orci metus, molestie quis orci ac, eleifend venenatis odio. Pellentesque luctus pellentesque purus, id gravida dolor tincidunt eu. Nam ornare in odio eget tempus.</p>
         <p class='mt-6 text-xl leading-8'>Praesent sit amet facilisis nibh. Phasellus ut nibh sit amet nunc imperdiet sodales. Donec dictum imperdiet elit, quis rhoncus elit ullamcorper a. Donec commodo, lectus eget ultricies aliquet, ante ligula varius massa, sit amet fringilla ligula leo ullamcorper augue. Etiam vitae enim id lectus consequat pulvinar. Phasellus tincidunt vestibulum nunc, at porta tortor. Proin tempor, libero vitae sollicitudin semper, purus lectus tempor nibh, non ultrices est tellus id mi</p>`,
    date: "Mar 25, 2023",
    datetime: "2023-03-25",
    category: { title: "Demonstration", href: "#" },
};
</script>
<template>
    <PostContent :post="post" />
    <CommentsSection />
</template>
