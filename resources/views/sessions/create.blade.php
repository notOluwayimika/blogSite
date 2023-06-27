<x-layout>
    <section class="">
        <main class='max-w-lg mx-auto'>
                <section class="bg-gray-50 dark:bg-gray-900">
                    <div class="flex flex-col items-center justify-center py-4 mx-auto md:h-screen lg:py-0">
                        <p class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                            <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">  
                        </p>
                        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                            <div class="p-6 space-y-2 md:space-y-6 sm:p-8">
                                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                    Create an Account
                                </h1>
                                <form class="space-y-4 md:space-y-6 max-w-lg mx-auto" method='POST' action="/sessions">
                                    @csrf
                                    <div>
                                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                        <input  type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="" value={{old('email')}}>
                                        @error('email')
                                            <p class='text-red-500 text-xs mt-1'>{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                        @error('password')
                                            <p class='text-red-500 text-xs mt-1'>{{$message}}</p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="w-full bg-primary-600 text-white bg-blue-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Log In</button>
                                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                                        Dont have an account? <a href="/register" class="font-medium text-primary-600 hover:underline text-blue-500 dark:text-primary-500">Create one here</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                  </section>
            </main>
    </section>
</x-layout>