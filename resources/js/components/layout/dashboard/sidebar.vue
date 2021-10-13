<template>
    <div class="flex">
        <div  class="md:hidden">
            <div class="fixed inset-0 flex z-40">
                <div class="flex flex-col">
                    <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                        <nav class="flex-1 pb-4 bg-gray-800">
                            <menu-list></menu-list>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64">
                <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                    <nav class="flex-1 pb-4 bg-gray-800">
                        <menu-list></menu-list>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MenuList from "../../../components/layout/dashboard/menu/menu-list";

export default {
    name: "sidebar",
    components: {MenuList},
}
</script>
