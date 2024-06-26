<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emazon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="shadow-lg font-poppins dark:bg-gray-800">
        <div class="max-w-6xl px-4 mx-auto" x-data="{ open: false }">
            <nav class="flex items-center justify-between py-4">
                <a href="{{ Route('home.index') }}"
                    class="text-3xl font-semibold leading-none text-blue-600 dark:text-blue-400">

                    Emazon</a>
                <div class="flex lg:hidden">
                    <button
                        class="flex items-center px-3 py-2 text-blue-600 border border-blue-200 rounded dark:text-gray-400 hover:text-blue-800 hover:border-blue-300 lg:hidden"
                        @click="open =true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                        </svg>
                    </button>
                </div>
                <ul class="hidden lg:w-auto lg:space-x-12 lg:items-center lg:flex ">
                    <li><a href="{{ Route('home.index') }}"
                            class="text-sm text-gray-700 hover:text-blue-700 dark:text-gray-400 dark:hover:text-blue-500">Home</a>
                    </li>
                    <li><a href="{{ Route('product.index') }}"
                            class="text-sm text-gray-700 hover:text-blue-700 dark:text-gray-400 dark:hover:text-blue-500">Products</a>
                    </li>
                    <li><a href=""
                            class="text-sm text-gray-700 hover:text-blue-700 dark:text-gray-400 dark:hover:text-blue-500">About
                            us</a>
                    </li>
                    <li><a href=""
                            class="text-sm text-gray-700 hover:text-blue-700 dark:text-gray-400 dark:hover:text-blue-500">Features</a>
                    </li>

                </ul>
                <div class="items-center hidden pl-2 ml-auto mr-8 lg:flex lg:ml-0 lg:mr-0 gap-8">


                    @if (auth()->check())
                        <a href="/profile"
                            class="text-sm font-semibold leading-6 text-gray-400 ">{{ auth()->user()->first_name }}</a>
                        <a href="/carts" class="text-sm font-semibold leading-6 text-gray-400">Cart</a>
                        <form action="{{ route('auth.logout') }}" method="post">
                            @csrf
                            <button type="submit" href="{{ route('auth.logout') }}"
                                class="text-sm font-semibold leading-6 text-gray-400">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('auth.login') }}" class="text-sm font-semibold leading-6 text-gray-400">Log in
                            <span aria-hidden="true">&rarr;</span></a>
                    @endif
                </div>
            </nav>
            <!-- Mobile Sidebar -->
            <div class="fixed inset-0 w-full bg-gray-800 opacity-25 dark:bg-gray-400 lg:hidden"
                :class="{
                    'translate-x-0 ease-in-opacity-100': open === true,
                    '-translate-x-full ease-out opacity-0': open ===
                        false
                }">
            </div>
            <div class="absolute inset-0 z-10 h-screen p-3 text-gray-700 duration-500 transform shadow-md dark:bg-gray-800 bg-blue-50 w-80 lg:hidden lg:transform-none lg:relative"
                :class="{
                    'translate-x-0 ease-in-opacity-100': open === true,
                    '-translate-x-full ease-out opacity-0': open ===
                        false
                }">
                <div class="flex justify-between px-5 py-2">
                    <a class="text-2xl font-bold dark:text-gray-400" href="#">Logo</a>
                    <button class="rounded-md hover:text-blue-300 lg:hidden dark:text-gray-400" @click="open=false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                    </button>
                </div>

                <ul class="px-5 text-left mt-7">
                    <li class="pb-3">
                        <a href="" class="text-sm text-gray-700 hover:text-blue-400 dark:text-gray-400">Home</a>
                    </li>
                    <li class="pb-3">
                        <a href="" class="text-sm text-gray-700 hover:text-blue-400 dark:text-gray-400">About
                            us</a>
                    </li>
                    <li class="pb-3">
                        <a href=""
                            class="text-sm text-gray-700 hover:text-blue-400 dark:text-gray-400">Features</a>
                    </li>
                    <li class="pb-3">
                        <a href="" class="text-sm text-gray-700 hover:text-blue-400 dark:text-gray-400">Blog </a>
                    </li>
                    <li class="pb-3">
                        <a href=""
                            class="text-sm text-gray-700 hover:text-blue-400 dark:text-gray-400">Testimonials</a>
                    </li>
                </ul>
                <div class="flex items-center lg:hidden mt-7">
                    <div class="flex px-6 py-2 border border-gray-700 rounded-full dark:border-gray-400">
                        <input type="text"
                            class="w-full pr-4 text-sm text-gray-700 bg-blue-50 dark:text-gray-400 dark:bg-gray-800 placeholder-text-100 "
                            placeholder="search...">
                        <button
                            class="flex items-center text-gray-700 dark:text-gray-400 dark:hover:text-blue-500 hover:text-blue-700">
                            <span class="mr-1 ml-2">Go</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @yield('content')

    <section class="flex flex-col relative bottom-0 w-full">
        <div class="relative mb-auto py-10 bg-center bg-no-repeat bg-cover"
            style="background-image:url('https://i.postimg.cc/DwppyZZP/mypic3.jpg');">
            <div class="absolute top-0 left-0 w-full h-full bg-gray-900 bg-opacity-60"></div>
            <div class="relative z-10 justify-center flex-1 max-w-6xl px-4 py-4 mx-auto lg:py-0">
                <div class="flex flex-wrap pb-10 -mx-3">
                    <div class="w-full px-4 mb-11 md:w-1/2 lg:w-4/12 lg:mb-0">
                        <a href="#" class="inline-block pb-2 text-lg font-bold text-gray-300">About Company</a>
                        <div class="w-16 mb-4 border-b-2 border-gray-300 "></div>
                        <p class="text-base font-normal leading-6 text-gray-400 lg:w-64">
                            Lorem ipsum dor amet Lorem ipsum dor amet Lorem ipsum dor amet Lorem ipsum dor ame </p>
                    </div>
                    <div class="w-full px-4 md:w-1/4 lg:w-2/12 mb-11 lg:mb-0">
                        <h2 class="pb-2 text-lg font-bold text-gray-300 ">Quick Links</h2>
                        <div class="w-16 mb-4 border-b-2 border-gray-300 "></div>
                        <ul>
                            <li class="mb-4">
                                <a href="#" class="inline-block text-base font-normal text-gray-400 ">Home</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="inline-block text-base font-normal text-gray-400 ">
                                    About Us</a>
                            </li>
                            <li class="mb-4">
                                <a href="#"
                                    class="inline-block text-base font-normal text-gray-400 dark:text-gray-400">Features</a>
                            </li>
                        </ul>
                    </div>
                    <div class="w-full px-4 mb-11 lg:mb-0 md:w-1/4 lg:w-2/12">
                        <h2 class="pb-2 text-lg font-bold text-gray-300">
                            Features </h2>
                        <div class="w-16 mb-4 border-b-2 border-gray-300 "></div>
                        <ul>
                            <li class="mb-4">
                                <a href="#" class="inline-block text-base font-normal text-gray-400">Home</a>
                            </li>
                            <li class="mb-4">
                                <a href="#" class="inline-block text-base font-normal text-gray-400">
                                    About Us</a>
                            </li>
                            <li class="mb-4">
                                <a href="#"
                                    class="inline-block text-base font-normal text-gray-400">Features</a>
                            </li>
                        </ul>
                    </div>
                    <div class="w-full px-4 mb-11 lg:mb-0 md:w-1/3 lg:w-3/12">
                        <h2 class="pb-2 text-lg font-bold text-gray-300 ">
                            Stay Connected</h2>
                        <div class="w-16 mb-4 border-b-2 border-gray-300 "></div>
                        <div class="flex justify-start mt-4 ">
                            <a href="#" type="button"
                                class="m-1 leading-normal text-gray-300 uppercase transition duration-150 ease-in-out border-2 border-gray-400 rounded-full dark:border-gray-400 dark:hover:bg-gray-800 hover:border-blue-600 hover:bg-blue-800 w-9 h-9">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor"
                                    class="w-4 h-full mx-auto text-gray-300 dark:text-gray-400 bi bi-facebook"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                </svg>
                            </a>
                            <a href="#" type="button"
                                class="m-1 leading-normal text-gray-300 uppercase transition duration-150 ease-in-out border-2 border-gray-400 rounded-full dark:border-gray-400 dark:text-gray-400 dark:hover:bg-gray-800 hover:border-blue-600 hover:bg-blue-600 w-9 h-9">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor"
                                    class="w-4 h-full mx-auto text-gray-300 dark:text-gray-400 bi bi-twitter"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                </svg>
                            </a>
                            <a href="#" type="button"
                                class="m-1 leading-normal text-gray-300 uppercase transition duration-150 ease-in-out border-2 border-gray-400 rounded-full dark:border-gray-400 dark:text-gray-400 dark:hover:bg-gray-800 hover:border-blue-600 text-text-gray-50 hover:bg-blue-600 w-9 h-9">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor"
                                    class="w-4 h-full mx-auto text-gray-100 dark:text-gray-400 bi bi-google"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                                </svg>
                            </a>
                            <a href="#" type="button"
                                class="m-1 leading-normal text-gray-400 uppercase transition duration-150 ease-in-out border-2 border-gray-400 rounded-full dark:border-gray-400 dark:text-gray-400 dark:hover:bg-gray-800 hover:border-blue-600 hover:bg-blue-600 w-9 h-9">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor"
                                    class="w-4 h-full mx-auto text-gray-300 dark:text-gray-400 bi bi-linkedin"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pt-4 text-center text-gray-300 dark:text-gray-400">
                    <span>© Copyright 2022 . All Rights Reserved</span>
                </div>
            </div>
    </section>


    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
