// Routes used by application front-end are configured here
import AdminLayout from "../views/layouts/admin";
import HomePage from "../views/home.vue";
import AdminPage from "../views/admin/index.vue";

import AdminFilesList from "../views/admin/files/list";
import AdminFileCreate from "../views/admin/files/create";
import AdminFileEdit from "../views/admin/files/edit";

import AdminSnippetsList from "../views/admin/snippets/list";
import AdminSnippetCreate from "../views/admin/snippets/create";
import AdminSnippetEdit from "../views/admin/snippets/edit";

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
            //index
            {path: '', component: AdminPage},

            //files
            {path: 'files', component: AdminFilesList},
            {path: 'files/create', component: AdminFileCreate},
            {path: 'files/:id/edit', component: AdminFileEdit},

            //snippets
            {path: 'snippets', component: AdminSnippetsList},
            {path: 'snippets/create', component: AdminSnippetCreate},
            {path: 'snippets/:id/edit', component: AdminSnippetEdit},
        ]
    }
]

export default routes;
