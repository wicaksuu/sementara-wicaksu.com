<div class="flex space-x-1 justify-around">
    @if (isset($action))
    <div x-data="{ open: {{ isset($open) && $open ? 'true' : 'false' }}, working: false }" x-cloak
        wire:key="reload-{{ $id }}">

        <span wire:loading.remove>
            <span x-on:click="open = true">
                <button class="p-1 text-green-600 rounded hover:bg-green-600 hover:text-white">
                    <svg width="30px" height="30px" viewBox="-3 0 36 36" version="1.1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs></defs>
                        <g id="Vivid.JS" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Vivid-Icons" transform="translate(-358.000000, -487.000000)">
                                <g id="Icons" transform="translate(37.000000, 169.000000)">
                                    <g id="refresh" transform="translate(312.000000, 312.000000)">
                                        <g transform="translate(8.000000, 6.000000)" id="Shape">
                                            <path
                                                d="M7.518,17.936 C7.49293256,20.210537 8.37251881,22.4018586 9.96323166,24.027829 C11.5539445,25.6537993 13.72546,26.5812058 16,26.606 L16,28.94 L15.056,33.226 C7.07302886,32.6307029 0.92301238,25.9407661 1,17.936 C0.866169026,10.7120146 5.91682031,4.42563728 13,3 L15,3 L15.048,9.323 C10.7154281,9.86608306 7.47749475,13.5697112 7.518,17.936 Z"
                                                fill="#0C0058"></path>
                                            <path
                                                d="M16,33.275 C15.681,33.275 15.37,33.246 15.056,33.226 L16,28.94 L16,26.606 C20.7157508,26.5047031 24.4857636,22.6528386 24.4857636,17.936 C24.4857636,13.2191614 20.7157508,9.36729694 16,9.266 C15.6828215,9.26728475 15.3659742,9.28664949 15.051,9.324 L15,7 C15,7 14.342,2.6 16,2.6 C24.3763343,2.69447062 31.0910815,9.55962816 31,17.936 C31.0927508,26.3135379 24.3775187,33.1805342 16,33.275 Z"
                                                fill="#FF6E6E"></path>
                                            <polygon fill="#FF6E6E" points="18.005 36 18.005 22 11 29"></polygon>
                                            <polygon fill="#0C0058" points="13.989 0 13.989 13 20.013 6.506"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>
            </span>
        </span>
        <span wire:loading>
            <button class="p-1 text-red-600 rounded hover:bg-red-600 hover:text-white">
                <svg width="30px" height="30px" viewBox="-3 0 36 36" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs></defs>
                    <g id="Vivid.JS" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Vivid-Icons" transform="translate(-358.000000, -487.000000)">
                            <g id="Icons" transform="translate(37.000000, 169.000000)">
                                <g id="refresh" transform="translate(312.000000, 312.000000)">
                                    <g transform="translate(8.000000, 6.000000)" id="Shape">
                                        <path
                                            d="M7.518,17.936 C7.49293256,20.210537 8.37251881,22.4018586 9.96323166,24.027829 C11.5539445,25.6537993 13.72546,26.5812058 16,26.606 L16,28.94 L15.056,33.226 C7.07302886,32.6307029 0.92301238,25.9407661 1,17.936 C0.866169026,10.7120146 5.91682031,4.42563728 13,3 L15,3 L15.048,9.323 C10.7154281,9.86608306 7.47749475,13.5697112 7.518,17.936 Z"
                                            fill="#0C0058"></path>
                                        <path
                                            d="M16,33.275 C15.681,33.275 15.37,33.246 15.056,33.226 L16,28.94 L16,26.606 C20.7157508,26.5047031 24.4857636,22.6528386 24.4857636,17.936 C24.4857636,13.2191614 20.7157508,9.36729694 16,9.266 C15.6828215,9.26728475 15.3659742,9.28664949 15.051,9.324 L15,7 C15,7 14.342,2.6 16,2.6 C24.3763343,2.69447062 31.0910815,9.55962816 31,17.936 C31.0927508,26.3135379 24.3775187,33.1805342 16,33.275 Z"
                                            fill="#FF6E6E"></path>
                                        <polygon fill="#FF6E6E" points="18.005 36 18.005 22 11 29"></polygon>
                                        <polygon fill="#0C0058" points="13.989 0 13.989 13 20.013 6.506"></polygon>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </button>
        </span>

        <div x-show="open"
            class="fixed z-50 bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div x-show="open" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-gray-100 rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6">
                <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                    <button @click="open = false" type="button"
                        class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="w-full">
                    <div class="mt-3 text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ __('Reload') }} {{ $id }}
                        </h3>
                        <div class="mt-2">
                            <div class="mt-10 text-gray-700">
                                {{ __('Are you sure?')}}
                            </div>
                            <div class="mt-10 flex justify-center">
                                <span class="mr-2">
                                    <button x-on:click="open = false" x-bind:disabled="working"
                                        class="w-32 shadow-sm inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:border-gray-700 focus:shadow-outline-teal active:bg-gray-700 transition ease-in-out duration-150">
                                        {{ __('No')}}
                                    </button>
                                </span>
                                <span x-on:click="working = !working">
                                    <button @click="open = false" wire:click="reload({{ $id }})"
                                        wire:loading.attr="disabled"
                                        class="w-32 shadow-sm inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-teal active:bg-red-700 transition ease-in-out duration-150">
                                        {{ __('Yes')}}
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endif

</div>