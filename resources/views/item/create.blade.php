<x-app-layout title="Item Request">
    <div class="container grid px-6 mx-auto">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <form method="post" action="{{route('confirmItem.store')}}">
                @csrf
                <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Select Item
                </span>
                    <select class="block w-full my-1 text-sm dark:text-gray-300 dark:border-gray-600
                    dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none
                    focus:shadow-outline-purple dark:focus:shadow-outline-gray" id="kind" name="kind">
                        <option value="0">Select a item</option>
                        @foreach(\Illuminate\Support\Facades\DB::table('kinds')->get() as $kind)
                            <option value="{{$kind->id}}">{{$kind->name}}</option>
                        @endforeach
                    </select>
                    <a onclick="document.getElementById('new_kind_label').classList.remove('hidden');
                                document.getElementById('new_kind_label').classList.add('block');
                                this.classList.add('hidden');
                                document.getElementById('kind').blur();
                                document.getElementById('new_kind').focus();"
                       class=" ml-1 mt-1 text-gray-700 dark:text-gray-400 hover:underline">
                    İf you didn't find your item click here.
                </a>
                </label>

                <label id="new_kind_label" class="hidden mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">New Item Name</span>
                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                        focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                        dark:text-gray-300 dark:focus:shadow-outline-gray form-input" id="new_kind" name="new_kind" autofocus/>
                    <span class="mt-1 text-gray-700 dark:text-gray-500">When you insert here a not exist item name, you will on a new item name request.</span>

                </label>

                <label class="block  mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Quantity</span>
                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                        focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                        dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="quantity" placeholder="Kilograms"/>
                </label>
                <label class="block  mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Price</span>
                    <input
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
