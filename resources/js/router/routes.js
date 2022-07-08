// Routes used by application front-end are configured here
import AdminLayout from "../views/layouts/admin";
import VisitorLayout from "../views/layouts/visitor";
import HomePage from "../views/home.vue";
import SnippetShow from "../views/snippets/show.vue";

import AdminResourcesList from "../views/admin/resources/list";
import AdminResourcesForm from "../views/admin/resources/resource-form";

const routes = [
    {
        path: '',
        component: VisitorLayout,
        name: 'visitor',
        children: [
            {path: '', component: HomePage},
            {path: 'snippets/:id', component: SnippetShow},
        ]
    },
    {
        path: '/admin',
        component: AdminLayout,
        name: 'admin',
        redirect:'/admin/resources',
        children: [
            //files
            {path: 'resources', component: AdminResourcesList},
            {path: 'resources/create', component: AdminResourcesForm},
            {path: 'resources/:id/edit', component: AdminResourcesForm},
        ]
    }
]

export default routes;
