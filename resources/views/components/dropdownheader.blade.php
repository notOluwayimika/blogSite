

<div x-data="{ show: false}" @click.away="show=false" class=''>
    
    <button 
        @click="show = !show" 
        class=" pl-3 pr-3 text-sm font-semibold w-full text-left flex lg:inline-flex" 
        style="display: inline-flex">
            Welcome, {{auth()->user()->name}}.
    </button>

    <div x-show="show" class="py-2 absolute bg-gray-100 mt-2 rounded-xl w-32 z-50" style="display: none">
        @can('admin')
            <a href='/admin/posts' class=" block text-left px-3 text-sm leading-6 hover:bg-blue-500 hover:text-white focus:bg-blue-500 hover:text-white {{request()->is('/admin/dashboard')?'bg-blue-500 text-white':''}}">All Posts</a>
            <a href='/admin/post/create' class=" block text-left px-3 text-sm leading-6 hover:bg-blue-500 hover:text-white focus:bg-blue-500 hover:text-white {{request()->is('/admin/dashboard')?'bg-blue-500 text-white':''}}">New Post</a>
        @endcan
        <form id='logout' class="inline" action="/logout" method="post" class='hidden' >
            @csrf
            <button type="submit" class='block text-left px-3 text-sm leading-6 hover:bg-blue-500 hover:text-white focus:bg-blue-500 hover:text-white'>Log Out</button>
        </form>

    </div>
</div>