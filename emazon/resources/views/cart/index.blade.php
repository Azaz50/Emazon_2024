@extends('template.base')

@section('content')
    <section class="items-center py-24 bg-gray-50 font-poppins dark:bg-slate-600">
        <div class="justify-center flex-1 max-w-6xl px-4 py-6 mx-auto lg:py-4 md:px-6">
            <h2 class="mb-10 text-4xl font-bold text-center dark:text-gray-400">Your Cart</h2>
            <div class="mb-10">
                {{-- @php dd($_POST) @endphp --}}

                @foreach ($cart_items as $ci)
                    <div
                        class="relative flex flex-wrap items-center pb-8 mb-8 -mx-4 border-b border-gray-200 dark:border-gray-500 xl:justify-between border-opacity-40">
                        <div class="w-full mb-4 md:mb-0 h-96 md:h-44 md:w-56">
                            <img src="{{ $ci->product->image_url }}" alt=" {{ $ci->product->title }}"
                                class="object-cover w-full h-full">
                        </div>
                        <div class="w-full px-4 mb-6 md:w-96 xl:mb-0">
                            <a class="block mb-5 text-xl font-medium dark:text-gray-400 hover:underline" href="#">

                                {{ $ci->product->title }}</a>
                            <div class="flex flex-wrap">
                                <p class="mr-4 text-sm font-medium">
                                    <span class="dark:text-gray-400">Color:</span>
                                    <span class="ml-2 text-gray-400 dark:text-gray-400">{{ $ci->color->color }}</span>
                                </p>
                                <p class="text-sm font-medium dark:text-gray-400">
                                    <span>Size:</span>
                                    <span class="ml-2 text-gray-400">{{ $ci->size->size }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="w-full px-4 mt-6 mb-6 xl:w-auto xl:mb-0 xl:mt-0">
                            <div class="flex items-center">
                                <h2 class="mr-4 font-medium dark:text-gray-400">Qty: {{ $ci->qty }}</h2>
                                <div
                                    class="inline-flex items-center px-4 font-semibold text-gray-500 border border-gray-300 rounded-md dark:bg-gray-800 dark:border-gray-700 ">
                                    <button
                                        class="py-2 pr-2 border-r border-gray-300 dark:border-gray-600 dark:text-gray-400 hover:text-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z">
                                            </path>
                                        </svg>
                                    </button>
                                    <input type="number"
                                        class="w-12 px-2 py-4 text-center border-0 rounded-md dark:bg-gray-800 bg-gray-50 dark:text-gray-400"
                                        placeholder="1">
                                    <button
                                        class="py-2 pl-2 border-l border-gray-300 dark:border-gray-600 hover:text-gray-700 dark:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path
                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('cart.remove', [($id = $ci->id)]) }}" method="post" class="mt-10">
                            @csrf
                            @method('DELETE')
                            {{-- <input type="hidden" name="_method" value="delete"> --}}
                            <div class="w-full px-4 mb-6 xl:w-auto xl:mb-0 xl:mt-0">
                                <button
                                    class="inline-block px-8 py-4 font-bold text-white uppercase bg-blue-500 rounded-md hover:bg-blue-600">Remove</button>
                            </div>
                        </form>
                        <div class="w-full px-4 xl:w-auto">
                            <span class="text-xl font-medium text-blue-500 dark:text-blue-400">
                                <span class="text-sm">&#x20B9</span>
                                <span>{{ $ci->product->price_sp }}</span>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>


            <div class="mb-10">
                <div class="px-10 py-3 bg-gray-100 rounded-md dark:bg-gray-800">
                    <div class="flex justify-between dark:text-gray-400">
                        <span class="font-medium">Gross Total</span>
                        <span class="font-bold ">&#x20B9;{{ number_format($order->gross_total) }}</span>
                    </div>
                </div>
                <div class="px-10 py-3 rounded-md">
                    <div class="flex justify-between dark:text-gray-400">
                        <span class="font-medium">Sub Total</span>
                        <span class="font-bold ">&#x20B9;{{ number_format($order->sub_total) }}</span>
                    </div>
                </div>
                <div class="px-10 py-3 bg-gray-100 rounded-md dark:bg-gray-800">
                    <div class="flex justify-between dark:text-gray-400">
                        <span class="font-medium">Discount</span>
                        <span class="font-bold ">&#x20B9;{{ number_format($order->discount) }}</span>
                    </div>
                </div>
                <div class="px-10 py-3 rounded-full dark:text-gray-400">
                    <div class="flex justify-between">
                        <span class="text-base font-bold md:text-xl ">Total</span>
                        <span class="font-bold ">&#x20B9;{{ number_format($order->amount) }}</span>
                    </div>
                </div>
            </div>



            <div class="text-right">
                <span
                    class="inline-block w-full px-8 py-4 mb-4 mr-6 font-bold text-center uppercase transition duration-200 bg-gray-100 border rounded-md dark:hover:bg-gray-900 dark:text-gray-400 dark:border-gray-800 dark:bg-gray-800 md:mb-0 md:w-auto hover:bg-gray-200 ">
                    @if (!is_null($cart->coupon_id))
                        <div>{{ $cart->coupon->coupon }}</div>
                        <form action="/cart/remove-coupon" method="POST">
                            @csrf
                            <button
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-500 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                class="button">remove coupon</button>
                        </form>
                    @else
                        <form action="{{ route('cart.apply-coupon') }}" method="post">
                            @csrf

                            {{-- <div class="container bg-gradient-to-r from-indigo-500 to-violet-500 text-white p-8 rounded-lg shadow-lg max-w-md mx-auto">
                <div class="text-3xl font-bold mb-4">Special Offer!</div>
                <div class="text-lg mb-4">Get <span class="text-yellow-400 font-bold"> OFF</span> your next purchase!</div>
                <div class="text-base mb-4">Use coupon code:</div>
                <div class="bg-white text-gray-800 rounded-lg px-4 py-2 flex items-center justify-between">
                    <span class="text-2xl font-semibold">TAILOFFER25</span>
                    <button class="bg-blue-800 text-white px-3 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Copy</button>
                </div>
                <div class="text-sm mt-4">
                    <p>Valid until <span class="font-semibold">December 31, 2023</span></p>
                    <p>Terms and conditions apply.</p>
                </div>
                
                 </div>     --}}

                            <br>
                            <input type="text" name="coupon">
                            <button
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-500 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                type="submit">Apply</button>
                        </form>
                    @endif
                </span>
                <form action="{{ route('order.store') }}" method="post" class="mt-6">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                        Place Order
                    </button>
                </form>


            </div>
        </div>
    </section>
@endSection
