@extends('template.base')

@section('content')
    <section class="relative overflow-hidden dark:bg-slate-600">
        <div class="container px-4 mx-auto m-14">
            <div class="flex flex-wrap items-center -mx-4">
                <div class="w-auto px-4 mb-4 text-center ">
                    <a class="hidden p-2 bg-blue-600 rounded-full dark:bg-blue-500 xl:mb-0 hover:bg-blue-700 lg:inline-block text-gray-50"
                        href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="w-4 h-4 bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                            </path>
                        </svg>
                    </a>
                </div>
                <div class="w-full px-4 lg:w-2/5">
                    <div class=" lg:max-w-xl">
                        <h1 class="mb-6 text-4xl font-bold dark:text-gray-300 lg:text-6xl">
                            <span>Welcome to </span>
                            <span class="text-blue-600 dark:text-blue-400">Emazon</span>
                            <span>Shoping Site</span>
                        </h1>
                        <p class="mb-6 leading-8 text-gray-500 dark:text-gray-400">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua.sit amet, consectetur adipiscing elit, sed do Ut
                            enim ad minim veniam
                        </p>
                        <a class="inline-block w-full px-6 py-4 mb-2 text-lg font-medium leading-6 text-center text-white transition duration-200 bg-blue-600 rounded shadow dark:bg-blue-500 dark:hover:bg-blue-700 md:w-auto md:mb-0 md:mr-4 hover:bg-blue-700"
                            href="{{ Route('product.index') }}">
                            Get Stared
                        </a>
                    </div>
                </div>
                <div class="w-full px-4 mt-20 lg:w-2/5 lg:mt-0">
                    <div class="flex justify-center lg:justify-end">
                        <div class="mr-4 lg:mr-8">
                            <img class="block object-cover w-full h-32 mx-auto mb-8 rounded-md sm:h-64"
                                src="https://images.unsplash.com/photo-1525562723836-dca67a71d5f1?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="">
                            <img class="block object-cover w-full h-32 mx-auto mb-8 rounded-md sm:h-64"
                                src="https://images.unsplash.com/photo-1516762689617-e1cffcef479d?q=80&w=2022&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="">
                        </div>
                        <div>
                            <img class="block object-cover w-full h-32 mx-auto mb-8 rounded-md sm:h-64"
                                src="https://images.unsplash.com/photo-1560243563-062bfc001d68?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="">
                            <img class="block object-cover w-full h-32 mx-auto mb-8 rounded-md sm:h-64"
                                src="https://images.unsplash.com/photo-1479064555552-3ef4979f8908?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="w-auto px-4 mb-4 text-center xl:mb-0">
                    <a class="hidden p-2 bg-blue-600 rounded-full dark:bg-blue-500 hover:bg-blue-700 lg:inline-block text-gray-50"
                        href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-chevron-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </section>

    <section class="flex items-center py-10 dark:bg-slate-600">

        <div class="px-16 mx-auto">
            <div class="grid grid-cols-2 gap-4 lg:gap-0 sm:gap-4 sm:grid-cols-3 lg:grid-cols-6">

                @foreach ($products as $p)
                    <div class="p-8 border-t border-b border-r first:border-l dark:border-gray-500 dark:bg-gray-900">
                        <div class="relative">
                            <a class="block" href="/products/{{ $p->slug }}">
                                <img src="{{ $p->image_url }}" class="object-cover w-full h-64 rounded text-white"
                                    alt="{{ $p->title }}">
                            </a>
                        </div>
                        <div class="pt-6">

                            <a class="">
                                <p class="mb-2 text-lg font-bold text-black dark:text-gray-400"><span
                                        class="text-xl font-bold text-black dark:text-gray-300">&#8377;&nbsp;{{ $p->price_sp }}
                                        <!-- -->
                                    </span></p>
                                <p class="text-gray-500">
                                    {{ $p->title }}
                                </p>
                            </a>

                            <div class="relative flex items-center justify-between"></div>
                        </div>
                    </div>
                @endforeach




            </div>
        </div>

    </section>
@endSection
