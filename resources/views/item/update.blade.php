<x-app-layout title="Item Request">
    <div class="mb-5 p-8 flex content-center text-gray-900 dark:text-white  flex-row w-full bg-indigo-400 dark:bg-indigo-800">
        <div class="mb-5 p-8 flex content-center text-gray-900 dark:text-white  flex-row w-full bg-indigo-400 dark:bg-indigo-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-3 font-bold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            <h2 class="text-2xl font-semibold inline-block">
                Item Update
            </h2>
        </div>
    </div>
    <div class="container grid px-6 mx-auto">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form method="post" action="{{route('item.update',[$data->id])}}">
                @csrf
                @method('PUT')
                <label class="block  mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Quantity</span>
                    <input
                        value="{{$data->quantity}}"
                        type="number" step="0.01"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                        focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                        dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="quantity" placeholder="Kilograms"/>
                </label>
                <label class="block  mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Price</span>
                    <input
                        value="{{$data->price}}"
                        type="number" step="0.01"
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                        focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                        dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="price" placeholder="₺"/>
                </label>
                <label class="block mt-4 text-sm">
                    <button class="px-4 py-2 text-sm font-medium leading-5 text-white
                    transition-colors duration-150 bg-purple-600 border border-transparent
                    rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                            type="submit"
                    >
                        Request
                    </button>
                </label>
            </form>
        </div>
    </div>


</x-app-layout>
