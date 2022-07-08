<template>
    <main class="flex-1 relative overflow-y-auto py-6 focus:outline-none" tabindex="0">
        <form @submit.prevent="saveResource">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-5">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h1 class="py-0.5 text-2xl font-semibold text-gray-900">Edit Resource</h1>
                    </div>
                    <div v-if="editing" class="mt-4 flex md:mt-0 md:ml-4">
                        <button
                            class="btn btn-red shadow-sm rounded-md"
                            type="button"
                            @click="deleteResourceModal = true"
                        >
                            Delete Resource
                        </button>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mt-6 shadow sm:rounded-lg">
                    <div v-if="!editing" class="grid grid-cols-3 gap-6 ml-5 pt-5">
                        <div class="col-span-1">
                            <label for="types" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Resource Type</label>
                            <select id="types" v-model="resource.type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose a type</option>
                                <option value="File">File</option>
                                <option value="Snippet">Snippet</option>
                                <option value="Link">Link</option>
                            </select>
                        </div>
                        <div class="md:col-span-3">
                            <div class="py-1">
                            </div>
                        </div>
                    </div>

                    <link-form v-if="resource.type ==='Link'" :resource="resource"></link-form>
                    <file-form v-if="resource.type ==='File'" :resource="resource"></file-form>
                    <snippet-form v-if="resource.type ==='Snippet'" :resource="resource"></snippet-form>
                    <div class="bg-gray-100 text-right px-4 py-3 sm:px-6">
                        <div class="inline-flex">
                            <router-link
                                class="btn btn-secondary shadow-sm rounded-md mr-4"
                                to="/admin/resources"
                            >
                                Cancel
                            </router-link>
                            <button
                                class="btn btn-green shadow-sm rounded-md"
                                type="submit"
                            >
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div v-show="deleteResourceModal" class="fixed z-20 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <div v-show="deleteResourceModal" class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;

                <div
                    v-show="deleteResourceModal"
                    aria-labelledby="modal-headline"
                    aria-modal="true"
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog"
                >
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 id="modal-headline" class="text-lg leading-6 font-medium text-gray-900">
                                    Delete resource
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm leading-5 text-gray-500">
                                        Are you sure you want to delete the resource?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-100 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button
                            class="btn btn-red mr-2 sm:mr-0"
                            type="button"
                            @click="deleteResource"
                        >
                            Delete resource
                        </button>
                        <button
                            class="btn btn-white mr-0 sm:mr-2"
                            type="button"
                            @click="deleteResourceModal = false"
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
import LinkForm from "../links/link-form";
import FileForm from "../files/file-form";
import SnippetForm from "../snippets/snippet-form";

export default {
    name: "resource-form",
    components: {LinkForm, FileForm, SnippetForm},

    data() {
        return {
            loading: false,
            editing: false,
            deleteResourceModal: false,
            resource: {
                type: null,
                title: null,
                description: null,
                content: null,
                file_url: null,
                url: null,
                open_in_new_tab: null,
                file: null,
            },
        }
    },
    mounted() {
        //check if we are editing the resource
        this.editing = this.$route.params.hasOwnProperty('id');

        //load the file for edit
        if (this.editing){
            this.getResource();
        }
    },
    methods: {
        //send the resource data to server
        saveResource()
        {
            const self = this;
            self.loading = true;

            //check if resource is file to handle it with multi part form
            if (this.resource.type === 'File'){
                const formData = new FormData();
                formData.append('type', 'File');
                formData.append('title', self.resource.title);
                if(self.resource.hasOwnProperty('file')) formData.append('file', self.resource.file);
                if (self.editing){
                    formData.append("_method", "put");
                    axios.post('/api/admin/resources/' + self.$route.params.id, formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(function (response) {
                        self.$router.push('/admin/resources/');
                    }).catch(function () {
                        self.loading = false;
                    });
                }else {
                    axios.post('/api/admin/resources', formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(function (response) {
                        self.$router.push('/admin/resources/');
                    }).catch(function () {
                        self.loading = false;
                    });
                }

            }else {
                //send resource to server
                if (self.editing){
                    axios.put('/api/admin/resources/' + self.$route.params.id, self.resource).then(function (response) {
                        self.$router.push('/admin/resources/');
                    }).catch(function () {
                        alert('Error updating resource');
                    });
                }else {
                    axios.post('/api/admin/resources', self.resource).then(function (response) {
                        self.$router.push('/admin/resources/');
                    }).catch(function () {
                        alert('Error creating resource');
                    });
                }
            }
        },

        //send the edited resource data to server
        updateResource()
        {
            const self = this;
            self.loading = true;

            //check if resource is file to handle it with multi part form
            if (this.resource.type === 'File'){
                const formData = new FormData();
                formData.append('type', 'File');
                formData.append('title', self.resource.title);
                if(self.resource.hasOwnProperty('file')) formData.append('file', self.resource.file);
                formData.append("_method", "put");
                axios.post('/api/admin/resources/' + self.$route.params.id, formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(function (response) {
                    self.$router.push('/admin/resources/');
                }).catch(function () {
                    self.loading = false;
                });
            }else {
                //send resource to server
                axios.put('/api/admin/resources', self.resource).then(function (response) {
                    self.$router.push('/admin/resources/');
                }).catch(function () {
                    alert('Error creating resource');
                });
            }
        },

        //load resource
        getResource()
        {
            const self = this;
            self.loading = true;
            axios.get('/api/admin/resources/' + self.$route.params.id).then(function (response) {
                self.resource = response.data;
                self.loading = false;
            }).catch(function () {
                self.loading = false;
            });
        },

        //delete resource method
        deleteResource()
        {
            const self = this;
            axios.delete('/api/admin/resources/' + self.$route.params.id).then(function () {
                self.$router.push('/admin/resources/');
            }).catch(function () {
                self.deleteFileModal = false;
            });
        },
    }
}
</script>
