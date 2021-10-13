import VueRouter from "vue-router";
import routes from "./routes";

// create a router
const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router;
