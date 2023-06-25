import { createRouter, createWebHistory } from "vue-router";
import HomePage from "../pages/HomePage.vue";
import PostPage from "../pages/PostPage.vue";

const routes = [
    {
        path: "/",
        component: HomePage,
    },
    {
        path: "/post",
        component: PostPage,
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});
export default router;
