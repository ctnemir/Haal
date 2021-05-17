<x-app-layout title="Order Create">
    <div class="container grid px-6 mx-auto">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Order Create
            </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form action="{{route('calc')}}" method="get">
                @csrf
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Quantity</span>
                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                        focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                        dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        name="quantity"
                         />
                </label>

                <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Select Item
                </span>
                    <select name="kind_id" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                        @foreach(\App\Models\Kind::all() as $kind)
                            <option value="{{$kind->id}}" >{{$kind->name}}</option>
                        @endforeach
                    </select>
                </label>
                <button type="submit">Gönder</button>
            </form>
        </div>
    </div>


</x-app-layout>
