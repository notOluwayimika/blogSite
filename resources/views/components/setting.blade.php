@props(['heading'])
<section class='mt-6 mx-32 px-10'>
    <h1 class="mb-10 bg-blue-500 py-4 px-10 text-white rounded-xl text-center text-bold text-lg">{{$heading}}</h1>
    <div class='flex'>
        <aside class='w-48 '>
            
            <ul>
                <h4 class='font-bold mb-6'>Links</h4>
                @can('edit_post')
                    <li>
                        <a href="/admin/posts" class="{{request()->is('admin/posts*')?'text-blue-500':''}}"  hover:text-blue-600">All Posts</a>
                    </li>
                    <li>
                        <a href="/admin/post/create" class="{{request()->is('admin/post/create')?'text-blue-500':''}}"  hover:text-blue-600">New Post</a>
                    </li>
                @endcan
                @can('edit_category')
                    <li>
                        <a href="/admin/categories" class="{{request()->is('admin/categories*')?'text-blue-500':''}}" hover:text-blue-600">Categories</a>
                    </li>
                    <li>
                        <a href="/admin/users" class="{{request()->is('admin/users*')?'text-blue-500':(request()->is('users*')?'text-blue-500':'')}}  hover:text-blue-600">Users</a>
                    </li>
                @endcan
                
            </ul>
        </aside>
        <main class='flex-1'>
            {{$slot}}
        </main>
    </div>
    
    
</section>