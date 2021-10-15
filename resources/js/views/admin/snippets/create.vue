<template>
    <main class="flex-1 relative overflow-y-auto py-6 focus:outline-none" tabindex="0">
        <form @submit.prevent="saveSnippet">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-5">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h1 class="py-0.5 text-2xl font-semibold text-gray-900">Create HTML Snippet</h1>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mt-6 shadow sm:rounded-lg">
                    <div class="bg-white md:grid md:grid-cols-3 md:gap-6 px-4 py-5 sm:p-6">
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Snippet</h3>
                            <p class="mt-1 text-sm leading-5 text-gray-500">
                                Snippet details.
                            </p>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-3 gap-6">

                                <div class="col-span-3">
                                    <label class="block text-sm font-medium leading-5 text-gray-700" for="title">Title</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input
                                            id="title"
                                            v-model="snippet.title"
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
                                    <label class="block text-sm font-medium leading-5 text-gray-700" for="description">Description</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <textarea
                                            id="description"
                                            v-model="snippet.description"
                                            placeholder="Description"
                                            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="bg-white md:grid md:grid-cols-3 md:gap-6 px-4 py-5 sm:p-6">
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Content</h3>
                            <p class="mt-1 text-sm leading-5 text-gray-500">
                                Snippet content.
                            </p>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3">
                                    <label class="block text-sm font-medium leading-5 text-gray-700" for="content">HTML Content</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <textarea
                                            id="content"
                                            v-model="snippet.content"
                                            placeholder="Content"
                                            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        ></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="bg-gray-100 text-right px-4 py-3 sm:px-6">
                        <div class="inline-flex">
                            <router-link
                                class="btn btn-secondary shadow-sm rounded-md mr-4"
                                to="/admin/snippets"
                            >
                                Cancel
                            </router-link>
                            <button
                                class="btn btn-green shadow-sm rounded-md"
                                type="submit"
                            >
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
</template>

<script>
export default {
    name: "new",
    data() {
        return {
            snippet: {
                title: null,
                description: null,
                content: null,
            },
        }
    },
    methods: {

        saveSnippet() {
            const self = this;

            //make form data to send the snippet to server
            const formData = new FormData();
            formData.append('title', self.snippet.title);
            formData.append('description', self.snippet.description);
            formData.append('content', self.snippet.content);

            //send snippet to server
            axios.post('/api/admin/snippets', self.snippet).then(function (response) {
                self.$router.push('/admin/snippets/');
            }).catch(function () {
                alert('Error creating resource');
            });
        }
    },
}
</script>
