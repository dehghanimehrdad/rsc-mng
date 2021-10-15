<template>
    <main class="flex-1 relative overflow-y-auto py-6 focus:outline-none" tabindex="0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-5">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="py-0.5 text-2xl font-semibold text-gray-900">Files</h1>
                </div>
                <div class="mt-4 flex md:mt-0 md:ltr:ml-4 md:rtl:mr-4">
                    <router-link
                        class="btn btn-blue shadow-sm rounded-md"
                        to="/admin/files/create"
                    >
                        Upload new PDF
                    </router-link>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="my-6 bg-white shadow overflow-hidden sm:rounded-md">
                <template v-if="filesList.length > 0">
                    <ul>
                        <template v-for="(file, index) in filesList">
                            <li :class="{'border-t border-gray-200': index !== 0}">
                                <div class="flex items-center px-4 py-4 sm:px-6">
                                        <div class="min-w-0 flex-1 flex items-center">
                                            <div class="min-w-0 flex-1 ltr:mr-4 rtl:ml-4 lg:grid lg:grid-cols-2 lg:gap-4">
                                                <div>
                                                    <div class="text-sm font-medium leading-5 text-gray-800 truncate">{{ file.title }}</div>
                                                </div>
                                                <div class="flex justify-end">
                                                    <a
                                                        target="_blank"
                                                        class="btn btn-secondary shadow-sm  mr-0.5"
                                                        :href="file.url"
                                                    >
                                                        View
                                                    </a>
                                                    <router-link
                                                        :to="'/admin/files/' + file.id + '/edit'"
                                                        class="btn btn-green shadow-sm mr-0.5"
                                                    >
                                                        Edit
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </li>
                        </template>
                    </ul>
                </template>
                <template v-else-if="!loading">
                    <div class="h-full flex">
                        <div class="m-auto">
                            <div class="grid grid-cols-1 justify-items-center h-full w-full px-4 py-10">
                                <div class="flex justify-center items-center">
                                    <div class="w-full font-semibold text-2xl">No records found</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

    </main>
</template>

<script>
export default {
    name: "list",
    data() {
        return {
            loading: true,
            filesList: []
        }
    },
    mounted() {
        //load files when mounted
        this.getFiles();
    },
    methods: {
        getFiles() {

            const self = this;

            //set loading state to true
            self.loading = true;

            //call api for resources
            axios.get('/api/admin/files').then(function (response) {
                //set items and then reset loading
                self.filesList = response.data.items;
                self.loading = false;
            }).catch(function () {
                //reset loading
                self.loading = false;
            });
        }
    }
}
</script>
