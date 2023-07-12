<x-layout>
    <x-setting :heading="'Edit User: '.$user->username">
        <div>
            <p>User Role:</p>
            
        </div>       
        
<button id="dropdownHelperRadioButton" data-dropdown-toggle="dropdownHelperRadio" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">{{$roles[0]}} <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
  </svg></button>

<!-- Dropdown menu -->
<form action="/admin/users/{{$user->id}}/role" method="POST">
    @csrf
    <div id="dropdownHelperRadio" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 6119.5px, 0px);">
        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHelperRadioButton">
            @foreach ($allroles as $role)
                <li>
                    <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                        <div class="flex items-center h-5">
                            <input id="helper-radio-{{$loop->iteration}}" name="helper-radio" type="radio" value="{{$role->name}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </div>
                        <div class="ml-2 text-sm">
                            <label for="helper-radio-{{$loop->iteration}}" class="font-medium text-gray-900 dark:text-gray-300">
                                <div>{{$role->name}}</div>
                                <p id="helper-radio-text-4" class="text-xs font-normal text-gray-500 dark:text-gray-300">Select New Role.</p>
                            </label>
                        </div>
                    </div>
                </li>            
            @endforeach
        </ul>
    </div>
    <button type="submit" class='mt-3 text-white bg-red-700 text-xs hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-3 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>Change Role</button>
</form>
    </x-setting>
    
</x-layout>