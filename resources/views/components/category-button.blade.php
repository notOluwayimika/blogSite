@props(['category'])
<div class="space-x-2">
    
    <a href="/posts/?category={{$category->category}}&{{ http_build_query(request()->except('category','page'))}}"
        class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
        style="font-size: 10px">{{$category->category}}</a>
</div>