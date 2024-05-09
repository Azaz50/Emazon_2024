@extends('template.base')

@section('content')
    <section class="shadow-lg font-poppins white:bg-gray-800 dark:bg-slate-600">
        <div class="max-w-6xl px-4 mx-auto" x-data="{ open: false }">
            <nav class="flex items-center justify-between py-4">

                <form class="d-flex" role="search">
                    <input
                        class="inline-block w-full px-8 py-4 mb-4 mr-6 font-bold uppercase transition duration-200 bg-gray-100 border rounded-md dark:hover:bg-gray-900 dark:text-gray-400 dark:border-gray-800 dark:bg-gray-800 md:mb-0 md:w-auto hover:bg-gray-200 "
                        name="q" value="{{ request('q') }}" type="search" placeholder="Search" aria-label="Search">
                    <select
                        class="inline-block w-full px-8 py-4 mb-4 mr-6 font-bold text-center uppercase transition duration-200 bg-gray-100 border rounded-md dark:hover:bg-gray-900 dark:text-gray-400 dark:border-gray-800 dark:bg-gray-800 md:mb-0 md:w-auto hover:bg-gray-200 "
                        name="category_id">
                        <option value="0" disabled selected>Category</option>
                        @foreach ($categories as $c)
                            <option value=" {{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}

                            </option>
                        @endforeach
                    </select>
                    <select
                        class="inline-block w-full px-8 py-4 mb-4 mr-6 font-bold text-center uppercase transition duration-200 bg-gray-100 border rounded-md dark:hover:bg-gray-900 dark:text-gray-400 dark:border-gray-800 dark:bg-gray-800 md:mb-0 md:w-auto hover:bg-gray-200 "
                        name="price_order">
                        <option value="0" disabled selected>Sort by price</option>
                        <option value="1" {{ request('price_order') == 1 ? 'selected' : '' }}> Low to high</option>
                        <option value="2" {{ request('price_order') == 2 ? 'selected' : '' }}> High to low</option>
                    </select>


                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-500 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        type="submit">Apply</button>
                </form>




            </nav>

        </div>
    </section>







    <section class="flex items-center py-10 dark:bg-slate-600">

        <div class="px-16 mx-auto">
            <div class="grid grid-cols-2 gap-4 lg:gap-7 sm:gap-4 sm:grid-cols-3 lg:grid-cols-4">

                @foreach ($products as $p)
                    <form action="/cart/store" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $p->id }}">
                        <div
                            class="p-8 mb-6 border-t border-b border-r first:border-l dark:border-gray-500 dark:bg-gray-900 hover:bg-gray-800">
                            <div class="relative">
                                <a class="block" href="/products/{{ $p->slug }}">
                                    <img src="{{ $p->image_url }}"
                                        class="object-cover w-full h-64 rounded text-white dark:text-white"
                                        alt="{{ $p->title }}">
                                </a>
                            </div>
                            <div class="pt-6">

                                <a class="">
                                    <p class="mb-2 text-lg font-bold text-black dark:text-gray-400"><span
                                            class="text-3xl font-bold text-black dark:text-gray-300">&#8377;&nbsp;{{ $p->price_sp }}
                                            <sup class="line-through mx-2">&#8377;{{ $p->price_mp }}</sup< /p> <!-- -->
                                        </span></p>
                                    <!-- <p class="line-through mb-2 text-lg font-bold text-black dark:text-gray-400"><span
                                                                                                                            class="text-xl font-bold text-black dark:text-gray-300">&#8377;&nbsp;{{ $p->price_mp }}                                    <!-- -->
                                    </span></p> -->
                                    <p class="text-gray-500">
                                        {{ $p->title }}
                                    </p>
                                </a>

                                <div class="relative flex items-center justify-between"></div>
                            </div>
                        </div>
                    </form>
                @endforeach




            </div>
        </div>

    </section>


    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <a href="#"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
            <a href="#"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">

            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <a href="{{ route('product.index') }}?page={{ $products->currentPage() < 2 ? 1 : $products->currentPage() - 1 }}"
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->

                    @for ($i = 0; $i < $products->lastPage(); ++$i)
                        @if ($i + 1 == $products->currentPage())
                            <a href="{{ route('product.index') }}?page={{ $i + 1 }}" aria-current="page"
                                class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                {{ $i + 1 }}
                            </a>
                        @else
                            <a href="{{ route('product.index') }}?page={{ $i + 1 }}"
                                class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                {{ $i + 1 }}
                            </a>
                        @endif
                    @endfor

                    <a href="{{ route('product.index') }}?page={{ $products->currentPage() < $products->lastPage() ? $products->currentPage() + 1 : $products->lastPage() }}"
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>
@endSection
