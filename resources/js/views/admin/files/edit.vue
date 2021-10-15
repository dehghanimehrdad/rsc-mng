<template>
    <main class="flex-1 relative overflow-y-auto py-6 focus:outline-none" tabindex="0">
        <form @submit.prevent="saveFile">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-5">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h1 class="py-0.5 text-2xl font-semibold text-gray-900">Edit PDF</h1>
                    </div>
                    <div class="mt-4 flex md:mt-0 md:ml-4">
                        <button
                            class="btn btn-red shadow-sm rounded-md"
                            type="button"
                            @click="deleteFileModal = true"
                        >
                            Delete File
                        </button>
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
                                                    v-if="file_preview"
                                                    class="h-full w-full text-gray-500">
                                                        {{ file_preview }}
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
        <div v-show="deleteFileModal" class="fixed z-20 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div v-show="deleteFileModal" class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;

                <div
                    v-show="deleteFileModal"
                    aria-labelledby="modal-headline"
                    aria-modal="true"
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog"
                >
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <!--                                    <svg-vue class="h-6 w-6 pb-1 text-red-600" icon="font-awesome.exclamation-triangle-light"></svg-vue>-->
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 id="modal-headline" class="text-lg leading-6 font-medium text-gray-900">
                                    Delete file
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm leading-5 text-gray-500">
                                        Are you sure you want to delete the file?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button
                            class="btn btn-red mr-2 sm:mr-0"
                            type="button"
                            @click="deleteFile"
                        >
                            Delete file
                        </button>
                        <button
                            class="btn btn-white mr-0 sm:mr-2"
                            type="button"
                            @click="deleteFileModal = false"
                        >
                            Cancel
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "edit",
    data() {
        return {
            loading: false,
            deleteFileModal: false,
            file: {
                title: null,
                file: null,
            },
            file_preview: '',
        }
    },
    mounted() {
        //load the file for edit
        this.getFile();
    },
    methods: {
        // for file validation
        changeFile(event) {
            const self = this;
            if (event.target.files.length) {
                //check for pdf format, using array we can later add other file supports
                if (['application/pdf'].includes(event.target.files[0].type)) {
                    self.file.file = event.target.files[0];
                    self.file_preview = event.target.files[0].name;
                } else {
                    alert('Not supported format!');
                }
            }
        },
        selectFile() {
            this.$refs.changeFile.click();
        },
        //send the dited data to server
        saveFile() {
            const self = this;
            const formData = new FormData();
            self.loading = true;

            formData.append('title', self.file.title);
            formData.append('file', self.file.file);

            formData.append("_method", "put");

            self.loading = true;
            axios.post('/api/admin/files/' + self.$route.params.id, formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(function (response) {
                self.$router.push('/admin/files/');
            }).catch(function () {
                self.loading = false;
            });
        },
        //load file
        getFile() {
            const self = this;
            self.loading = true;
            axios.get('/api/admin/files/' + self.$route.params.id).then(function (response) {
                self.file = response.data;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },
        //delete file method
        deleteFile() {
            const self = this;
            axios.delete('/api/admin/files/' + self.$route.params.id).then(function () {

                self.$router.push('/admin/files/');
            }).catch(function () {
                self.deleteFileModal = false;
            });
        },
    }
}
</script>
