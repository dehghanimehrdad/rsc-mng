<template>
    <div class="bg-white md:grid md:grid-cols-3 md:gap-6 px-4 py-5 sm:p-6">
        <div class="md:col-span-1">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Link</h3>
            <p class="mt-1 text-sm leading-5 text-gray-500">
                Link details.
            </p>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="grid grid-cols-3 gap-6">

                <div class="col-span-3">
                    <label class="block text-sm font-medium leading-5 text-gray-700" for="title">Title</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="title"
                            v-model="resource.title"
                            placeholder="Title"
                            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            required
                        >
                    </div>
                </div>
            </div>
            <div class="md:col-span-3">
                <div class="py-3">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                    <label class="block text-sm font-medium leading-5 text-gray-700" for="url">URL</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="url"
                            type="url"
                            v-model="resource.url"
                            placeholder="URL"
                            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            required
                        >
                    </div>
                </div>

            </div>
            <div class="md:col-span-3">
                <div class="py-3">
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                    <label class="text-sm font-medium leading-5 text-gray-700" for="open_in_new_tab">
                        <input
                            id="open_in_new_tab"
                            type="checkbox"
                            v-model="resource.open_in_new_tab"
                        >
                        Open in new tab
                    </label>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "link-form",
    props: {
        resource: {
            type: Object,
            required: true
        },
    },
}
</script>
