<template>
    <main class="flex-1 relative overflow-y-auto py-6 focus:outline-none" tabindex="0">
        <form @submit.prevent="saveFile">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-5">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h1 class="py-0.5 text-2xl font-semibold text-gray-900">Upload PDF</h1>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mt-6 shadow sm:rounded-lg">
                    <div class="bg-white md:grid md:grid-cols-3 md:gap-6 px-4 py-5 sm:p-6">
                        <div class="md:col-span-1">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">File</h3>
                            <p class="mt-1 text-sm leading-5 text-gray-500">
                                File details.
                            </p>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="grid grid-cols-3 gap-6">

                                <div class="col-span-3">
                                    <label class="block text-sm font-medium leading-5 text-gray-700" for="title">Title</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input
                                            id="title"
                                            v-model="file.title"
                                            placeholder="Title"
                                            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="md:col-span-3">
                                <div class="py-3">
                                    <div class="border-t border-gray-200"></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-6">
                                <div class="col-span-3">
                                    <div class="grid grid-cols-2 ">
                                        <div>
                                            <label class="block text-sm leading-5 font-medium text-gray-700">File</label>
                                            <div class="mt-2 flex items-center select-none">
                                                <span
                                                    v-if="file.file"
                                                    class="h-full w-full text-gray-500">
                                                        {{ file.file.name }}
                                                </span>
                                                <input ref="changeFile" accept=".pdf" hidden type="file" @change="changeFile($event)">
                                                <button
                                                    class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                                                    type="button"
                                                    @click="selectFile"
                                                >
                                                    Select
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="bg-gray-100 text-right px-4 py-3 sm:px-6">
                        <div class="inline-flex">
                            <router-link
                                class="btn btn-secondary shadow-sm rounded-md mr-4"
                                to="/admin/files"
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
            file: {
                title: null,
                file: null,
            },
        }
    },
    methods: {
        changeFile(event) {
            const self = this;
            if (event.target.files.length) {
                //check for pdf format, using array we can later add other file supports
                if (['application/pdf'].includes(event.target.files[0].type)) {
                    self.file.file = event.target.files[0];
                } else {
                    alert('Not supported format!');
                }
            }
        },
        selectFile() {
            this.$refs.changeFile.click();
        },
        saveFile() {
            const self = this;

            //make form data to upload the file
            const formData = new FormData();
            formData.append('title', self.file.title);
            formData.append('file', self.file.file);

            //send file to server
            axios.post('/api/admin/files', formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(function (response) {
                self.$router.push('/admin/files/');
            }).catch(function () {
                alert('Error uploading file');
            });
        }
    },
}
</script>
