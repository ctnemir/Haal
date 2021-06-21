<x-app-layout title="Shop">
    <div class="mb-5 p-8 flex content-center text-gray-900 dark:text-white  flex-row w-full bg-indigo-400 dark:bg-indigo-800">
        <div class="mb-5 p-8 flex content-center text-gray-900 dark:text-white  flex-row w-full bg-indigo-400 dark:bg-indigo-800">
            <svg xmlns="http://www.w3.org/2000/svg"  class="w-8 h-8 mr-3 font-bold"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h2 class="text-2xl font-semibold inline-block">
                Shop
            </h2>
        </div>
    </div>
    <div class="container grid px-6 mx-auto">
    <!-- Cards -->
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Total Kind
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        {{\App\Models\Kind::all()->count()}}
                    </p>
                </div>
            </div>
            <!-- Card -->
            {{--<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Account balance
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        ₺ {{\App\Models\User::all()->sum('moneyRequest')}}
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        New sales
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        376
                    </p>
                </div>
            </div>
            <!-- Card -->
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Pending contacts
                    </p>
                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        35
                    </p>
                </div>
            </div>
            --}}
        </div>

        <!-- Items -->
        <div id="ItemsDiv" class="w-full overflow-hidden rounded-lg shadow-xs">
            <div class="grid gap-6 mb-8 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-6">
                    @foreach($data as $kind)
                        @if($kind->sum('quantity') > 0)
                    <div class="flex shadow flex-col items-start bg-white rounded-lg shadow-xs dark:bg-gray-800">
                        <div class="item flex-none w-full">
                            <img class="object-cover w-full" src="https://ui-avatars.com/api/?name={{urlencode($kind->first()->getKind->name)}}&color=7F9CF5&background=EBF4FF" alt="">
                        </div>
                        <div class="pl-3 item">
                            <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                {{$kind->first()->getKind->name}}
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{$kind->min('price')}}
                                <span class="font-light text-xs">(Min Price)</span>
                            </p>
                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                {{$kind->sum('quantity')}}
                                <span class="font-light text-xs">(Avaible Quantity)</span>
                            </p>
                        </div>
                        <div data-id="{{$kind->first()->kind_id}}" class="priceCalc hidden p-4 w-full flex-col items-start bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <label id="new_kind_label" class="mt-4 text-sm">

                                <div  data-id="{{$kind->first()->kind_id}}" class="flex flex-col">
                                    <span class="text-gray-700 dark:text-gray-400">Quantity</span>
                                    {{--<div class="flex flex-row mb-2">
                                        <input type="number" step="0.01"
                                               class="block p-0 priceCalcInput w-9/12 m-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                    focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                                    dark:text-gray-300 dark:focus:shadow-outline-gray form-input" autofocus/>

                                        <button class=" px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </button>
                                    </div>--}}
                                    <div class="relative text-gray-500 focus-within:text-purple-600">
                                        <input name="quantity" class="priceCalcInput block w-full pr-20 text-sm text-black
                                        dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400
                                        focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                                        type="number"/>
                                        <button class="orderCreate absolute inset-y-0 right-0 px-2 text-xs font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-r-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </div>
                                    <span class="text-gray-700 dark:text-gray-400">Price</span>
                                    <div class="flex flex-row mb-2">
                                        <input type="number" step="0.01"
                                               class="block form-input bg-purple-100 p-0 priceInput w-full m-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                    focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                                    dark:text-gray-300 dark:focus:shadow-outline-gray " name="quantity" placeholder="Optional" autofocus/>
                                    </div>
                                </div>
                                <span class="calcResult ml-1 py-2 px-4 rounded text-gray-700 dark:text-gray-100 bg-indigo-200 dark:bg-indigo-800">...</span>

                            </label>
                        </div>
                    </div>
                        @endif
                    @endforeach
                </div>
            </div>
        {{--
            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                <!-- Pagination -->
                <span class="flex col-span-2 mt-2 sm:mt-auto sm:justify-start">
                    <nav aria-label="Table navigation">
                        <ul class="inline-flex items-center">
                            <li>
                                <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous"
                                        @if ($data->onFirstPage())
                                        disabled
                                        @else
                                        @click="window.location='{{ $data->previousPageUrl() }}'"
                        @endif
                                >
                                    <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </li>

                <li>
                    <button
                        class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                        aria-label="Next"

                        @if (!$data->hasMorePages())
                        disabled
                        @else
                        @click="window.location='{{ $data->nextPageUrl() }}'"
                        @endif
                    >
                        <svg class="w-4 h-4 fill-current" aria-hidden="true"
                             viewBox="0 0 20 20">
                            <path
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </li>
                        </ul>
                    </nav>
                </span>
                <span class="flex items-center col-span-7 sm:justify-end">
                    {!! __('Showing') !!}
                    {{ $data->firstItem() }}-{{ $data->lastItem() }}
                    {!! __('of') !!}
                    {{ $data->total() }}
                </span>

            </div>
            --}}
        </div>


</x-app-layout>
