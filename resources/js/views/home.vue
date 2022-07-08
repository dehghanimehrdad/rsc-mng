<template>
    <div class="py-10">
        <header>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-5">
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="py-0.5 text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
                            Resources
                        </h2>
                    </div>
                    <div class="mt-4 flex md:mt-0 md:ml-4">
                        <a
                            href="/admin"
                            class="btn btn-red shadow-sm rounded-md"
                        >
                            Admin
                        </a>
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
                                            <div class="mx-auto mt-4  rounded">
                                                <!-- Tabs -->
                                                <ul id="tabs" class="inline-flex w-full px-1 pt-2 ">
                                                    <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-400 rounded-t opacity-50"><a id="default-tab" href="#files">Files</a></li>
                                                    <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#snippets">HTML Snippets</a></li>
                                                    <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#links">Links</a></li>
                                                </ul>

                                                <!-- Tab Contents -->
                                                <div id="tab-contents">
                                                    <div id="files" class="p-4">
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
                                                                                            class="btn btn-green shadow-sm  mr-0.5"
                                                                                            :href="file.file_url"
                                                                                        >
                                                                                            Download
                                                                                        </a>
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
                                                    <div id="snippets" class="hidden p-4">
                                                        <template v-if="snippetsList.length > 0">
                                                            <ul>
                                                                <template v-for="(snippet, index) in snippetsList">
                                                                    <li :class="{'border-t border-gray-200': index !== 0}">
                                                                        <div class="flex items-center px-4 py-4 sm:px-6">
                                                                            <div class="min-w-0 flex-1 flex items-center">
                                                                                <div class="min-w-0 flex-1 ltr:mr-4 rtl:ml-4 lg:grid lg:grid-cols-2 lg:gap-4">
                                                                                    <div>
                                                                                        <div class="text-sm font-medium leading-5 text-gray-800 truncate">{{ snippet.title }}</div>
                                                                                        <div class="text-sm font-medium leading-5 text-gray-400 truncate">{{ snippet.description }}</div>
                                                                                    </div>
                                                                                    <div class="flex justify-end">
                                                                                        <router-link
                                                                                            :to="'/snippets/' + snippet.id"
                                                                                            class="btn btn-green shadow-sm mr-0.5"
                                                                                        >
                                                                                            View
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
                                                    <div id="links" class="hidden p-4">
                                                        <template v-if="linksList.length > 0">
                                                            <ul>
                                                                <template v-for="(link, index) in linksList">
                                                                    <li :class="{'border-t border-gray-200': index !== 0}">
                                                                        <div class="flex items-center px-4 py-4 sm:px-6">
                                                                            <div class="min-w-0 flex-1 flex items-center">
                                                                                <div class="min-w-0 flex-1 ltr:mr-4 rtl:ml-4 lg:grid lg:grid-cols-2 lg:gap-4">
                                                                                    <div>
                                                                                        <div class="text-sm font-medium leading-5 text-gray-800 truncate">{{ link.title }}</div>
                                                                                        <div class="text-sm font-medium leading-5 text-gray-400 truncate">{{ link.open_in_new_tab == 1 ? "New Tab" : "Same page" }}</div>
                                                                                    </div>
                                                                                    <div class="flex justify-end">
                                                                                        <a
                                                                                            :target="link.open_in_new_tab == 1 ? '_blank' : ''"
                                                                                            class="btn btn-secondary shadow-sm  mr-0.5"
                                                                                            :href="link.url"
                                                                                        >
                                                                                            Visit
                                                                                        </a>
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
</template>

<script>

export default {
    name: "Home",
    mounted() {
        this.setupTabs();
        this.getResources();
    },
    data() {
        return {
            loading: true,
            filesList: [],
            linksList: [],
            snippetsList: [],
        }
    },
    methods: {
        //setup tabs for content
        setupTabs() {
            let tabsContainer = document.querySelector("#tabs");

            let tabTogglers = tabsContainer.querySelectorAll("a");
            console.log(tabTogglers);

            tabTogglers.forEach(function(toggler) {
                toggler.addEventListener("click", function(e) {
                    e.preventDefault();

                    let tabName = this.getAttribute("href");

                    let tabContents = document.querySelector("#tab-contents");

                    for (let i = 0; i < tabContents.children.length; i++) {

                        tabTogglers[i].parentElement.classList.remove("border-blue-400", "border-b",  "-mb-px", "opacity-100");  tabContents.children[i].classList.remove("hidden");
                        if ("#" + tabContents.children[i].id === tabName) {
                            continue;
                        }
                        tabContents.children[i].classList.add("hidden");

                    }
                    e.target.parentElement.classList.add("border-blue-400", "border-b-4", "-mb-px", "opacity-100");
                });
            });

            document.getElementById("default-tab").click();

        },
        getResources() {
            const self = this;
            self.loading = true;
            axios.get('/api/resources').then(function (response) {
                self.loading = false;
                response.data.resources.forEach(function(resource) {
                    console.log(resource.type);
                    switch (resource.type){
                        case 'File':
                            self.filesList.push(resource);
                            break;
                        case 'Link':
                            self.linksList.push(resource);
                            break;
                        case 'Snippet':
                            self.snippetsList.push(resource);
                            break;
                    }
                });
            }).catch(function () {
                self.loading = false;
            });
        }
    }
}

</script>
