<template>
    <div>
        <div class="my-3 mx-4 uppercase text-gray-300 text-xs">
            Administration
        </div>
        <menu-item
            label="Home"
            to="/"
        >
        </menu-item>
        <menu-item
            label="Files"
            to="/admin/files"
        >
        </menu-item>
        <menu-item
            label="HTML Snippets"
            to="/admin/snippets"
        >
        </menu-item>
        <menu-item
            label="Links"
            to="/admin/links"
        >
        </menu-item>
    </div>
</template>

<script>
import MenuItem from "../../../../components/layout/dashboard/menu/menu-item";

export default {
    name: "menu-list",
    components: {MenuItem}
}
</script>
