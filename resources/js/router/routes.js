// Routes used by application front-end are configured here
import AdminLayout from "../views/layouts/admin";
import HomePage from "../views/home.vue";
import AdminPage from "../views/admin/index.vue";
import AdminFilesList from "../views/admin/files/list";
import AdminFileCreate from "../views/admin/files/create";
import AdminFileEdit from "../views/admin/files/edit";

const routes = [
    {
        path: '',
        component: HomePage,
        name: 'home'
    },
    {
        path: '/admin',
        component: AdminLayout,
        name: 'admin',
        children: [
            {path: '', component: AdminPage},
            {path: 'files', component: AdminFilesList},
            {path: 'files/create', component: AdminFileCreate},
            {path: 'files/:id/edit', component: AdminFileEdit},
        ]
    }
]

export default routes;
