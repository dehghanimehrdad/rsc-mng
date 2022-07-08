<template>
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
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3">
                    <div class="grid grid-cols-2 ">
                        <div>
                            <div class="mt-2 flex items-center select-none">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3">
                                        <div class="grid grid-cols-2 ">
                                            <div>
                                                <label class="block text-sm leading-5 font-medium text-gray-700">File</label>
                                                <div class="mt-2 flex items-center select-none">
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
                                <span
                                    v-if="file_preview"
                                    class="h-full w-full text-gray-500">
                                    {{ file_preview }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "file-form",
    data() {
        return {
            file_preview: '',
        }
    },
    props: {
        resource: {
            type: Object,
            required: true
        },
    },
    methods: {
        // for file validation
        changeFile(event)
        {
            const self = this;
            if (event.target.files.length) {
                //check for pdf format, using array we can later add other file supports
                if (['application/pdf'].includes(event.target.files[0].type)) {
                    self.resource.file = event.target.files[0];
                    self.file_preview = event.target.files[0].name;
                } else {
                    alert('Not supported format!');
                }
            }
        },
        selectFile()
        {
            this.$refs.changeFile.click();
        },
    },
}
</script>
