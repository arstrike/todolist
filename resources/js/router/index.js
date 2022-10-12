import { createRouter,createWebHistory } from "vue-router";
import task from '../components/task/index.vue';
import notFound from '../components/notFound.vue';
const routes=[
    {
        path:'/',
        component:task
    },
    {
        path:'/:pathMatch(.*)*',
        component:notFound
    }
];
const router=createRouter({
    history:createWebHistory(import.meta.env.BASE_URL),
    routes
});
export default router;