<!doctype html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Laravel From Scratch Blog</title>
<link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
<!--Replace with your tailwind.css once created-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link href="/app.css" rel='stylesheet'>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>



<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/logo.svg" alt="Laracasts Logo" width="50" height="50">
                </a>
            </div>

            <div class="mt-8 md:mt-0 flex">
                <a href='/posts' class="text-xs font-bold uppercase px-2 hover:text-blue-500 transition-all pt-1">Posts</a>
                    |
                @guest
                    <a href="/register" class="text-xs font-bold uppercase px-2 hover:text-blue-500 transition-all pt-1">Register</a>
                    |
                    <a href="/login" class="text-xs font-bold uppercase px-2 hover:text-blue-500 transition-all pt-1">Login</a>
                    

                @endguest
                @auth
                    <x-dropdownheader >
                        <x-slot name='trigger'>
                        </x-slot>
                    </x-dropdownheader>
                    
                        @csrf
                @endauth
                

                <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                    Subscribe for Updates
                </a>
            </div>
        </nav>

        {{$slot}}

                            

        <footer id='newsletter' class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="/images/newsletter.png" alt="" class="mx-auto mb-6" style="width: 50px;">
            <h5 class="text-3xl">Stay in touch with the latest posts</h5>
            <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="#" class="lg:flex text-sm">
                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <input id="email" type="text" placeholder="Your email address"
                                   class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                        </div>

                        <button type="submit"
                                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                        >
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </footer>
    </section>
    @if (session()->has('success'))
        <div x-data='{show:true}' x-transition x-show='show' x-init='setTimeout(()=>show=false,4000)' class='fixed bottom-3 right-3 bg-blue-500 text-sm text-white py-2 px-4 rounded-xl'>
            <p>{{ session('success') }}</p>
        </div>
    @endif
</body>

<script type="text/javascript">
    $('#edit_comment').on('click', function (e){
        e.preventDefault();
        $('#edit_comment_form')[0].classList.toggle("hidden");
        $("#"+e.target.getAttribute('data-id'))[0].classList.toggle("hidden");
        $('#editcommentinput')[0].focus();
        
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
<!--Datatables -->

