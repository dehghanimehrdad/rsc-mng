<template>
    <div class="h-screen flex overflow-hidden bg-gray-100">
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="min-h-screen bg-gray-100">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "visitor"
}
</script>
