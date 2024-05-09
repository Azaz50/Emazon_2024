@extends('template.base')

@section('content')
    <!--
                                                  This example requires some changes to your config:
                                                  
                                                  ```
                                                  // tailwind.config.js
                                                  module.exports = {
                                                    // ...
                                                    theme: {
                                                      extend: {
                                                        gridTemplateRows: {
                                                          '[auto,auto,1fr]': 'auto auto 1fr',
                                                        },
                                                      },
                                                    },
                                                    plugins: [
                                                      // ...
                                                      require('@tailwindcss/aspect-ratio'),
                                                    ],
                                                  }
                                                  ```
                                                -->
    <div class="dark:bg-slate-600">
        <div class="pt-6">
            <nav aria-label="Breadcrumb">
                <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">

                    <li class="text-sm">
                        <a href="#" aria-current="page"
                            class="font-medium text-white hover:text-gray-600">{{ $product->title }}</a>
                    </li>
                </ol>
            </nav>

            <!-- Image gallery -->
            <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-5xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
                <div class="aspect-h-4 aspect-w-3 hidden overflow-hidden rounded-lg lg:block">
                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}"
                        class="h-full w-full object-cover object-center">
                </div>
                <div class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8">
                    <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
                        <img src="{{ $product->image_url }}" alt="{{ $product->title }}"
                            class="h-full w-full object-cover object-center">
                    </div>
                    <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
                        <img src="{{ $product->image_url }}" alt="{{ $product->title }}"
                            class="h-full w-full object-cover object-center">
                    </div>
                </div>
                <div class="aspect-h-5 aspect-w-4 lg:aspect-h-4 lg:aspect-w-3 sm:overflow-hidden sm:rounded-lg">
                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}"
                        class="h-full w-full object-cover object-center">
                </div>
            </div>

            <!-- Product info -->
            <div
                class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-2">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl tracking-tight text-white">&#8377;{{ $product->price_sp }} <sup
                            class="line-through mx-2">&#8377;{{ $product->price_mp }}</sup< /p>
                            <!-- <div class=" line-through text-xl tracking-tight text-gray-900">&#8377;&nbsp;{{ $product->price_mp }} </div> -->

                            <!-- Reviews -->
                            <div class="mt-6">
                                <h3 class="sr-only">Reviews</h3>
                                <div class="flex items-center">
                                    <div class="flex items-center">
                                        <!-- Active: "text-gray-900", Default: "text-gray-200" -->
                                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <svg class="text-gray-900 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <svg class="text-gray-200 h-5 w-5 flex-shrink-0" viewBox="0 0 20 20"
                                            fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="sr-only">4 out of 5 stars</p>
                                    <a href="#" class="ml-3 text-sm font-medium text-white hover:text-indigo-500">117
                                        reviews</a>
                                </div>
                            </div>

                            <form action="{{ route('cart.store') }}" method="post" class="mt-10">
                                @csrf
                                <!-- Colors -->
                                <div>
                                    <h3 class="text-sm font-medium text-white">Color</h3>

                                    <fieldset class="mt-4">
                                        <legend class="sr-only">Choose a color</legend>
                                        <div class="flex items-center space-x-3">

                                            <!--
                                                                  Active and Checked: "ring ring-offset-1"
                                                                  Not Active and Checked: "ring-2"
                                                                -->
                                            @foreach ($colors as $c)
                                                <label
                                                    class="hover:scale-125 relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:ring-1 focus:ring-offset-1">
                                                    <input type="radio" name="color_id" value="{{ $c->id }}"
                                                        class="sr-only" aria-labelledby="color-choice-0-label">
                                                    <span id="color-choice-0-label"
                                                        class="sr-only">{{ $c->color }}</span>
                                                    <span aria-hidden="true"
                                                        class="h-8 w-8 rounded-full border border-black border-opacity-10"
                                                        style="background-color: #{{ $c->code }}"></span>
                                                </label>
                                            @endforeach

                                        </div>
                                    </fieldset>
                                </div>

                                <!-- Sizes -->
                                <div class="mt-10">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-medium text-white">Size</h3>

                                    </div>

                                    <fieldset class="mt-4">
                                        <legend class="sr-only">Choose a size</legend>
                                        <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">



                                            <!-- Active: "ring-2 ring-indigo-500" -->
                                            @foreach ($sizes as $s)
                                                <label
                                                    class="group relative flex items-center justify-center rounded-md border py-3 px-4 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 cursor-pointer bg-white text-gray-900 shadow-sm">
                                                    <input type="radio" name="size_id" value="{{ $s->id }}"
                                                        class="sr-only" aria-labelledby="size-choice-1-label">
                                                    <span id="size-choice-1-label"
                                                        class="hover:scale-150">{{ $s->size }}</span>
                                                    <!--
                                                                    Active: "border", Not Active: "border-2"
                                                                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                                                                  -->
                                                    <span class="pointer-events-none absolute -inset-px rounded-md"
                                                        aria-hidden="true"></span>
                                                </label>
                                            @endforeach

                                        </div>
                                    </fieldset>
                                </div>

                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="qty" value="1">

                                <button type="submit"
                                    class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add
                                    to bag</button>
                            </form>
                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                    <!-- Description and details -->
                    <h1 class="text-white">Description and details:</h>
                        <div>


                            <div class="space-y-6">

                                <p class="text-base text-white">{{ $product->description }}</p>
                            </div>
                        </div>




                </div>
            </div>
        </div>
    </div>
@endSection
