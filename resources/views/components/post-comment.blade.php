@props(['comment'])
<article class='flex bg-gray-100 p-6 rounded-xl border-gray-300 mb-4' style="border: 1px solid #D3D3D3">
    <div class='flex-shrink-0'>
        <img class='mt-2 rounded-xl 'src="/images/avatar.svg" alt="" width="50" height="50">
    </div>
    <div class="px-4">
        <header>
            <strong class='font-bold'>{{ $comment->author->username}}</strong>
            <p class='text-xs'>Posted <time>{{$comment->created_at}}</time></p>
        </header>
        <p>{{$comment->body}}</p>
    </div>

</article>