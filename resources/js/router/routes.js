// Routes used by application front-end are configured here
import HomePage from "../views/home.vue";
import AdminPage from "../views/admin/index.vue";

const routes = [
    {
        path: '',
        component: HomePage,
        name: 'home'
    },
    {
        path: '/admin',
        component: AdminPage,
        name: 'admin'
    }
]

export default routes;
