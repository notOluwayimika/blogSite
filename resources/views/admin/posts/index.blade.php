<x-layout>
    <x-setting heading='Manage Posts'>
        <div class='flex flex-col'>
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class='shadow overflow-hidden border-b min-w-full sm:px-6 lg:px-8'>
                    <table class='min-w-full divide-y divid-gray-200'>
                        <tbody class='bg-white divide-y divide-gray-200'>
                            @foreach ($posts as $post)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                                <div class="font-medium  text-gray-900">
                                                    <a href="/posts/{{$post->id }}" class="adminlinks">{{$post->title}}</a>
                                                </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="px-2 inline-flex text-xs  leading-5  font-bold rounded-full bg-green-100 text-green-800">Published</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium"><a href="/admin/posts/{{$post->id}}/edit" class="text-blue-600 hover:text-blue-900">Edit</a></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                                        <form method="POST" action='/admin/post/{{$post->id}}'>
                                            @csrf
                                            @method('DELETE')
                                            <button type='submit' class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        </x-setting>
</x-layout>