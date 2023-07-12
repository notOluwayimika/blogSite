<x-layout>
    <x-setting :heading="'Edit Post: '.$post->title">
        <form action="/admin/post/{{$post->id}}" method='POST' enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class='mb-10'>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input  type="text" name="title" id="title" class="commentsection bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="title..." required="" value="{{old('title')?old('title'):$post->title}}">
                @error('title')
                    <p class='text-red-500 text-xs mt-1'>{{$message}}</p>
                @enderror
            </div>
            <div class='mb-10'>
                <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Thumbnail</label>
                <input  type="file" name="thumbnail" id="thumbnail" class=" bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="title..." >
                @error('thumbnail')
                    <p class='text-red-500 text-xs mt-1'>{{$message}}</p>
                @enderror
                <img src="{{str_ireplace('public', '',asset('storage/'.$post->thumbnail))}}" alt="" width="100" class="rounded-xl">
            </div>
            <div class='mb-10'>
                <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Excerpt</label>
                <input  type="text" name="excerpt" id="excerpt" class="commentsection bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="excerpt..." required="" value="{{$post->excerpt}}">
                @error('excerpt')
                    <p class='text-red-500 text-xs mt-1'>{{$message}}</p>
                @enderror
            </div>
            <div class='mb-10'>
                <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
                <textarea name="body" id="body" class='commentsection w-full' cols="100" rows="10" placeholder="body..." >{{$post->body}}</textarea>
                @error('body')
                    <p class='text-red-500 text-xs mt-1'>{{$message}}</p>
                @enderror
            </div>
            <div class='mb-10'>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                <select class='uppercase' name="category_id" id="category_id">
                    @foreach (\App\Models\Category::all() as $category)
                        <option class='uppercase' {{$post->category->id===$category->id?'selected':''}} value="{{$category->id}}">{{ ucwords($category->category )}}</option>
                    @endforeach
                </select>
            </div>
    
            <button type='submit' class='bg-blue-500 text-white  uppercase  font-bold text-xs  py-2 px-10 rounded-2xl hover:bg-blue-600'>Update</button>
        </form>

        <div>
            <ul>
                @foreach ($post->comments as $comment)
                    <li>
                        <span class='text-xs text-blue-500 pr-1'>written by:</span>{{$comment->author->username}} <span class='text-xs text-blue-500 pl-3 pr-1'>Comment:</span> {{$comment->body}}
                        <form id='logout' class="inline" action="/comments/{{$comment->id}}" method="post" class='hidden' >
                            @csrf
                            @method('delete')
                            <button type="submit" class='pl-3 px-3 leading-6 text-red-500 hover:text-white hover:bg-red-500 rounded-2xl '>Delete </button>
                        </form>
                    </li>
                @endforeach
            </ul>
            
        </div>
    </x-setting>
    
</x-layout>