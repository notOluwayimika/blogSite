<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        Latest <span class="text-blue-500">Blogs</span> News
    </h1>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
        <!--  Category -->
        <div class="relative lg:inline-flex bg-gray-100 rounded-xl"> 
            @if (isset($currentCategory))
                <x-dropdown :categories="$categories" :currentcategory="$currentCategory" />
            @else
                <x-dropdown :categories="$categories"/>
            @endif

        


    <!-- Search -->
    
</div>
<div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
        <form method="GET" action="/posts">
            @if (request('category'))
                <input type='hidden' name='category' value={{request('category')}} />
            @endif
            <input type="text" name="search" placeholder="Find something"
                   class="bg-transparent placeholder-black font-semibold text-sm"
                   value="{{ request('search') }}">
        </form>
    </div>
</header>