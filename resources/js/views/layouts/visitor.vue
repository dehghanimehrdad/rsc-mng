<template>
    <div class="h-screen flex bg-gray-100">
        <div class="flex flex-col w-0 flex-1">
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
