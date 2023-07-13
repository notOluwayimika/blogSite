<x-layout>
    <x-setting :heading="'Edit Category: '.$category->category">
        <div>
            <form action="/admin/category/{{$category->id}}" method="POST">
                @csrf
                @method('PUT')
                    <div>
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edit Category Name</label> 
                        <input  type="category" name="category" id="category" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="New Category" required value={{$category->category}}>
                        @error('category')
                            <p class='text-red-500 text-xs mt-1'>{{$message}}</p>
                        @enderror
                        <button type="submit" class="w-full bg-primary-600 text-white bg-blue-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create Category</button>
                                    
                    </div>
                                    
            </form>
        </div>
    </x-setting>
    
</x-layout>