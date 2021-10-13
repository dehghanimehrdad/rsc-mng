<template>
    <router-link
        class="router-link router-link-desktop"
        :to="to"
    >
        {{ label }}
    </router-link>
</template>

<script>
export default {
    name: "menu-item",
    props: {
        to: {
            type: String,
            require: true,
        },
        label: {
            type: String,
            require: true,
        },
    }
}
</script>
