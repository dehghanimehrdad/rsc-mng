<template>
    <div v-if="snippet" class="py-10">
        <header>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-5">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="py-0.5 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                            {{ snippet.title }} HTML Snippet
                        </h2>
                    </div>
                    <div class="mt-4 flex md:mt-0 md:ml-4">
                        <button
                            class="btn btn-green shadow-sm rounded-md"
                            type="button"
                            @click="copy"
                        >
                            Copy
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-10 shadow sm:rounded-lg">
                    <div class="bg-white md:grid md:grid-cols-3 md:gap-6 px-4 py-5 sm:p-6">
                            <div class="mt-5 md:mt-0 md:col-span-12">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3">
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="mx-auto mt-4 rounded">
                                                <div class="bg-white md:grid md:grid-cols-1 md:gap-6 px-4 py-5 sm:p-6">
                                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Description</h3>
                                                    <p class="overflow-clip"> {{snippet.description}}</p>
                                                </div>

                                                <div class="bg-white md:grid md:grid-cols-1 md:gap-6 px-4 py-5 sm:p-6">
                                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Content</h3>
                                                    <pre>
                                                        {{snippet.content}}
                                                    </pre>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </main>
    </div>
    <div v-else-if="!loading" class="h-full flex">
        <div class="m-auto">
            <div class="grid grid-cols-1 justify-items-center h-full w-full px-4 py-10">
                <div class="flex justify-center items-center">
                    <div class="w-full font-semibold text-2xl">Not found</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "ShowSnippet",
    mounted() {
        this.getSnippet();
    },
    data() {
        return {
            loading: true,
            snippet: null,
        }
    },
    methods: {
        getSnippet() {
            const self = this;
            self.loading = true;
            axios.get('/api/resources/snippets/' + self.$route.params.id).then(function (response) {
                self.loading = false;
                self.snippet = response.data;
            }).catch(function () {
                self.loading = false;
            });
        },
        copy(){
            navigator.clipboard.writeText(this.snippet.content)
        }
    }
}

</script>
