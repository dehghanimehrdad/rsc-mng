<template>
    <div class="h-screen flex overflow-hidden bg-gray-100">
        <sidebar></sidebar>
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Sidebar from "../../components/layout/dashboard/sidebar";

export default {
    name: "dashboard",
    components: {Sidebar}
}
</script>
