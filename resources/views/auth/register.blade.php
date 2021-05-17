<x-guest-layout title="Register">
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="flex justify-center h-32 md:h-auto md:w-1/2">
                    <svg class="w-6/12 h-6/12 relative top-3/12" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 349.11 468.91"><defs><style>.cls-1{fill:url(#Unbenannter_Verlauf_13);}.cls-2{fill:#4c4394;}</style><linearGradient id="Unbenannter_Verlauf_13" x1="174.56" y1="349.11" x2="174.56" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#4c4394"/><stop offset="1" stop-color="#3b57a3"/></linearGradient></defs><g id="Layer_2" data-name="Layer 2"><g id="Ebene_1" data-name="Ebene 1"><path class="cls-1" d="M349.11,77.58a77.58,77.58,0,0,0-155.16,0V168a12.93,12.93,0,0,0,25.86,0V77.58a51.72,51.72,0,0,1,103.44,0V220a77.24,77.24,0,0,0-51.72-19.81H77.58A77.28,77.28,0,0,0,25.86,220V77.58a51.72,51.72,0,0,1,103.44,0V168a12.93,12.93,0,0,0,25.86,0V77.58A77.58,77.58,0,0,0,0,77.58v194c0,1.05,0,2.09.07,3.12S0,276.72,0,277.77H.25a77.58,77.58,0,0,0,154.91-6.24V259.2a12.93,12.93,0,1,0-25.86,0v12.33A51.72,51.72,0,0,1,26,274.65a51.78,51.78,0,0,1,51.62-48.6h194a51.78,51.78,0,0,1,51.62,48.6,51.72,51.72,0,0,1-103.34-3.12V259.2a12.93,12.93,0,1,0-25.86,0v12.33a77.58,77.58,0,0,0,154.91,6.24h.25q0-1.57-.06-3.12t.06-3.12Z"/><path class="cls-2" d="M48.66,434.65H23v-22.3H9.88v56.56H23V445.72H48.66v23.19H61.75V412.35H48.66Zm76.61-22.3-25.21,56.56h13.41l5-12.12h26.26l5,12.12h13.74L138.2,412.35Zm-2.59,34.5,9-21.65,9,21.65Zm98.66-34.5-25.21,56.56h13.42l5-12.12h26.26l5,12.12h13.73l-25.29-56.56Zm-2.58,34.5,9-21.65,9,21.65Zm92.11,11.4v-45.9H297.78v56.56h41.46V458.25Z"/></g></g></svg>
                    {{--<img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{asset('img/create-account-office.jpeg')}}" alt="Office" />
                    <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block" src="{{asset('img/create-account-office-dark.jpeg')}}" alt="Office" />
                    --}}
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Create account
                        </h1>
                        @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">Whoops! Something went wrong.</div>

                            <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Name</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe" type="email" name="email" :value="old('email')" required />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="***************" type="password" name="password" required autocomplete="new-password" />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">
                                    Confirm password
                                </span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="***************" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Identity</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                                dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="text" name="identity" :value="old('identity')"
                                       required/>
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Address</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                                dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="text" name="address" :value="old('address')"/>
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Phone Number</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700
                                focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
                                dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="text" name="phone_number" :value="old('phone_number')"/>
                            </label>


                            <!-- You should use a button here, as the anchor is only used for the example  -->
                            <button class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit">
                                {{ __('Register') }}
                            </button>
                        </form>

                        <p class="mt-4">
                            <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="{{ route('login') }}">
                                Already have an account? Login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
