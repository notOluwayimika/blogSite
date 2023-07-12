@props(['comment'])
<article class='flex bg-gray-100 p-6 rounded-xl border-gray-300 mb-4' style="border: 1px solid #D3D3D3">
    <div class='flex-shrink-0'>
        <img class='mt-2 rounded-xl 'src="/images/avatar.svg" alt="" width="50" height="50">
    </div>
    <div class="px-4">
        <header>
            <strong class='font-bold'>{{ $comment->author->username}}</strong>
            <p class='text-xs transition' >Posted <time>{{$comment->created_at}}</time></p>
        </header>
        <p id="{{$comment->id}}" class="">{{$comment->body}}</p>
        
        @if (auth()->user()->id == $comment->author->id)
            @auth
                <form id='edit_comment_form' action="/comments/{{$comment->id}}" method='POST' class='rounded-xl hidden transition inline'>
                            @csrf
                            @method('PUT')
                            <header class='flex items-center'>
                                <input id="editcommentinput" required type="text" name="body" class="ml-3 mt-1 inline flex w-full text-xs focus:outline-none focus:border-none commentsection" value="{{$comment->body}}"/>
                                <button  type="submit" class='bg-blue-500 text-white text-xs rounded-2xl px-10 py-2 hover:bg-blue-600'>Edit</button>
                            </header>

                        </form>
                        @error('body')
                            <span class='text-xs text-red'>{{$message}}</span>
                        @enderror
                        
                    @endauth
            <button id='edit_comment' data-id="{{$comment->id}}" class='ml-3 mb-3 px-2 inline-flex text-xs  leading-5  font-bold rounded-full bg-blue-200 text-blue-800'>Edit comment</button>
            <form action="/comments/{{$comment->id}}" method='POST' class='inline'>
                @csrf
                @method('DELETE') 
                <button type='submit' id='delet_comment' data-id="{{$comment->id}}" class='ml-3 mb-3 px-2 inline-flex text-xs  leading-5  font-bold rounded-full bg-red-200 text-red-800'>Delete comment</button>
            </form>
           @endif
    </div>

</article>
